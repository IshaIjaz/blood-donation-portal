<?php
session_start();
include("connection.php");

// Check admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $donation_id = $_GET['id'];

    // Update donation status to Rejected
    mysqli_query($conn, "UPDATE donations SET status='Rejected' WHERE id='$donation_id'");

    header("Location: admin_dashboard.php");
    exit();
}
?>