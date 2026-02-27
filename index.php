<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional attractive styles for hero section */
        .hero {
            background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
            position: relative;
            overflow: hidden;
            padding: 4rem 20px;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(229,62,62,0.1) 0%, rgba(229,62,62,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(229,62,62,0.08) 0%, rgba(229,62,62,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            font-size: 4rem;
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(229,62,62,0.2);
        }
        
        .hero-text {
            font-size: 1.3rem;
            color: #4a5568;
            margin-bottom: 2.5rem;
            max-width: 600px;
            line-height: 1.8;
            position: relative;
            padding-left: 1.5rem;
            border-left: 4px solid #e53e3e;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        
        .hero-buttons .btn-primary {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            box-shadow: 0 10px 20px rgba(229,62,62,0.3);
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero-buttons .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .hero-buttons .btn-primary:hover::before {
            left: 100%;
        }
        
        .hero-buttons .btn-secondary {
            background: transparent;
            border: 2px solid #e53e3e;
            color: #e53e3e;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .hero-buttons .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: #e53e3e;
            transition: width 0.3s;
            z-index: -1;
        }
        
        .hero-buttons .btn-secondary:hover {
            color: white;
        }
        
        .hero-buttons .btn-secondary:hover::before {
            width: 100%;
        }
        
        .hero-image {
            position: relative;
            z-index: 1;
        }
        
        .blood-drop-icon {
            font-size: 12rem;
            animation: pulse 2s infinite, float 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 20px rgba(229,62,62,0.3));
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .floating-drops {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }
        
        .floating-drops span {
            position: absolute;
            font-size: 2rem;
            opacity: 0.2;
            animation: floatDrop 8s linear infinite;
        }
        
        .floating-drops span:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-drops span:nth-child(2) {
            top: 30%;
            right: 15%;
            animation-delay: 2s;
            font-size: 3rem;
        }
        
        .floating-drops span:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        .floating-drops span:nth-child(4) {
            bottom: 40%;
            right: 25%;
            animation-delay: 6s;
            font-size: 2.5rem;
        }
        
        @keyframes floatDrop {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.2;
            }
            50% {
                transform: translateY(-30px) rotate(10deg);
                opacity: 0.3;
            }
            100% {
                transform: translateY(-60px) rotate(20deg);
                opacity: 0;
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }
            
            .hero-text {
                font-size: 1.1rem;
            }
            
            .hero-buttons .btn-primary,
            .hero-buttons .btn-secondary {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .hero-buttons .btn-primary,
            .hero-buttons .btn-secondary {
                width: 100%;
                text-align: center;
            }
        }
    </style>
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
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== HERO SECTION - UPDATED ATTRACTIVE VERSION ===== -->
<!-- ===== HERO SECTION - FULL WIDTH ATTRACTIVE VERSION ===== -->
<section class="hero">
    <!-- Floating blood drops for visual effect -->
    <div class="floating-drops">
        <span>🩸</span>
        <span>🩸</span>
        <span>🩸</span>
        <span>🩸</span>
    </div>
    
    <div class="hero-container">
        <div class="hero-content">
            <h1>Donate Blood,<br>Save Lives</h1>
            <p class="hero-text">
                Online Blood Donation Portal bridges the gap between generous donors 
                and hospitals in need. Every drop counts become a hero today.
            </p>
            <div class="hero-buttons">
                <a href="register.php" class="btn btn-primary">Become a Donor</a>
                <a href="login.php" class="btn btn-secondary">Login</a>
            </div>
            
            <!-- Small stats or trust indicators -->
            <div style="display: flex; gap: 2rem; margin-top: 3rem;">
                <div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #e53e3e;">500+</div>
                    <div style="font-size: 0.9rem; color: #718096;">Donors</div>
                </div>
                <div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #e53e3e;">50+</div>
                    <div style="font-size: 0.9rem; color: #718096;">Hospitals</div>
                </div>
                <div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #e53e3e;">1200+</div>
                    <div style="font-size: 0.9rem; color: #718096;">Lives Saved</div>
                </div>
            </div>
        </div>
        
        <div class="hero-image">
            <div class="blood-drop-icon">🩸</div>
            
            <!-- Animated pulse rings -->
            <div style="position: relative; width: 200px; height: 200px; margin: 0 auto;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100px; height: 100px; border-radius: 50%; background: rgba(229,62,62,0.1); animation: pulse 2s infinite;"></div>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 150px; height: 150px; border-radius: 50%; border: 2px solid rgba(229,62,62,0.2); animation: pulse 2s infinite 0.5s;"></div>
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 200px; height: 200px; border-radius: 50%; border: 2px solid rgba(229,62,62,0.1); animation: pulse 2s infinite 1s;"></div>
            </div>
        </div>
    </div>
</section>

<!-- ===== REST OF THE PAGE REMAINS SAME ===== -->
<!-- ===== HOW IT WORKS SECTION ===== -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title">How It Works</h2>
        <p class="section-subtitle">
            Our platform makes blood donation simple, transparent, and efficient.
        </p>

        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon">📝</div>
                <h3>Easy Donation</h3>
                <p>Register and submit donation requests in minutes</p>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e53e3e;">
                    <span style="color: #e53e3e; font-weight: 600;">❤️ Save Lives</span>
                    <p style="margin-top: 0.5rem; font-size: 0.9rem;">Connect with those who need your blood group</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon">🏥</div>
                <h3>Hospital Access</h3>
                <p>Hospitals can request blood directly from our stock</p>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e53e3e;">
                    <span style="color: #e53e3e; font-weight: 600;">✓ Admin Verified</span>
                    <p style="margin-top: 0.5rem; font-size: 0.9rem;">Every donation and request is verified by admin</p>
                </div>
            </div>

            <!-- Feature 3 (Additional - to maintain grid balance) -->
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Quick Response</h3>
                <p>Emergency blood requests processed within hours</p>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e53e3e;">
                    <span style="color: #e53e3e; font-weight: 600;">🚑 24/7 Service</span>
                    <p style="margin-top: 0.5rem; font-size: 0.9rem;">Always available for emergencies</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Real-time Tracking</h3>
                <p>Monitor your donations and requests in real-time</p>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e53e3e;">
                    <span style="color: #e53e3e; font-weight: 600;">📱 Mobile Friendly</span>
                    <p style="margin-top: 0.5rem; font-size: 0.9rem;">Access from any device, anywhere</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to Make a Difference?</h2>
        <p>
            Join thousands of donors and hospitals working together to ensure no 
            one goes without blood.
        </p>
        <a href="register.php" class="btn btn-primary btn-large" style="color: white !important;">Get Started Now</a>
        
        <!-- Small stats row for social proof -->
        <div style="display: flex; justify-content: center; gap: 3rem; margin-top: 3rem; flex-wrap: wrap;">
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold;">10,000+</div>
                <div style="font-size: 0.9rem; opacity: 0.8;">Donations</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold;">5,000+</div>
                <div style="font-size: 0.9rem; opacity: 0.8;">Happy Donors</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold;">100+</div>
                <div style="font-size: 0.9rem; opacity: 0.8;">Cities</div>
            </div>
        </div>
    </div>
</section>
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