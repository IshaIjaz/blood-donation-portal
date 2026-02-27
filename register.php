<?php
include("connection.php");

if(isset($_POST['register'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : NULL;

    $query = "INSERT INTO users (full_name, email, phone, password, role, blood_group, status) 
              VALUES ('$full_name', '$email', '$phone', '$password', '$role', '$blood_group', 'Pending')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Registration Successful! Please wait for Admin Approval');window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Register</title>
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
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="active">Register</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== REGISTER FORM ===== -->
<div class="container">
    <div class="form-container">
        <h2>Create Account</h2>
        <p>Join Online Blood Donation Portal as a donor or hospital</p>
        
        <form method="POST" action="register.php">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" id="full_name" placeholder="Your Name" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com" required>
            </div>
            
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" id="phone" placeholder="+92 300 1234567" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Min 6 characters" required>
            </div>
            
            <div class="form-group">
                <label>Role</label>
                <div class="radio-group">
                    <div>
                        <input type="radio" name="role" id="role_donor" value="Donor" required>
                        <label for="role_donor">Donor</label>
                    </div>
                    <div>
                        <input type="radio" name="role" id="role_hospital" value="Hospital" required>
                        <label for="role_hospital">Hospital</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group" id="blood_group_field" style="display: none;">
                <label>Blood Group</label>
                <select name="blood_group" id="blood_group">
                    <option value="">Select blood group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
        </form>
        
        <div class="form-footer">
            <p>Already have an account? <a href="login.php">Sign in</a></p>
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