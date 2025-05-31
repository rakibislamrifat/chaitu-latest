<?php
/**
 * Template Name: Sign In
 */
session_start();
require_once ABSPATH . 'wp-load.php';
require_once ABSPATH . 'wp-includes/pluggable.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email) $errors[] = "Email is required.";
    if (!$password) $errors[] = "Password is required.";

    if (empty($errors)) {
        $user = get_user_by('email', $email);

        if ($user && wp_check_password($password, $user->user_pass, $user->ID)) {
            // Log the user in
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);

            // Optional session (for non-WP usage)
            $_SESSION['user'] = $user->user_login;

            wp_redirect(home_url('/')); // or your dashboard URL
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sign In - The Velvet Reel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.chaitu-body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    min-height: 100vh;
    color: #ffffff;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chaitu-container {
    max-width: 450px;
    width: 100%;
    padding: 50px 40px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 0.8s ease forwards;
}

.chaitu-header {
    text-align: center;
    margin-bottom: 40px;
}

.chaitu-brand {
    font-family: 'Playfair Display', serif;
    font-size: 2.8rem;
    font-weight: 600;
    background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 12px;
    letter-spacing: 1px;
}

.chaitu-subtitle {
    font-size: 1rem;
    color: #cccccc;
    font-weight: 300;
    margin-bottom: 15px;
    line-height: 1.5;
}

.chaitu-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #ffffff;
    margin-top: 25px;
}

.chaitu-error-messages {
    background: rgba(220, 53, 69, 0.15);
    border: 1px solid rgba(220, 53, 69, 0.3);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
    animation: shake 0.5s ease-in-out;
}

.chaitu-error-messages ul {
    list-style: none;
}

.chaitu-error-messages li {
    color: #ff6b7a;
    margin-bottom: 8px;
    font-size: 0.95rem;
    padding-left: 25px;
    position: relative;
}

.chaitu-error-messages li:before {
    content: "⚠";
    position: absolute;
    left: 0;
    color: #dc3545;
    font-size: 1.1rem;
}

.chaitu-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.chaitu-form-group {
    display: flex;
    flex-direction: column;
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

.chaitu-form-group:nth-child(1) { animation-delay: 0.2s; }
.chaitu-form-group:nth-child(2) { animation-delay: 0.3s; }
.chaitu-form-group:nth-child(3) { animation-delay: 0.4s; }

.chaitu-label {
    font-size: 0.95rem;
    font-weight: 500;
    color: #e0e0e0;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
}

.chaitu-input {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    padding: 18px 20px;
    font-size: 1.05rem;
    color: #ffffff;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
}

.chaitu-input::placeholder {
    color: #999999;
}

.chaitu-input:focus {
    outline: none;
    border-color: #dc3545;
    background: rgba(255, 255, 255, 0.12);
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    transform: translateY(-2px);
}

.chaitu-input:hover {
    border-color: rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.1);
}

.chaitu-submit-btn {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 15px;
    font-family: 'Inter', sans-serif;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
}

.chaitu-submit-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.chaitu-submit-btn:hover:before {
    left: 100%;
}

.chaitu-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
}

.chaitu-submit-btn:active {
    transform: translateY(0);
}

.chaitu-links {
    text-align: center;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.chaitu-forgot-password {
    margin-bottom: 15px;
}

.chaitu-register-section {
    margin-top: 15px;
}

.chaitu-forgot-link, .chaitu-register-link {
    color: #cccccc;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
}

.chaitu-forgot-link:hover, .chaitu-register-link:hover {
    color: #dc3545;
}

.chaitu-forgot-link:after, .chaitu-register-link:after {
    content: '';
    position: absolute;
    width: 0;
    height: 1px;
    bottom: -2px;
    left: 50%;
    background-color: #dc3545;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.chaitu-forgot-link:hover:after, .chaitu-register-link:hover:after {
    width: 100%;
}

.chaitu-register-text {
    color: #aaaaaa;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.chaitu-register-link {
    font-weight: 500;
    color: #ffffff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chaitu-container {
        margin: 10px;
        padding: 40px 30px;
        max-width: 100%;
    }
    
    .chaitu-brand {
        font-size: 2.3rem;
    }
    
    .chaitu-title {
        font-size: 1.3rem;
    }
    
    .chaitu-input {
        padding: 15px 18px;
        font-size: 1rem;
    }
    
    .chaitu-submit-btn {
        padding: 15px 30px;
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .chaitu-body {
        padding: 15px;
    }
    
    .chaitu-container {
        padding: 35px 25px;
    }
    
    .chaitu-brand {
        font-size: 2rem;
    }
    
    .chaitu-subtitle {
        font-size: 0.9rem;
    }
}

/* Animations */
@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Loading state for button */
.chaitu-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.chaitu-submit-btn:disabled:hover {
    transform: none;
    box-shadow: none;
}

/* Welcome message styling */
.chaitu-welcome {
    text-align: center;
    margin-bottom: 20px;
    padding: 15px;
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.2);
    border-radius: 10px;
    color: #ff6b7a;
    font-size: 0.95rem;
}

/* Additional styling for enhanced UX */
.chaitu-input-icon {
    position: relative;
}

.chaitu-input-icon:before {
    content: '';
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    opacity: 0.6;
}

.chaitu-email-input:before {
    content: '📧';
}

.chaitu-password-input:before {
    content: '🔒';
}
</style>
</head>
<body class="chaitu-body">

<div class="chaitu-container">
    <div class="chaitu-header">
        <h1 class="chaitu-brand">The Velvet Reel</h1>
        <p class="chaitu-subtitle">Welcome back to our exclusive platform</p>
        <h2 class="chaitu-title">Sign In to Your Account</h2>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="chaitu-error-messages">
            <ul>
                <?php foreach($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= esc_url(home_url('/sign-in')) ?>" novalidate class="chaitu-form">

        <div class="chaitu-form-group">
            <label class="chaitu-label">Email Address</label>
            <input type="email" name="email" class="chaitu-input" 
                   placeholder="Enter your email address"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                   required />
        </div>

        <div class="chaitu-form-group">
            <label class="chaitu-label">Password</label>
            <input type="password" name="password" class="chaitu-input" 
                   placeholder="Enter your password"
                   required />
        </div>

        <button type="submit" name="submit" class="chaitu-submit-btn">Sign In</button>
    </form>

    <div class="chaitu-links">
        <div class="chaitu-forgot-password">
            <a href="http://localhost/ChaituNew/forgot-password/" class="chaitu-forgot-link">Forgot your password?</a>
        </div>
        
        <div class="chaitu-register-section">
            <p class="chaitu-register-text">Don't have an account?</p>
            <a href="http://localhost/ChaituNew/sign-up/" class="chaitu-register-link">Create Account</a>
        </div>
    </div>
</div>

</body>
</html>