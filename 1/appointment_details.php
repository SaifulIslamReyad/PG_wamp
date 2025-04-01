<?php
include('../db_connect.php'); 

$appointment_no = isset($_GET['appointment_no']) ? $_GET['appointment_no'] : '';

$sql = "SELECT 
            a.appointment_no, 
            p.patient_name, 
            a.phone, 
            p.patient_gender, 
            p.patient_NID, 
            a.problem, 
            a.appointment_date, 
            a.appointment_time, 
            a.status, 
            a.doctor_id
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        WHERE a.appointment_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
} else {
    echo "No appointment found!";
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment & Prescription Details</title>

</head>
<body>
    <div class="container">
        <div class="left-div">
            <h2>Patient Information</h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($appointment['patient_name']) ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($appointment['patient_gender']) ?></p>
            <p><strong>NID:</strong> <?= htmlspecialchars($appointment['patient_NID']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($appointment['phone']) ?></p>
            <p><strong>Problem:</strong> <?= htmlspecialchars($appointment['problem']) ?></p>
            <p><strong>Appointment Date:</strong> <?= htmlspecialchars($appointment['appointment_date']) ?></p>
            <p><strong>Appointment Time:</strong> <?= htmlspecialchars($appointment['appointment_time']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($appointment['status']) ?></p>

         
            <a href="dashboard.html">Back to Dashboard</a>
        </div>

    </div>

</body>
</html>
