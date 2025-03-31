<?php
include('../db_connect.php');

$doctor_name = $_POST['doctor_name'];
$doctor_email = $_POST['doctor_email'];
$doctor_password = $_POST['doctor_password'];
$mobile = $_POST['mobile'];
$qualification = $_POST['qualification'];
$registration_number = $_POST['registration_number'];
$specialization_ids = $_POST['specialization_id']; // Array of specializations

try {
    // ✅ Hash the password using BCRYPT
    $hashed_password = password_hash($doctor_password, PASSWORD_BCRYPT);

    // Insert doctor data
    $stmt = $conn->prepare("INSERT INTO doctors (doctor_name, doctor_email, doctor_password, mobile, qualification, registration_number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $doctor_name, $doctor_email, $hashed_password, $mobile, $qualification, $registration_number);
    $stmt->execute();
    $doctor_id = $stmt->insert_id;
    $stmt->close();

    // Insert into doctor_specialization
    if (!empty($specialization_ids)) {
        $stmt = $conn->prepare("INSERT INTO doctor_specialization (doctor_id, specialization_id) VALUES (?, ?)");
        foreach ($specialization_ids as $specialization_id) {
            $stmt->bind_param("ii", $doctor_id, $specialization_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "Doctor registered successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
