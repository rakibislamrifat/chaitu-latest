<?php 
/**Template Name: Payment Design
*/


?>


<?php
// PHP variables for dynamic content
$starter_package_price = "$10.95";
$promo_discount = "$10";
$ford_mustang_value = "$10,000";
$ford_mustang_2nd_prize = "$2,000";
$ford_mustang_3rd_prize = "$1,000";
$bmw_x6m_value = "$145,000";
$total_entries_today = "2";
$total_entries_giveaway = "2";
?>
<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Express Checkout</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #2D4CFF 0%, #1A3DFF 100%);
        font-family: 'Arial', sans-serif;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background: #F8F9FA;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .express-checkout {
        color: #0000FE;
        font-size: 24px;
        font-weight: bold;
    }

    .starter-package {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .starter-text {
        color: #666;
        font-size: 14px;
    }

    .price {
        color: #333;
        font-size: 24px;
        font-weight: bold;
    }

    .price-small {
        color: #999;
        font-size: 12px;
        text-decoration: line-through;
    }

    .main-content {
        display: flex;
        flex-direction: row;
        gap: 30px;
    }

    .left-section {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);

    }

    .paylink-btn {
        background: rgb(15, 197, 109);
        color: white;
        padding: 15px;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .or-divider {
        display: flex;
        align-items: center;
        text-align: center;
        font-weight: bold;
        /* optional: text color */
    }

    .or-divider::before,
    .or-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #ccc;
        /* line style */
    }

    .or-divider::before {
        margin-right: 10px;
        /* space between line and text */
    }

    .or-divider::after {
        margin-left: 10px;
    }

    .enter-details {
        color: #0000FE;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 20px;
    }


    /* Unique form styles */

    .form-group.form-unique {
        position: relative;

        /* adjust as needed */
    }

    .form-group.form-unique .form-input {
        width: 100%;
        padding: 12px 120px 12px 15px;
        /* right padding for icons */
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .form-group.form-unique .payment-icons {
        position: absolute;
        top: 50%;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
        transform: translateY(-50%);
    }

    .form-group.form-unique .payment-icon {
        width: 35px;
        height: 22px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;

        /* hide text */
    }

    .form-group.form-unique .payment-icon.visa {
        background-image: url('https://i.ibb.co/39j4sGcc/Visa-Inc-Logo-wine.png');
    }

    .form-group.form-unique .payment-icon.mastercard {
        background-image: url('https://i.ibb.co/jPLQMBZ5/master-card-logo-png-seeklogo-89117.png');
    }

    .form-group.form-unique .payment-icon.amex {
        background-image: url('https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo_%282018%29.svg');
    }

    /* CLOSE  Unique form styles */


    /* Payment section unique group */
    .card-input-group.unique-form-group {
        display: flex;
        gap: 20px;
        /* spacing between the two inputs */
    }

    .card-input-group .form-group {
        position: relative;
        flex: 1;
    }

    .card-input-group .form-input {
        width: 100%;
        padding: 12px 40px 12px 12px;
        /* right padding for the icon */
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .card-input-group .security-group .cvc-icon {
        position: absolute;
        top: 70%;
        right: 10px;
        width: 50px;
        height: 30px;

        transform: translateY(-50%);
        background: url('https://i.ibb.co/35YNgp26/cvv.png') no-repeat center;
        background-size: contain;
    }


    /* CLOSE Payment section unique group */


    /* Promo Package Css */
    .promo-package {
        display: flex;
        align-items: center;
        gap: 15px;
        justify-content: space-between;
    }

    .promo-package-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .promo-package img {
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        width: 80px;
        height: 80px;
    }

    .promo-package-name {
        font-weight: bold;
    }

    .promo-price {
        display: flex;
    }

    .promo-price-main {
        font-weight: bold;
        font-size: 40px;
    }

    .promo-price-details span:first-child {
        text-decoration: line-through;
    }

    .promo-discount {
        padding: 10px;
        border: 1px solid black;
        border-radius: 5px;
        margin-top: 10px;
        font-weight: 600;
        color: rgb(105, 101, 101);
    }



    /* Promo Package Css */

    .form-subtitle {
        color: #666;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-label {
        color: #333;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }


    .required {
        color: red;
        font-size: 12px;
    }

    .form-input {
        width: 100%;
        padding: 12px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-input:focus {
        outline: none;
        border-color: #2D4CFF;
    }

    .mobile-input {
        display: flex;
        align-items: center;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        padding: 12px;
    }

    .country-code {
        background: #2D4CFF;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        margin-right: 10px;
        font-weight: bold;
    }

    .country-code-select {
        background: transparent;
        border: none;
        outline: none;
        color: #333;
        font-size: 14px;
        margin-right: 10px;
        padding: 0;
    }

    .mobile-input input {
        border: none;
        outline: none;
        flex: 1;
    }

    .select-input {
        appearance: none;
        background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
    }

    .payment-section {
        margin-top: 30px;
    }

    .payment-title {
        color: #0000FE;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card-input-group {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .payment-icons {
        display: flex;
        gap: 8px;
        margin-top: 10px;
    }

    .payment-icon {
        width: 40px;
        height: 25px;
        background: #333;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 10px;
        font-weight: bold;
    }

    .visa {
        background: #1A1F71;
    }

    .mastercard {
        background: #EB001B;
    }

    .amex {
        background: #006FCF;
    }

    .enter-now-btn {
        background: #DC2626;
        color: white;
        padding: 15px;
        border: none;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin: 20px 0;
    }

    .security-info {
        text-align: center;
        color: #666;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .security-badges {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .security-badge {
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: bold;
    }

    .right-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .promo-banner {
        background: linear-gradient(135deg, #00D084 0%, #00B87A 100%);
        color: white;
        padding: 15px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .promo-text {
        font-size: 14px;
    }

    .giveaway-section {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .giveaway-title {
        color: #0000FE;
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .prize-card {
        background: #F8F9FA;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .prize-img {
        width: 100px;
        height: 100px;
        border-radius: 10px;

    }

    .prize-info {
        font-weight: bold;
    }



    .prize-info h3 {
        color: #0000FE;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;

    }

    .prize-value {
        color: #333;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .prize-details {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .prize-detail {
        color: #666;
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .prize-icon {
        width: 12px;
        height: 12px;
        background: #FFB020;
        border-radius: 50%;
    }

    .entry-summary {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .summary-title {
        color: #0000FE;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        color: #666;
        font-size: 14px;
    }

    .trust-indicators {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background: white;
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
        gap: 10px;
        height: 100px;

    }

    .trust-item {
        text-align: center;
        flex: 1;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        padding: 10px;
        width: 100px;

    }

    .trust-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 8px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
    }



    .trust-text {
        color: #666;
        font-size: 10px;
        line-height: 1.2;
    }


    /* Swiper css  */
    .swiper-container {
        width: 100%;
        max-width: 600px;
        position: relative;
        overflow: hidden;
    }

    .swiper-wrapper {
        display: flex;
        transition: transform 0.5s ease;
    }

    .swiper-slide {
        min-width: 100%;
        flex-shrink: 0;
    }

    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .testimonial-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #0066ff, #004dcc);
    }

    .prize-title {
        color: #0066ff;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .testimonial-text {

        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .winner-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .winner-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #0066ff;
    }

    .winner-details h3 {
        color: #333;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .winner-details p {
        color: #666;
        font-size: 14px;
    }

    .swiper-pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 30px;
    }

    .pagination-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ddd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .pagination-dot.active {
        background-color: #0066ff;
        transform: scale(1.2);
    }

    .pagination-dot:hover {
        background-color: #0066ff;
        opacity: 0.7;
    }

    /* Navigation arrows */
    .swiper-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #0066ff;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .swiper-nav:hover {
        background-color: #0066ff;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }

    .swiper-nav.prev {
        left: -80px;
    }

    .swiper-nav.next {
        right: -80px;
    }

    @media (max-width: 768px) {
        .swiper-nav {
            display: none;
        }

        .testimonial-card {
            padding: 30px 20px;
        }

        .prize-title {
            font-size: 16px;
        }

        .testimonial-text {
            font-size: 14px;
        }
    }



    .terms-link {
        text-align: center;
        margin-top: 20px;
        font-size: 12px;
        color: #666;
    }

    .terms-link a {
        color: #2D4CFF;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .main-content {
            flex-direction: column;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .card-input-group {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="express-checkout">EXPRESS CHECKOUT</h1>
        </div>

        <div class="main-content">
            <!-- Left Section -->
            <div class="left-section">
                <!-- PayLink Button -->
                <button class="paylink-btn">
                    Pay with <span>
                        <img style="width: 20px;" src="https://i.ibb.co/My8wxKWY/next.png" alt="">
                    </span>link
                </button>

                <div class="or-divider">OR</div>

                <!-- Form Section -->
                <h2 class="enter-details">ENTER DETAILS</h2>
                <p class="form-subtitle">Fill in your details so we know how to contact you if you win.</p>

                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name <span class="required">*</span></label>
                            <input type="text" class="form-input" placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name <span class="required">*</span></label>
                            <input type="text" class="form-input" placeholder="Enter your last name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Mobile Number <span class="required">*</span>
                        </label>
                        <div class="mobile-input">
                            <select class="country-code-select">
                                <option value="+1">US +1</option>
                                <option value="+44">DB +44</option>
                                <option value="+880">BD +880</option>
                                <option value="+91">IN +91</option>
                                <!-- Add more countries -->
                            </select>
                            <input type="tel" placeholder="Enter mobile number">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" class="form-input" placeholder="Enter email address">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Residential State <span class="required">*</span></label>
                        <select class="form-input select-input">
                            <option>Select residential state</option>
                            <option>Dhaka</option>
                            <option>Chittagong</option>
                            <option>Sylhet</option>
                            <option>Rajshahi</option>
                        </select>
                    </div>

                    <!-- Payment Section -->
                    <div class="payment-section">
                        <h3 class="payment-title">PAYMENT</h3>

                        <div class="form-group form-unique">
                            <label class="form-label">Card number</label>
                            <input type="text" class="form-input" placeholder="1234 1234 1234 1234">
                            <div class="payment-icons">
                                <div class="payment-icon visa">VISA</div>
                                <div class="payment-icon mastercard">MC</div>
                                <div class="payment-icon amex">AMEX</div>
                            </div>
                        </div>

                        <div class="card-input-group unique-form-group">
                            <div class="form-group">
                                <label class="form-label">Expiration date</label>
                                <input type="text" class="form-input" placeholder="MM / YY">
                            </div>
                            <div class="form-group security-group">
                                <label class="form-label">Security code</label>
                                <input type="text" class="form-input" placeholder="CVC">
                                <div class="cvc-icon"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <select class="form-input select-input" id="country-select">
                                <!-- JS will insert options here -->
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="enter-now-btn">ENTER NOW</button>
                </form>

                <p class="security-info">No lock-ins, no dramas - cancel anytime!</p>

                <div class="security-badges">
                    <span>🔒</span>
                    <span style="color: #333;">Guaranteed safe & secure checkout</span>
                    <div class="security-badge">Powered by Stripe</div>
                </div>

                <div class="payment-icons" style="justify-content: center;">
                    <div class="payment-icon visa">VISA</div>
                    <div class="payment-icon mastercard">MC</div>
                    <div class="payment-icon" style="background: #007BC1;">AMEX</div>
                    <div class="payment-icon" style="background: #005BAC;">JCB</div>
                    <div class="payment-icon" style="background: #6C757D;">A/Pay</div>
                    <div class="payment-icon" style="background: #4285F4;">G Pay</div>
                    <div class="payment-icon" style="background: #003087;">PayPal</div>
                </div>

                <div class="terms-link">
                    <p>By continuing, you agree to Winners Locker <a href="#">Terms of Service</a> and the <a
                            href="#">Privacy Policy</a></p>
                </div>
            </div>

            <!-- Right Section -->
            <div class="right-section">


                <!-- Promo Package -->
                <div>
                    <div class="promo-package">
                        <div class="promo-package-left">
                            <!-- Example icon, replace with your image -->
                            <div>
                                <img src="https://i.ibb.co/kgqsLtbw/starter-Dhy-UAsp-U.png" alt="Starter Package" />
                            </div>
                            <div class="promo-package-name">STARTER <br> PACKAGE</div>
                        </div>
                        <div>
                            <div class="promo-price">
                                <span class="promo-price-main">$10</span>
                                <div class="promo-price-details">
                                    <span>$20</span> <br>
                                    <span>/month for first month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-discount">
                        <span>✔️ Promo Applied!</span>
                        <p>Nice one, $10 off your payment has been locked in!</p>
                    </div>
                </div>
                <!-- Current Giveaway -->
                <div class="giveaway-section">
                    <h2 class="giveaway-title">CURRENT GIVEAWAY</h2>

                    <div class="prize-card">
                        <div>
                            <img class="prize-img" src="https://i.ibb.co/0pnw8R6B/Ford-Mustang-Exterior-126883.jpg"
                                alt="Ford Mustang" />
                        </div>
                        <div class="prize-info">
                            <h3>NEW 2025 FORD MUSTANG OR <?php echo $ford_mustang_value; ?> CASH</h3>
                            <div class="prize-value">Total Value: <?php echo $ford_mustang_value; ?></div>
                            <div style="color: #DC2626; font-weight: bold; font-size: 12px;">EXTRA PRIZES</div>
                            <div class="prize-details">
                                <div class="prize-detail">
                                    <div class="prize-icon"></div>
                                    <span>2nd Prize: <?php echo $ford_mustang_2nd_prize; ?> cash</span>
                                </div>
                                <div class="prize-detail">
                                    <div class="prize-icon"></div>
                                    <span>3rd Prize: <?php echo $ford_mustang_3rd_prize; ?> cash</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Also in this for free -->
                <div class="giveaway-section">
                    <h2 class="giveaway-title">ALSO IN THIS FOR FREE</h2>

                    <div class="prize-card">
                        <div>
                            <img class="prize-img" src="https://i.ibb.co/0pnw8R6B/Ford-Mustang-Exterior-126883.jpg"
                                alt="Ford Mustang" />
                        </div>
                        <div class="prize-info">
                            <h3>MODIFIED BMW X6M 50I OR $100,000 CASH</h3>
                            <div class="prize-value">Total Value: <?php echo $bmw_x6m_value; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Entry Summary -->
                <div class="entry-summary">
                    <h2 class="summary-title">YOUR ENTRY SUMMARY</h2>
                    <div class="summary-row">
                        <span>Entries from joining today</span>
                        <span><?php echo $total_entries_today; ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Total entries in this giveaway</span>
                        <span><?php echo $total_entries_giveaway; ?></span>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div class="trust-indicators">
                    <div class="trust-item">
                        <div class="trust-icon verified">
                            <img src="https://i.ibb.co/mVjy97g6/download.png" alt="">
                        </div>
                        <div class="trust-text">Verifiably Fair</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon secure">
                            <img src="https://i.ibb.co/zTD7Rrsd/download-1.png" alt="">
                        </div>
                        <div class="trust-text">Secure Checkout</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon anytime">
                            <img src="https://i.ibb.co/PzFmKQsD/download-2.png" alt="">
                        </div>
                        <div class="trust-text">Cancel Anytime</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon australian">
                            <img src="https://i.ibb.co/spRmkjd6/download-3.png" alt="">
                        </div>
                        <div class="trust-text">Australian</div>
                    </div>
                    <div class="trust-item">
                        <div class="trust-icon series">
                            <img src="https://i.ibb.co/JjphX1YL/download-4.png" alt="">
                        </div>
                        <div class="trust-text">3000 Series</div>
                    </div>
                </div>

                <!-- Winner Section with Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper" id="swiperWrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="prize-title">NEW FORD RAPTOR OR $70,000 CASH</div>
                                <div class="testimonial-text">
                                    "It's truly overwhelming, this win for my family has come at the absolute right time
                                    a new car is a must, pop some bits and travel to see much loved family."
                                </div>
                                <div class="winner-info">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b8c5?w=100&h=100&fit=crop&crop=face"
                                        alt="Winner" class="winner-avatar">
                                    <div class="winner-details">
                                        <h3>WINNER: Lauraine B, QLD</h3>
                                        <p>Starter Membership</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="prize-title">LUXURY VACATION PACKAGE OR $45,000 CASH</div>
                                <div class="testimonial-text">
                                    "I can't believe I actually won! This prize will help us take the family vacation
                                    we've been dreaming about for years. Thank you so much!"
                                </div>
                                <div class="winner-info">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face"
                                        alt="Winner" class="winner-avatar">
                                    <div class="winner-details">
                                        <h3>WINNER: Michael R, NSW</h3>
                                        <p>Premium Membership</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="prize-title">HOME RENOVATION OR $60,000 CASH</div>
                                <div class="testimonial-text">
                                    "This is absolutely life-changing! We've been saving for years to renovate our
                                    kitchen and now we can finally make it happen. So grateful!"
                                </div>
                                <div class="winner-info">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face"
                                        alt="Winner" class="winner-avatar">
                                    <div class="winner-details">
                                        <h3>WINNER: Sarah T, VIC</h3>
                                        <p>Gold Membership</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <div class="testimonial-card">
                                <div class="prize-title">DREAM MOTORCYCLE OR $35,000 CASH</div>
                                <div class="testimonial-text">
                                    "As a lifelong motorcycle enthusiast, winning this prize is like a dream come true.
                                    I never thought I'd be lucky enough to win something like this!"
                                </div>
                                <div class="winner-info">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face"
                                        alt="Winner" class="winner-avatar">
                                    <div class="winner-details">
                                        <h3>WINNER: David L, WA</h3>
                                        <p>Platinum Membership</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <button class="swiper-nav prev" onclick="previousSlide()">❮</button>
                    <button class="swiper-nav next" onclick="nextSlide()">❯</button>

                    <!-- Pagination -->
                    <div class="swiper-pagination" id="pagination"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- swipper js -->
    <script>
    class TestimonialSwiper {
        constructor() {
            this.currentSlide = 0;
            this.totalSlides = document.querySelectorAll('.swiper-slide').length;
            this.wrapper = document.getElementById('swiperWrapper');
            this.pagination = document.getElementById('pagination');

            this.init();
        }

        init() {
            this.createPagination();
            this.updateSlide();
            this.startAutoPlay();
            this.addTouchEvents();
        }

        createPagination() {
            for (let i = 0; i < this.totalSlides; i++) {
                const dot = document.createElement('div');
                dot.className = 'pagination-dot';
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => this.goToSlide(i));
                this.pagination.appendChild(dot);
            }
        }

        updateSlide() {
            const translateX = -this.currentSlide * 100;
            this.wrapper.style.transform = `translateX(${translateX}%)`;

            // Update pagination
            document.querySelectorAll('.pagination-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentSlide);
            });
        }

        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.updateSlide();
        }

        previousSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.updateSlide();
        }

        goToSlide(index) {
            this.currentSlide = index;
            this.updateSlide();
        }

        startAutoPlay() {
            setInterval(() => {
                this.nextSlide();
            }, 5000); // Auto-advance every 5 seconds
        }

        addTouchEvents() {
            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            this.wrapper.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
            });

            this.wrapper.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                currentX = e.touches[0].clientX;
            });

            this.wrapper.addEventListener('touchend', () => {
                if (!isDragging) return;
                isDragging = false;

                const diffX = startX - currentX;
                const threshold = 50;

                if (Math.abs(diffX) > threshold) {
                    if (diffX > 0) {
                        this.nextSlide();
                    } else {
                        this.previousSlide();
                    }
                }
            });
        }
    }

    // Global functions for navigation buttons
    let swiper;

    function nextSlide() {
        swiper.nextSlide();
    }

    function previousSlide() {
        swiper.previousSlide();
    }

    // Initialize swiper when page loads
    document.addEventListener('DOMContentLoaded', () => {
        swiper = new TestimonialSwiper();
    });
    </script>



    <!-- Country Script -->
    <script>
    const countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
        "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
        "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia",
        "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso",
        "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic",
        "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Croatia",
        "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
        "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini",
        "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana",
        "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti",
        "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland",
        "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
        "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
        "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia",
        "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico",
        "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",
        "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua",
        "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", "Pakistan",
        "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
        "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis",
        "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino",
        "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
        "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan",
        "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania",
        "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
        "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
        "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City",
        "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
    ];

    const select = document.getElementById('country-select');

    countries.forEach(country => {
        const option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        select.appendChild(option);
    });
    </script>






</body>

</html>