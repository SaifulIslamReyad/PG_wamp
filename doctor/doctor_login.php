<?php
session_start();
include('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['doctor_email'];
    $password = $_POST['doctor_password'];

    // Fetch doctor data from database
    $sql = "SELECT * FROM doctors WHERE doctor_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        if ($password == $doctor['doctor_password']) {  // Verifying password without hashing
            //$_SESSION['doctor_id'] = $doctor['doctor_id']; // Assuming the doctor_id is 'doctor_id' in the table
            //$_SESSION['doctor_name'] = $doctor['doctor_name'];  // Assuming the doctor_name is 'doctor_name' in the table
            //$_SESSION['doctor_specialization'] = $doctor['specialization'];  // Assuming specialization is correct
            
            $doctor_id = $doctor['doctor_id'];
            $doctor_name = $doctor['doctor_name'];
            header("Location: ../${doctor_id}/dashboard.php"); // Redirect to doctor-specific page
            exit();
        } else {
            echo "<h2> Invalid password. <a href='../index.html'>Try again</a> </h2>";
        }
    } else {
        echo "Doctor not found. <a href='../index.php'>Signup as new doctor and Try again</a>";
    }
    
    $stmt->close();
}
$conn->close();
?>
