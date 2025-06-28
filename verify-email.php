<?php
/**
 * Template Name: Verify Email
 */
session_start();
require_once ABSPATH . 'wp-load.php';

$errors = [];

if (!isset($_SESSION['pending_signup'])) {
    wp_redirect(home_url('/sign-up'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputOtp = trim($_POST['email_otp_input'] ?? '');
    $sessionOtp = $_SESSION['email_otp'] ?? null;
    $otpExpiry = $_SESSION['otp_expiry'] ?? 0;

    if ($sessionOtp !== null && (string)$inputOtp === (string)$sessionOtp && time() < $otpExpiry) {
        $data = unserialize($_SESSION['pending_signup'] ?? '');

        if (username_exists($data['username']) || email_exists($data['email'])) {
            $errors[] = "Username or email already taken.";
        } else {
            $user_id = wp_insert_user([
                'user_login'    => sanitize_user($data['username']),
                'user_pass'     => $data['password'],
                'user_email'    => sanitize_email($data['email']),
                'first_name'    => sanitize_text_field($data['first_name']),
                'last_name'     => sanitize_text_field($data['last_name']),
                'display_name'  => sanitize_text_field($data['first_name'] . ' ' . $data['last_name']),
            ]);

            if (!is_wp_error($user_id)) {
                // Insert additional data into custom userinformation table
                global $wpdb;
                $table = $wpdb->prefix . 'userinformation';

                $dob = sanitize_text_field($data['dob'] ?? '');
                $address = sanitize_textarea_field($data['address'] ?? '');
                $region = sanitize_text_field($data['region'] ?? '');
                $phone = sanitize_text_field($data['phone'] ?? '');

                $wpdb->insert($table, [
                    'user_id' => $user_id,
                    'dob'     => $dob,
                    'address' => $address,
                    'region'  => $region,
                    'phone'   => $phone,
                ]);

                // Clean up all session data
                session_unset();
                session_destroy();

                // Redirect to sign-in page
                wp_redirect(home_url('/sign-in'));
                exit;
            } else {
                $errors[] = "Account creation failed: " . $user_id->get_error_message();
            }
        }
    } else {
        $errors[] = "Invalid or expired verification code.";
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - The Velvet Reel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            background: linear-gradient(135deg, #CD2838, #f7931e);
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
            content: "✉";
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
            background-color:linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
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

        .chaitu-error-messages li:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 480px) {
            .chaitu-container {
                padding: 30px 20px;
            }
            
            .chaitu-title {
                font-size: 24px;
            }
            
            .chaitu-form-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <div class="chaitu-container">
        <div class="chaitu-lock-icon"></div>
        
        <h1 class="chaitu-title">The Velvet Reel</h1>
        <p class="chaitu-subtitle">Verify your email to complete registration</p>
        
        <h2 class="chaitu-form-title">Email Verification</h2>

        <?php if ($errors): ?>
            <div class="chaitu-error-messages">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= esc_url(home_url('/verify-email')) ?>" novalidate>

            <div class="chaitu-form-group">
                <label class="chaitu-label">Verification Code</label>
                <input type="text" name="email_otp_input" class="chaitu-input" placeholder="Enter your verification code" required />
            </div>
            
            <button type="submit" class="chaitu-submit-btn">VERIFY</button>
        </form>

        <a href="http://localhost/ChaituNew/sign-up" class="chaitu-back-link">← Back to Sign Up</a>
    </div>

</body>
</html>