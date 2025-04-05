<?php
session_start();
include('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Fetch patient data from database
    $sql = "SELECT * FROM patients WHERE patient_phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        if ($password == $patient['patient_password']) { 
            $_SESSION['patient_id'] = $patient['patient_id'];
            $_SESSION['patient_name'] = $patient['patient_name'];
            $_SESSION['patient_phone'] = $patient['patient_phone'];
            $_SESSION['patient_dob'] = $patient['patient_dob'];
            $_SESSION['patient_gender'] = $patient['patient_gender'];

            header("Location: ./dash.php");
            exit();
        } else {
            echo "<h2> Invalid password. <a href='../index.html'>HOME</a> </h2>";
        }
    } else {
        echo "Patient not found. <a href='../index.html'>HOME</a>";
    }
    
    $stmt->close();
}
$conn->close();
?>
