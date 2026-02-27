<?php
session_start();
include("connection.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Hospital'){
    header("Location: login.php");
    exit();
}

// Get hospital data
$hospital_id = $_SESSION['user_id'];
$hospital_query = "SELECT * FROM users WHERE id='$hospital_id'";
$hospital_result = mysqli_query($conn, $hospital_query);
$hospital_data = mysqli_fetch_assoc($hospital_result);

// Get stats
$total_query = "SELECT COUNT(*) as total FROM blood_requests WHERE hospital_id='$hospital_id'";
$total_result = mysqli_query($conn, $total_query);
$total_data = mysqli_fetch_assoc($total_result);
$total_requests = $total_data['total'];

$approved_query = "SELECT COUNT(*) as total FROM blood_requests WHERE hospital_id='$hospital_id' AND status='Approved'";
$approved_result = mysqli_query($conn, $approved_query);
$approved_data = mysqli_fetch_assoc($approved_result);
$approved_requests = $approved_data['total'];

$pending_query = "SELECT COUNT(*) as total FROM blood_requests WHERE hospital_id='$hospital_id' AND status='Pending'";
$pending_result = mysqli_query($conn, $pending_query);
$pending_data = mysqli_fetch_assoc($pending_result);
$pending_requests = $pending_data['total'];

$units_query = "SELECT SUM(units) as total FROM blood_requests WHERE hospital_id='$hospital_id' AND status='Approved'";
$units_result = mysqli_query($conn, $units_query);
$units_data = mysqli_fetch_assoc($units_result);
$units_received = $units_data['total'] ?: 0;

// Get blood stock
$stock_query = "SELECT * FROM blood_stock ORDER BY blood_group";
$stock_result = mysqli_query($conn, $stock_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Hospital Dashboard</title>
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
                <li><a href="hospital_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== DASHBOARD HEADER ===== -->
<section class="dashboard-header">
    <div class="container">
        <h2>Welcome, <?php echo $hospital_data['full_name']; ?>!</h2>
        <p>Hospital Dashboard</p>
    </div>
</section>

<!-- ===== DASHBOARD CONTENT ===== -->
<div class="container">
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Requests</h3>
            <div class="stat-number"><?php echo $total_requests; ?></div>
        </div>
        <div class="stat-card">
            <h3>Approved</h3>
            <div class="stat-number"><?php echo $approved_requests; ?></div>
        </div>
        <div class="stat-card">
            <h3>Pending</h3>
            <div class="stat-number"><?php echo $pending_requests; ?></div>
        </div>
        <div class="stat-card">
            <h3>Units Received</h3>
            <div class="stat-number"><?php echo $units_received; ?></div>
        </div>
    </div>
    
    <!-- Blood Stock Availability -->
    <div class="card">
        <h2 style="color: #e53e3e; margin-bottom: 1rem;">Blood Stock Availability</h2>
        <div class="blood-stock-grid">
            <?php
            while($stock = mysqli_fetch_assoc($stock_result)){
                $status = "";
                $statusClass = "";
                
                if($stock['units'] == 0){
                    $status = "Out of Stock";
                    $statusClass = "status-outofstock";
                } elseif($stock['units'] < 5){
                    $status = "Low Stock";
                    $statusClass = "status-lowstock";
                } else {
                    $status = "Available";
                    $statusClass = "status-available";
                }
                
                echo "<div class='blood-stock-card'>
                    <h4>{$stock['blood_group']}</h4>
                    <div class='units'>{$stock['units']} units</div>
                    <div class='status {$statusClass}'>{$status}</div>
                </div>";
            }
            ?>
        </div>
    </div>
    
    <!-- Two Column Layout -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
        <!-- Request Blood Form -->
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Request Blood</h2>
            <form method="POST" action="request_blood.php">
                <div class="form-group">
                    <label>Blood Group</label>
                    <select name="blood_group" id="request_blood_group" required>
                        <option value="">Select</option>
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
                
                <div class="form-group">
                    <label>Units</label>
                    <input type="number" name="units" id="request_units" min="1" value="1" required>
                </div>
                
                <button type="submit" name="request" id="requestBtn" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
        
        <!-- Request History -->
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Request History</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $history_query = "SELECT * FROM blood_requests WHERE hospital_id='$hospital_id' ORDER BY request_date DESC LIMIT 5";
                        $history_result = mysqli_query($conn, $history_query);
                        
                        if(mysqli_num_rows($history_result) > 0){
                            while($row = mysqli_fetch_assoc($history_result)){
                                $statusClass = "";
                                if($row['status'] == 'Approved') $statusClass = "approved";
                                elseif($row['status'] == 'Rejected') $statusClass = "rejected";
                                else $statusClass = "pending";
                                
                                echo "<tr>
                                    <td>" . date('m/d/Y', strtotime($row['request_date'])) . "</td>
                                    <td>{$row['blood_group']}</td>
                                    <td>{$row['units']}</td>
                                    <td><span class='status-badge {$statusClass}'>{$row['status']}</span></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center;'>No requests yet</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Quick Tips for Hospitals -->
                <div class="card" style="margin-top: 2rem; background: linear-gradient(135deg, #f6f7f8 0%, #edeff1 100%);">
                    <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                        <div style="font-size: 2.5rem;">💡</div>
                        <div>
                            <h3 style="color: #e53e3e; margin-bottom: 0.5rem;">Quick Tips for Hospitals</h3>
                            <p>• Request blood at least 24 hours before required</p>
                            <p>• Keep emergency contact numbers handy</p>
                            <p>• Regular stock checks help in better planning</p>
                        </div>
                     </div>
                    </div>
                </div>
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