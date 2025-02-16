<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $password = $_POST['doctor_password'];
    $specialization = $_POST['doctor_specialization'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new doctor into the database
    $sql = "INSERT INTO doctors (name, email, password, specialization) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $specialization);

    if ($stmt->execute()) {
        echo "Doctor signed up successfully. <a href='index.html'>Login Now</a>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo "Try again. <a href='doctor_signup.php'>Go back</a>";
    }

    $stmt->close();
}
$conn->close();
?>
