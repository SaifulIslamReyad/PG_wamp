<?php
include '../db_connect.php';

$sql = "SELECT medicine_name FROM medicines";
$result = $conn->query($sql);

$medicines = [];
while ($row = $result->fetch_assoc()) {
    $medicines[] = $row['medicine_name'];
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($medicines);
?>
