<?php
// Include database connection
include '../db_connect.php';

// Check database connection
if (!$conn) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Fetch doctors ordered by specialization and name
$sql = "SELECT doctor_id AS id, doctor_name AS name, specialization AS speciality FROM doctors ORDER BY specialization, doctor_name";
$result = $conn->query($sql);

// Store results in an array
$doctors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Set response header to JSON
header('Content-Type: application/json');
echo json_encode($doctors);

// Close database connection
$conn->close();
?>
