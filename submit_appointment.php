<?php
include('db_connect.php');

// Get form data
$name = $_POST['name'];
$NID = $_POST['NID'];
$birth_reg_no = $_POST['birth_reg_no'];
$gender = $_POST['gender'];
$doctor_id = $_POST['doctor'];
$appointment_date = $_POST['appointment_date'];

// Check if the patient exists using NID or Birth Reg No.
if (!empty($NID)) {
    $sql = "SELECT * FROM all_patients WHERE NID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $NID);
} else {
    $sql = "SELECT * FROM all_patients WHERE birth_reg_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $birth_reg_no);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Patient exists, fetch PGID
    $patient = $result->fetch_assoc();
    $pgID = $patient['pgID'];
} else {
    // Get the last pgID from the database (separate query)
    $sql = "SELECT COALESCE(MAX(pgID), 10000) + 1 AS new_pgID FROM all_patients";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $pgID = $row['new_pgID'];

    // Insert new patient with calculated pgID
    $stmt = $conn->prepare("INSERT INTO all_patients (name, NID, birth_reg_no, gender, pgID) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $NID, $birth_reg_no, $gender, $pgID);
    
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }
}

// Store the appointment with the assigned pgID
$stmt = $conn->prepare("INSERT INTO appointments (pgID, doctor_id, appointment_date) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $pgID, $doctor_id, $appointment_date);

if ($stmt->execute()) {
    echo "Appointment booked successfully for Patient ID: $pgID";
} else {
    echo "oh shit Error: " . $stmt->error;
}

// Redirect to confirmation page (optional)
// header('Location: appointment_confirmation.php');

$stmt->close();
$conn->close();
?>
