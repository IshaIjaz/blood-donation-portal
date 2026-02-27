<?php
session_start();
include("connection.php");

// Check admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $request_id = $_GET['id'];

    // Get request details
    $query = "SELECT * FROM blood_requests WHERE id='$request_id'";
    $result = mysqli_query($conn, $query);
    $request = mysqli_fetch_assoc($result);

    $blood_group = $request['blood_group'];
    $units = $request['units'];

    // Check available stock
    $stock_query = "SELECT units FROM blood_stock WHERE blood_group='$blood_group'";
    $stock_result = mysqli_query($conn, $stock_query);
    
    if(mysqli_num_rows($stock_result) > 0){
        $stock = mysqli_fetch_assoc($stock_result);
        
        if($stock['units'] >= $units){
            // Approve request
            mysqli_query($conn, "UPDATE blood_requests SET status='Approved' WHERE id='$request_id'");
            // Reduce stock
            mysqli_query($conn, "UPDATE blood_stock SET units = units - $units WHERE blood_group='$blood_group'");
        } else {
            // Not enough stock → Reject
            mysqli_query($conn, "UPDATE blood_requests SET status='Rejected' WHERE id='$request_id'");
        }
    } else {
        // Blood group not in stock → Reject
        mysqli_query($conn, "UPDATE blood_requests SET status='Rejected' WHERE id='$request_id'");
    }

    header("Location: admin_dashboard.php");
    exit();
}
?>