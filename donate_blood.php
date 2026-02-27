<?php
session_start();
include("connection.php");

// Check if user is donor
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Donor'){
    header("Location: login.php");
    exit();
}

if(isset($_POST['donate'])){
    $donor_id = $_SESSION['user_id'];
    $donation_date = $_POST['donation_date'];
    
    // Get donor's blood group
    $bg_query = "SELECT blood_group FROM users WHERE id='$donor_id'";
    $bg_result = mysqli_query($conn, $bg_query);
    $bg_data = mysqli_fetch_assoc($bg_result);
    $blood_group = $bg_data['blood_group'];

    // Insert donation as pending with blood group
    $query = "INSERT INTO donations (donor_id, blood_group, donation_date, status) 
              VALUES ('$donor_id', '$blood_group', '$donation_date', 'Pending')";

    if(mysqli_query($conn, $query)){
        echo "<script>
            alert('Donation submitted! Waiting for Admin Approval');
            window.location='donor_dashboard.php';
        </script>";
    } else {
        echo "Error: ".mysqli_error($conn);
    }
} else {
    header("Location: donor_dashboard.php");
    exit();
}
?>