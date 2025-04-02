<?php
include('../db_connect.php');

$sql = "SELECT * FROM specializations";
$result = $conn->query($sql);

$specializations = [];
while ($row = $result->fetch_assoc()) {
    $specializations[] = $row;
}

echo json_encode($specializations);
?>
