<?php
session_start();
include("connection.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Donor'){
    header("Location: login.php");
    exit();
}

// Get donor data
$donor_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id='$donor_id'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

// Get stats
$total_query = "SELECT COUNT(*) as total FROM donations WHERE donor_id='$donor_id'";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_donations = $total_data['total'];

$approved_query = "SELECT COUNT(*) as total FROM donations WHERE donor_id='$donor_id' AND status='Approved'";
$approved_result = mysqli_query($conn, $approved_query);
$approved_data = mysqli_fetch_assoc($approved_result);
$approved_donations = $approved_data['total'];

$pending_query = "SELECT COUNT(*) as total FROM donations WHERE donor_id='$donor_id' AND status='Pending'";
$pending_result = mysqli_query($conn, $pending_query);
$pending_data = mysqli_fetch_assoc($pending_result);
$pending_donations = $pending_data['total'];

$lives_saved = $approved_donations * 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Donor Dashboard</title>
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
                <li><a href="donor_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== DASHBOARD HEADER ===== -->
<section class="dashboard-header">
    <div class="container">
        <h2>Welcome, <?php echo explode(' ', $user_data['full_name'])[0]; ?>!</h2>
        <p>Blood Group: <strong><?php echo $user_data['blood_group']; ?></strong></p>
    </div>
</section>

<!-- ===== DASHBOARD CONTENT ===== -->
<div class="container">
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Donations</h3>
            <div class="stat-number"><?php echo $total_donations; ?></div>
        </div>
        <div class="stat-card">
            <h3>Approved</h3>
            <div class="stat-number"><?php echo $approved_donations; ?></div>
        </div>
        <div class="stat-card">
            <h3>Pending</h3>
            <div class="stat-number"><?php echo $pending_donations; ?></div>
        </div>
        <div class="stat-card">
            <h3>Lives Saved</h3>
            <div class="stat-number"><?php echo $lives_saved; ?></div>
        </div>
    </div>
    <div style="text-align: center; margin-bottom: 2rem;">
        <p class="stat-note">Each donation saves up to 3 lives ❤️</p>
    </div>
    
    <!-- Two Column Layout -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Donation History -->
        <div class="card" style="padding: 1.5rem;">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Donation History</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Blood Group</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $history_query = "SELECT * FROM donations WHERE donor_id='$donor_id' ORDER BY donation_date DESC";
                        $history_result = mysqli_query($conn, $history_query);
                        
                        if(mysqli_num_rows($history_result) > 0){
                            while($row = mysqli_fetch_assoc($history_result)){
                                $statusClass = "";
                                if($row['status'] == 'Approved') $statusClass = "approved";
                                elseif($row['status'] == 'Rejected') $statusClass = "rejected";
                                else $statusClass = "pending";
                                
                                echo "<tr>
                                    <td>" . date('m/d/Y', strtotime($row['donation_date'])) . "</td>
                                    <td>{$row['blood_group']}</td>
                                    <td><span class='status-badge {$statusClass}'>{$row['status']}</span></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' style='text-align:center;'>No donations yet</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Donate Blood Form -->
        <div class="card" style="padding: 1.5rem;">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Donate Blood</h2>
            <form method="POST" action="donate_blood.php" id="donateForm">
                <div class="form-group">
                    <label>Your Blood Group</label>
                    <input type="text" value="<?php echo $user_data['blood_group']; ?>" disabled>
                    <input type="hidden" name="blood_group" value="<?php echo $user_data['blood_group']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Donation Date</label>
                    <input type="date" name="donation_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                
                <button type="submit" name="donate" class="btn btn-primary" style="width: 100%;">Donate Blood</button>
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