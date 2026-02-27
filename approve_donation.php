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

    // Get donation details
    $query = "SELECT * FROM donations WHERE id='$donation_id'";
    $result = mysqli_query($conn, $query);
    $donation = mysqli_fetch_assoc($result);

    $donor_id = $donation['donor_id'];
    $blood_group = $donation['blood_group'];

    // Update donation status to Approved
    mysqli_query($conn, "UPDATE donations SET status='Approved' WHERE id='$donation_id'");

    // Update blood stock
    $check = mysqli_query($conn, "SELECT * FROM blood_stock WHERE blood_group='$blood_group'");
    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn, "UPDATE blood_stock SET units = units + 1 WHERE blood_group='$blood_group'");
    } else {
        mysqli_query($conn, "INSERT INTO blood_stock (blood_group, units) VALUES ('$blood_group', 1)");
    }

    header("Location: admin_dashboard.php");
    exit();
}
?>