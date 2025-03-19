<?php
include('../db_connect.php');

$sql = "SELECT specialization_id, specialization_name FROM specialization";
$result = $conn->query($sql);

$specializations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $specializations[] = $row;
    }
}

echo json_encode($specializations);
$conn->close();
?>
