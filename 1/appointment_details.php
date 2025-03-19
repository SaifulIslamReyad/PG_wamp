<?php
include('../db_connect.php'); // Include the database connection

// Get the appointment number from the URL
$appointment_no = isset($_GET['appointment_no']) ? $_GET['appointment_no'] : '';

// Fetch appointment, patient, and medicine details based on appointment_no
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

// Check if the appointment exists
if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
} else {
    echo "No appointment found!";
    exit;
}

// Fetch medicines related to the appointment
$sql_medicines = "SELECT fm.medicine_name, m.dosage, m.before_after, m.duration
                  FROM medicines m
                  JOIN favourite_medicines fm ON m.medicine_id = fm.medicine_id
                  WHERE m.appointment_no = ?";
$stmt_medicines = $conn->prepare($sql_medicines);
$stmt_medicines->bind_param("i", $appointment_no);
$stmt_medicines->execute();
$result_medicines = $stmt_medicines->get_result();
$medicines = [];
while ($medicine = $result_medicines->fetch_assoc()) {
    $medicines[] = $medicine;
}

$stmt->close();
$stmt_medicines->close();
$conn->close();

// Pass the data to the HTML page (use variables)
include('appointment_details.html');
?>
