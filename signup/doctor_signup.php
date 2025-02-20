<?php
include('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $password = $_POST['doctor_password'];
    $specialization = $_POST['doctor_specialization'];
    $mobile = $_POST['mobile'];
    $qualification = $_POST['qualification'];
    $registration_number = $_POST['registration_number'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new doctor into the database
    // Updated code with correct column names
    $sql = "INSERT INTO doctors (doctor_name, doctor_email, doctor_password, specialization, mobile, qualification, registration_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $email, $hashed_password, $specialization, $mobile, $qualification, $registration_number);

    if ($stmt->execute()) {
        echo "Doctor signed up successfully. <a href='../index.html'>Login Now</a>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo "Try again. <a href='doctor_signup.php'>Go back</a>";
    }

    $stmt->close();
}
$conn->close();
?>
