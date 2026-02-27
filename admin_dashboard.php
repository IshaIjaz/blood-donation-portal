<?php
session_start();
include("connection.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin'){
    header("Location: login.php");
    exit();
}

// Get stats
$users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$donations_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM donations"))['total'];
$requests_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM blood_requests"))['total'];
$pending_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE status='Pending'"))['total'];

// Get blood stock total
$stock_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(units) as total FROM blood_stock"))['total'];

// Get all users
$users_query = "SELECT * FROM users ORDER BY id DESC";
$users_result = mysqli_query($conn, $users_query);

// Get pending donations
$pending_donations_query = "SELECT d.*, u.full_name FROM donations d 
                            JOIN users u ON d.donor_id = u.id 
                            WHERE d.status='Pending' 
                            ORDER BY d.donation_date DESC";
$pending_donations_result = mysqli_query($conn, $pending_donations_query);

// Get pending requests
$pending_requests_query = "SELECT r.*, u.full_name FROM blood_requests r 
                           JOIN users u ON r.hospital_id = u.id 
                           WHERE r.status='Pending' 
                           ORDER BY r.request_date DESC";
$pending_requests_result = mysqli_query($conn, $pending_requests_query);

// Get blood stock
$stock_query = "SELECT * FROM blood_stock ORDER BY blood_group";
$stock_result = mysqli_query($conn, $stock_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Donation Portal - Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-tabs {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
            border-bottom: 2px solid #e53e3e;
            padding-bottom: 0.5rem;
        }
        
        .admin-tab {
            padding: 0.8rem 1.5rem;
            background: none;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            position: relative;
        }
        
        .admin-tab.active {
            color: #e53e3e;
        }
        
        .admin-tab.active::after {
            content: '';
            position: absolute;
            bottom: -0.7rem;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #e53e3e;
            border-radius: 3px 3px 0 0;
        }
        
        .admin-tab:hover {
            color: #e53e3e;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .btn-action {
            padding: 0.3rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 4px;
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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="admin_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <button id="themeToggle" class="theme-btn">🌙</button>
    </div>
</header>

<!-- ===== DASHBOARD HEADER ===== -->
<section class="dashboard-header">
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome back, <?php echo $_SESSION['name']; ?>!</p>
    </div>
</section>

<!-- ===== DASHBOARD CONTENT ===== -->
<div class="container">
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <div class="stat-number"><?php echo $users_count; ?></div>
        </div>
        <div class="stat-card">
            <h3>Donations</h3>
            <div class="stat-number"><?php echo $donations_count; ?></div>
        </div>
        <div class="stat-card">
            <h3>Requests</h3>
            <div class="stat-number"><?php echo $requests_count; ?></div>
        </div>
        <div class="stat-card">
            <h3>Pending Approvals</h3>
            <div class="stat-number"><?php echo $pending_users; ?></div>
        </div>
        <div class="stat-card">
            <h3>Blood Groups</h3>
            <div class="stat-number"><?php echo $stock_total; ?> units</div>
        </div>
    </div>
    
    <!-- Admin Tabs -->
    <div class="admin-tabs">
        <button class="admin-tab active" onclick="showTab('users')">Users (<?php echo $users_count; ?>)</button>
        <button class="admin-tab" onclick="showTab('donations')">Donations (<?php echo $donations_count; ?>)</button>
        <button class="admin-tab" onclick="showTab('requests')">Requests (<?php echo $requests_count; ?>)</button>
        <button class="admin-tab" onclick="showTab('stock')">Blood Stock</button>
    </div>
    
    <!-- Users Tab -->
    <div id="users-tab" class="tab-content active">
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">All Users</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Blood Group</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        mysqli_data_seek($users_result, 0);
                        while($user = mysqli_fetch_assoc($users_result)){
                            $statusClass = "";
                            if($user['status'] == 'Approved') $statusClass = "approved";
                            elseif($user['status'] == 'Rejected') $statusClass = "rejected";
                            else $statusClass = "pending";
                            
                            echo "<tr>
                                <td>{$user['full_name']}</td>
                                <td>{$user['email']}</td>
                                <td>{$user['phone']}</td>
                                <td>" . ($user['blood_group'] ?: '—') . "</td>
                                <td><span class='status-badge {$statusClass}'>{$user['status']}</span></td>
                                <td class='action-buttons'>";
                            
                            if($user['status'] == 'Pending'){
                                echo "<a href='approve_user.php?id={$user['id']}' class='btn btn-sm btn-action'>Approve</a>";
                            }
                            
                            echo "<a href='delete_user.php?id={$user['id']}' class='btn btn-sm btn-action delete-confirm'>Delete</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Donations Tab -->
    <div id="donations-tab" class="tab-content">
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">All Donations</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Donor</th>
                            <th>Blood Group</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_donations = "SELECT d.*, u.full_name FROM donations d 
                                          JOIN users u ON d.donor_id = u.id 
                                          ORDER BY d.donation_date DESC";
                        $all_donations_result = mysqli_query($conn, $all_donations);
                        
                        while($donation = mysqli_fetch_assoc($all_donations_result)){
                            $statusClass = "";
                            if($donation['status'] == 'Approved') $statusClass = "approved";
                            elseif($donation['status'] == 'Rejected') $statusClass = "rejected";
                            else $statusClass = "pending";
                            
                            echo "<tr>
                                <td>" . date('m/d/Y', strtotime($donation['donation_date'])) . "</td>
                                <td>{$donation['full_name']}</td>
                                <td>{$donation['blood_group']}</td>
                                <td><span class='status-badge {$statusClass}'>{$donation['status']}</span></td>
                                <td class='action-buttons'>";
                            
                            if($donation['status'] == 'Pending'){
                                echo "<a href='approve_donation.php?id={$donation['id']}' class='btn btn-sm btn-action'>Approve</a>
                                      <a href='reject_donation.php?id={$donation['id']}' class='btn btn-sm btn-action'>Reject</a>";
                            }
                            
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Requests Tab -->
    <div id="requests-tab" class="tab-content">
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Blood Requests</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hospital</th>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_requests = "SELECT r.*, u.full_name FROM blood_requests r 
                                         JOIN users u ON r.hospital_id = u.id 
                                         ORDER BY r.request_date DESC";
                        $all_requests_result = mysqli_query($conn, $all_requests);
                        
                        while($request = mysqli_fetch_assoc($all_requests_result)){
                            $statusClass = "";
                            if($request['status'] == 'Approved') $statusClass = "approved";
                            elseif($request['status'] == 'Rejected') $statusClass = "rejected";
                            else $statusClass = "pending";
                            
                            echo "<tr>
                                <td>" . date('m/d/Y', strtotime($request['request_date'])) . "</td>
                                <td>{$request['full_name']}</td>
                                <td>{$request['blood_group']}</td>
                                <td>{$request['units']}</td>
                                <td><span class='status-badge {$statusClass}'>{$request['status']}</span></td>
                                <td class='action-buttons'>";
                            
                            if($request['status'] == 'Pending'){
                                echo "<a href='approve_request.php?id={$request['id']}' class='btn btn-sm btn-action'>Approve</a>
                                      <a href='reject_request.php?id={$request['id']}' class='btn btn-sm btn-action'>Reject</a>";
                            }
                            
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Blood Stock Tab -->
    <div id="stock-tab" class="tab-content">
        <div class="card">
            <h2 style="color: #e53e3e; margin-bottom: 1rem;">Blood Stock</h2>
            <div class="blood-stock-grid">
                <?php
                mysqli_data_seek($stock_result, 0);
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

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.admin-tab').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(tabName + '-tab').classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}
</script>

<script src="js/script.js"></script>
</body>
</html>