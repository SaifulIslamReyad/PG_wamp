<?php
include('../db_connect.php');

$doctor_name = $_POST['doctor_name'];
$doctor_email = $_POST['doctor_email'];
$doctor_password = $_POST['doctor_password'];
$mobile = $_POST['mobile'];
$qualification = $_POST['qualification'];
$registration_number = $_POST['registration_number'];
$specialization_ids = $_POST['specialization_id']; 
$chamber_address = $_POST['chamber_address'];

try {
    $stmt = $conn->prepare("INSERT INTO doctors (doctor_name, doctor_email, doctor_password, mobile, qualification, registration_number, chamber_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $doctor_name, $doctor_email, $doctor_password, $mobile, $qualification, $registration_number, $chamber_address);
    $stmt->execute();
    $doctor_id = $stmt->insert_id;
    $stmt->close();

    if (!empty($specialization_ids)) {
        $stmt = $conn->prepare("INSERT INTO doctor_specialization (doctor_id, specialization_id) VALUES (?, ?)");
        foreach ($specialization_ids as $specialization_id) {
            $stmt->bind_param("ii", $doctor_id, $specialization_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "<script>
        alert('Doctor registered successfully!');
        window.location.href = '../login/login.html';
    </script>";
} catch (Exception $e) {
    echo "<script>
        alert('Error: " . $e->getMessage() . "');
        window.location.href = 'doctor_signup_form.html';
    </script>";
}

$conn->close();
?>
