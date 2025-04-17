<?php
include('../../db_connect.php');
session_start();

// Check if patient_id is received from POST
if (isset($_POST['patient_id'])) {
    $patient_id = intval($_POST['patient_id']);
} else {
    die("Error: Missing patient ID.");
}

// Validate form data
if (!isset($_POST['doctor_id'], $_POST['problem'], $_POST['appointment_date'])) {
    die("Error: Missing required fields.");
}

// Get form data
$doctor_id = intval($_POST['doctor_id']);
$problem = trim($_POST['problem']);
$appointment_date = $_POST['appointment_date'];
$appointment_time = "09:00 PM"; // Hardcoded for now

// Insert appointment data into the database
$stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, problem, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $patient_id, $doctor_id, $problem, $appointment_date, $appointment_time);

if ($stmt->execute()) {
    echo "<script>
        alert('Appointment successfully booked!!');
        window.location.href = '../dash.php?patient_id={$patient_id}';
    </script>";
    exit();
} else {
    $errorMsg = $stmt->error;
    echo "<script>
        alert('Appointment booking failed! Error: {$errorMsg}');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
