<?php
include('../db_connect.php');

// Validate required form data
if (!isset($_POST['name'], $_POST['gender'], $_POST['preffered_appointment_date'], $_POST['doctor'])) {
    die("Error: Missing required fields.");
}

// Get form data
$name = trim($_POST['name']);
$NID = isset($_POST['NID']) ? trim($_POST['NID']) : '';
$birth_reg_no = isset($_POST['birth_reg_no']) ? trim($_POST['birth_reg_no']) : '';
$gender = $_POST['gender'];
$age = isset($_POST['age']) ? intval($_POST['age']) : null;
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$doctor_id = intval($_POST['doctor']);
$preffered_appointment_date = $_POST['preffered_appointment_date'];
$problem = isset($_POST['problem']) ? trim($_POST['problem']) : '';

// Check if patient exists using NID or Birth Reg No.
if (!empty($NID)) {
    $sql = "SELECT * FROM patients WHERE patient_NID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $NID);
} 
elseif (!empty($birth_reg_no)) {
    $sql = "SELECT * FROM patients WHERE patient_birth_reg_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $birth_reg_no);
} 
else {
    die("Error: Missing NID or Birth Reg No.");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Patient exists, fetch patient_id
    $patient = $result->fetch_assoc();
    $patient_id = $patient['patient_id'];
} else {
    // Insert new patient (Patient ID will be generated automatically)
    $stmt = $conn->prepare("INSERT INTO patients (patient_name, patient_NID, patient_birth_reg_no, patient_gender) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $NID, $birth_reg_no, $gender);
    if (!$stmt->execute()) {
        die("Error inserting patient: " . $stmt->error);
    }

    // Get the newly inserted patient's ID
    $patient_id = $conn->insert_id; // This automatically fetches the last inserted ID
}

// Insert appointment (Appointment ID will be generated automatically)
$stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, preffered_appointment_date, problem, phone) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $patient_id, $doctor_id, $preffered_appointment_date, $problem, $phone);

if ($stmt->execute()) {
    // Get the newly inserted appointment's ID
    $appointment_id = $conn->insert_id; // This automatically fetches the last inserted ID
    echo "Appointment booked successfully for Patient ID: $patient_id, Appointment ID: $appointment_id";
} else {
    echo "Error booking appointment: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
