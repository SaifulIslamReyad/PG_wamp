<?php
include('../db_connect.php');

if (isset($_GET['specialization_id'])) {
    $specialization_id = $_GET['specialization_id'];

    $sql = "SELECT d.doctor_id, d.doctor_name 
            FROM doctors d
            JOIN doctor_specialization ds ON d.doctor_id = ds.doctor_id
            WHERE ds.specialization_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $specialization_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    echo json_encode($doctors);
} else {
    echo json_encode([]);
}
?>
