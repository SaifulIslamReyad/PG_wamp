<?php
include('../../db_connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch doctors and their specializations
$sql = "
    SELECT d.doctor_id, d.doctor_name, d.doctor_email, d.mobile,
           d.qualification, d.registration_number, d.chamber_address,
           GROUP_CONCAT(s.specialization_name) AS specializations
    FROM doctors d
    LEFT JOIN doctor_specialization ds ON d.doctor_id = ds.doctor_id
    LEFT JOIN specializations s ON s.specialization_id = ds.specialization_id
    GROUP BY d.doctor_id
";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Create an array to store doctors
    $doctors = [];

    // Loop through the results and store each row in the array
    while ($row = $result->fetch_assoc()) {
        $row['specializations'] = explode(',', $row['specializations']);
        $doctors[] = $row;
    }

    // Return the doctors data as JSON
    echo json_encode(['doctors' => $doctors]);
} else {
    // If no doctors are found, return an empty array
    echo json_encode(['doctors' => []]);
}

$conn->close();
?>
