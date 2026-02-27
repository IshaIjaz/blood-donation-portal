<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Contact</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== HEADER ===== -->
<header>
    <div class="header-container">
        <div class="logo">
            <h1>🩸 Online Blood Donation Portal</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== CONTACT CONTENT ===== -->
<div class="container">
    <div style="text-align: center; margin: 3rem 0 1rem;">
        <h1 class="section-title">Contact Us</h1>
        <p class="section-subtitle">
            Have questions? We're here to help. Send us a message and we'll respond within 24 hours.
        </p>
    </div>
    
    <div class="contact-grid">
        <!-- Contact Info -->
        <div class="contact-info-card">
            <h3>Get in Touch</h3>
            
            <div class="contact-info-item">
                <div class="contact-info-icon">📧</div>
                <div class="contact-info-text">
                    <h4>Email</h4>
                    <p>info@blooddonation.pk</p>
                </div>
            </div>
            
            <div class="contact-info-item">
                <div class="contact-info-icon">📞</div>
                <div class="contact-info-text">
                    <h4>Phone</h4>
                    <p>+92 300 1234567</p>
                </div>
            </div>
            
            <div class="contact-info-item">
                <div class="contact-info-icon">📍</div>
                <div class="contact-info-text">
                    <h4>Address</h4>
                    <p>Islamabad, Pakistan</p>
                </div>
            </div>
            
            <div style="margin-top: 2rem;">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook">
                        <span>f</span>    BloodDonationHub</a> <br><br>
                    <a href="#" class="social-link" title="Twitter">
                        <span>𝕏</span>    Blood_donation
                    </a><br><br>
                    <a href="#" class="social-link" title="Instagram">
                        <span>📷</span>    BloodDonation.pk
                    </a><br><br>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="form-container" style="margin: 0;">
            <h2>Send a Message</h2>
            
            <form>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Your name" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="you@example.com" required>
                </div>
                
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" placeholder="How can we help?" required>
                </div>
                
                <div class="form-group">
                    <label>Message</label>
                    <textarea id="message" placeholder="Write your message here..." required></textarea>
                    <div class="char-counter">
                        <span id="charCount">0</span>/500 characters
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="footer-container">
        <div class="footer-column">
            <h3>🩸 Online Blood Donation Portal</h3>
            <p>Connecting donors with hospitals to save lives, one donation at a time.</p>
        </div>

        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Contact Info</h3>
            <ul class="contact-info">
                <li>📧 Email: info@blooddonation.pk</li>
                <li>📞 Phone: +92 300 1234567</li>
                <li>📍 Islamabad, Pakistan</li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>Made with ❤️ by Online Blood Donation Portal | © 2026 All rights reserved.</p>
    </div>
</footer>

<script src="js/script.js"></script>
</body>
</html>