<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - About</title>
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
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== ABOUT CONTENT - WIDER LAYOUT ===== -->
<div class="container">
    <!-- Main About Section -->
    <div class="about-grid">
        <div class="about-content">
            <h1 class="section-title" style="text-align: left; margin-top: 0;">About Us</h1>
            <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2rem;">
                Online Blood Donation Portal is Pakistan's premier online blood donation platform, 
                connecting donors with hospitals through a seamless, verified system. Our mission 
                is to eliminate blood shortages and save lives.
            </p>
            
            <div style="display: grid; gap: 2rem;">
                <div style="display: flex; gap: 1rem;">
                    <div style="font-size: 2rem;">❤️</div>
                    <div>
                        <h3 style="color: #e53e3e;">Compassion</h3>
                        <p>We believe every life matters. Our platform ensures no blood request goes unanswered.</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem;">
                    <div style="font-size: 2rem;">🔒</div>
                    <div>
                        <h3 style="color: #e53e3e;">Trust & Safety</h3>
                        <p>Every donor is verified and every transaction is tracked for complete transparency.</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem;">
                    <div style="font-size: 2rem;">⚡</div>
                    <div>
                        <h3 style="color: #e53e3e;">Efficiency</h3>
                        <p>Automated stock management ensures hospitals get blood when they need it most.</p>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem;">
                    <div style="font-size: 2rem;">👥</div>
                    <div>
                        <h3 style="color: #e53e3e;">Community</h3>
                        <p>We're building a community of heroes who save lives through regular donations.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="about-content">
            <h2 style="color: #e53e3e; margin-bottom: 2rem;">Our Impact</h2>
            <div class="about-stats">
                <div class="about-stat-card">
                    <div style="font-size: 3rem; font-weight: bold;">500+</div>
                    <div>Donors Registered</div>
                </div>
                <div class="about-stat-card">
                    <div style="font-size: 3rem; font-weight: bold;">1,200+</div>
                    <div>Lives Saved</div>
                </div>
                <div class="about-stat-card">
                    <div style="font-size: 3rem; font-weight: bold;">50+</div>
                    <div>Partner Hospitals</div>
                </div>
            </div>
            
            <div style="margin-top: 3rem; background: #f9f9f9; padding: 2rem; border-radius: 10px;">
                <h3 style="color: #e53e3e; margin-bottom: 1rem;">Our Locations</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <strong>Islamabad</strong><br>
                        Main Office
                    </div>
                    <div>
                        <strong>Lahore</strong><br>
                        Regional Hub
                    </div>
                    <div>
                        <strong>Karachi</strong><br>
                        Regional Hub
                    </div>
                    <div>
                        <strong>Rawalpindi</strong><br>
                        Blood Bank
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Partners Section -->
    <div style="margin: 4rem 0;">
        <h2 class="section-title">Our Partner Hospitals</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem;">
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                🏥<br>
                <strong>Aga Khan University Hospital</strong>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                🏥<br>
                <strong>Shifa International</strong>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                🏥<br>
                <strong>Jinnah Hospital Lahore</strong>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                🏥<br>
                <strong>CMH Rawalpindi</strong>
            </div>
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