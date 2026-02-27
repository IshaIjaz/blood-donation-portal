<?php
session_start();
include("connection.php");

// Only Admin can access
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin'){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $user_id = $_GET['id'];

    // Update user status to Approved
    mysqli_query($conn, "UPDATE users SET status='Approved' WHERE id='$user_id'");

    header("Location: admin_dashboard.php");
    exit();
}
?>