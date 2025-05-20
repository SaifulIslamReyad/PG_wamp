<?php
include('../db_connect.php');

$patient_name = $_POST['name'];
$patient_dob = $_POST['dob'];
$patient_phone = $_POST['phone'];
$patient_gender = $_POST['gender'];
$patient_password = $_POST['password'];

try {
    $stmt = $conn->prepare("INSERT INTO patients (patient_name, patient_phone, patient_password, patient_dob, patient_gender) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $patient_name, $patient_phone, $patient_password, $patient_dob, $patient_gender);
    $stmt->execute();
    $stmt->close();
    echo "<script>
        alert('Patient registered successfully!');
        window.location.href = 'patient_login_form.php';
    </script>";
} catch (Exception $e) {"
    <script>
        alert('Error: " . $e->getMessage() . "');
        window.location.href = 'signup.php';
    </script>";
}

$conn->close();
?>

