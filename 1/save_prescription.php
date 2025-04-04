<?php
require_once "../db_connect.php"; // include your DB connection

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo "No input data";
    exit;
}

$appointment_no = intval($data["appointment_no"]);
$issued_date = $data["issued_date"];
$medicines = $data["medicines"];
$cc = $data["cc"];

// Insert into prescriptions table
$insertPrescription = $conn->prepare("INSERT INTO prescriptions (prescription_id, issued_date, cc) VALUES (?, ? , ?)");
$insertPrescription->bind_param("iss", $appointment_no, $issued_date, $cc);
if (!$insertPrescription->execute()) {
    echo "Failed to insert prescription";
    exit;
}

// Prepare statements
$selectMed = $conn->prepare("SELECT medicine_id FROM medicines WHERE medicine_name = ?");
// $insertMed = $conn->prepare("INSERT INTO medicines (medicine_name) VALUES (?)");
$insertPrescribed = $conn->prepare("INSERT INTO prescribed_medicines (prescription_id, medicine_id, dosage, before_after, duration) VALUES (?, ?, ?, ?, ?)");

// Loop through each medicine
foreach ($medicines as $med) {
    $medName = $med["name"];
    $dosage = $med["dosage"];
    $before_after = $med["before_after"];
    $duration = $med["duration"];

    // Check if medicine exists
    $selectMed->bind_param("s", $medName);
    $selectMed->execute();
    $selectMed->store_result();
    if ($selectMed->num_rows > 0) {
        $selectMed->bind_result($medicine_id);
        $selectMed->fetch();
    } else {
        // Insert new medicine
        $insertMed->bind_param("s", $medName);
        $insertMed->execute();
        $medicine_id = $insertMed->insert_id;
    }

    // Insert into prescribed_medicines
    $insertPrescribed->bind_param("iisss", $appointment_no, $medicine_id, $dosage, $before_after, $duration);
    $insertPrescribed->execute();
}

echo "Prescription saved successfully";

// Update appointment status to 'seen'
$updateStatus = $conn->prepare("UPDATE appointments SET status = 'Seen' WHERE appointment_no = ?");
$updateStatus->bind_param("i", $appointment_no);
if (!$updateStatus->execute()) {
    echo "Failed to update appointment status";
    exit;
}
?>
