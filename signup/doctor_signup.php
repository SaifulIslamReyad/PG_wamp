<?php
include('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $password = $_POST['doctor_password'];
    $specialization_id = $_POST['specialization_id'];  // Fetch the selected specialization ID
    $mobile = $_POST['mobile'];
    $qualification = $_POST['qualification'];
    $registration_number = $_POST['registration_number'];

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO doctors (doctor_name, doctor_email, doctor_password, specialization_id, mobile, qualification, registration_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssisss", $name, $email, $hashed_password, $specialization_id, $mobile, $qualification, $registration_number);
    $stmt->bind_param("sssisss", $name, $email, $password, $specialization_id, $mobile, $qualification, $registration_number);

    if ($stmt->execute()) {
        echo "Doctor signed up successfully <a href='../index.html'>Login Now</a>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo "Try again. <a href='doctor_signup.html'>Log in now</a>";
    }

    $stmt->close();
    
}
$conn->close();
?>
