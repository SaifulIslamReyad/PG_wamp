<?php
include('../db_connect.php');

// Fetch appointments for doctor_id = 1, group by appointment_date
$sql = "SELECT 
            a.appointment_no, 
            p.patient_name, 
            p.patient_phone,
            a.problem, 
            a.status, 
            a.appointment_date
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        WHERE a.doctor_id = 1 and a.status='appointed'
        ORDER BY a.appointment_date ASC";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Create an array to store appointments
    $appointments = [];

    // Loop through the results and store each row in the array
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
} else {
    $appointments = [];
}

$conn->close();

// Convert the appointments array to JSON format to be used in JavaScript
echo json_encode($appointments);
?>
