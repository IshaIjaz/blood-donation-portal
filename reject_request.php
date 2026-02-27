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

    // Update request status to Rejected
    mysqli_query($conn, "UPDATE blood_requests SET status='Rejected' WHERE id='$request_id'");

    header("Location: admin_dashboard.php");
    exit();
}
?>