<?php
session_start();
include("connection.php");

// Check if user is hospital
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Hospital'){
    header("Location: login.php");
    exit();
}

if(isset($_POST['request'])){
    $hospital_id = $_SESSION['user_id'];
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    // Insert blood request as pending
    $query = "INSERT INTO blood_requests (hospital_id, blood_group, units, status) 
              VALUES ('$hospital_id', '$blood_group', '$units', 'Pending')";

    if(mysqli_query($conn, $query)){
        echo "<script>
            alert('Request submitted! Waiting for Admin Approval');
            window.location='hospital_dashboard.php';
        </script>";
    } else {
        echo "Error: ".mysqli_error($conn);
    }
} else {
    header("Location: hospital_dashboard.php");
    exit();
}
?>