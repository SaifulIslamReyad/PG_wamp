<?php
include('db_connect.php');

$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

echo json_encode($doctors);

$conn->close();
?>
