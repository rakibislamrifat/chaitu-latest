<?php
/**
 * Template Name: Verify Otp
 */
session_start();
require_once ABSPATH . 'wp-load.php';

$errors = [];
$success = "";

// Check if reset email exists in session
if (!isset($_SESSION['reset_email'])) {
    wp_redirect(home_url('/forgot-password'));
    exit;
}

$email = $_SESSION['reset_email'];
$user = get_user_by('email', $email);

if (!$user) {
    $errors[] = "No user found with this email.";
} else {
    $user_id = $user->ID;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_otp = trim($_POST['otp'] ?? '');

    if (!$input_otp) {
        $errors[] = "Please enter the OTP.";
    } else {
        $stored_otp = get_user_meta($user_id, 'reset_token', true);
        $expiry     = get_user_meta($user_id, 'reset_token_expiry', true);

        if (!$stored_otp || !$expiry) {
            $errors[] = "No OTP found. Please request again.";
        } elseif ($input_otp === $stored_otp && strtotime($expiry) > time()) {
            // OTP is valid — proceed
            delete_user_meta($user_id, 'reset_token');
            delete_user_meta($user_id, 'reset_token_expiry');

            // Redirect to reset password page
            wp_redirect(home_url('/reset-password'));
            exit;
        } else {
            $errors[] = "Invalid or expired OTP.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - The Velvet Reel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #2a2a2a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .chaitu-container {
            background-color: #3a3a3a;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        .chaitu-lock-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .chaitu-lock-icon::before {
            content: "🔒";
            font-size: 24px;
            color: white;
        }
        .chaitu-lock-icon::after {
            content: "📱";
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 16px;
            background: #4CAF50;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chaitu-title {
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 12px;
            color: #ffffff;
        }
        .chaitu-subtitle {
            color: #b0b0b0;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.4;
        }
        .chaitu-form-title {
            font-size: 20px;
            font-weight: 400;
            margin-bottom: 30px;
            color: #ffffff;
        }
        .chaitu-form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .chaitu-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: #ffffff;
        }
        .chaitu-input {
            width: 100%;
            padding: 12px 16px;
            background-color: #4a4a4a;
            border: 1px solid #5a5a5a;
            border-radius: 8px;
            font-size: 16px;
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease;
            text-align: center;
            letter-spacing: 2px;
        }
        .chaitu-input::placeholder {
            color: #888;
        }
        .chaitu-input:focus {
            border-color: #CD2838;
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.2);
        }
        .chaitu-submit-btn {
            width: 100%;
            padding: 14px 20px;
            background-color: #d63031;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .chaitu-submit-btn:hover {
            background-color: #e74c3c;
            transform: translateY(-1px);
        }
        .chaitu-submit-btn:active {
            transform: translateY(0);
        }
        .chaitu-back-link {
            color: #b0b0b0;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .chaitu-back-link:hover {
            color: #ffffff;
        }
        .chaitu-error-messages {
            background-color: rgba(255, 107, 53, 0.1);
            border: 1px solid rgba(255, 107, 53, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: left;
        }
        .chaitu-error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .chaitu-error-messages li {
            color: #CD2838;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .chaitu-email-info {
            background-color: rgba(76, 175, 80, 0.1);
            border: 1px solid rgba(76, 175, 80, 0.3);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            color: #4CAF50;
        }
        @media (max-width: 480px) {
            .chaitu-container { padding: 30px 20px; }
            .chaitu-title { font-size: 24px; }
            .chaitu-form-title { font-size: 18px; }
        }
    </style>
</head>
<body>

    <div class="chaitu-container">
        <div class="chaitu-lock-icon"></div>
        <h1 class="chaitu-title">The Velvet Reel</h1>
        <p class="chaitu-subtitle">Enter the verification code sent to your email</p>
        <h2 class="chaitu-form-title">Verify OTP</h2>

        <div class="chaitu-email-info">
            OTP sent to: <?= htmlspecialchars($email) ?>
        </div>

        <?php if ($errors): ?>
            <div class="chaitu-error-messages">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= esc_url(home_url('/verify-otp')) ?>" novalidate>

            <div class="chaitu-form-group">
                <label class="chaitu-label">Enter OTP</label>
                <input type="text" name="otp" class="chaitu-input" placeholder="Enter your OTP code" maxlength="6" required />
            </div>
            <button type="submit" class="chaitu-submit-btn">VERIFY OTP</button>
        </form>

        <a href="<?= esc_url(home_url('/forgot-password')) ?>" class="chaitu-back-link">← Back to Forgot Password</a>
    </div>

</body>
</html>
