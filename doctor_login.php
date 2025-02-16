<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['doctor_email'];
    $password = $_POST['doctor_password'];

    // Fetch doctor data from database
    $sql = "SELECT * FROM doctors WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        if (password_verify($password, $doctor['password'])) {
            $_SESSION['doctor_id'] = $doctor['id']; // Assuming the doctor_id is named 'id' in the table
            $_SESSION['doctor_name'] = $doctor['name'];
            $_SESSION['doctor_specialization'] = $doctor['specialization'];
            
            $doctor_id = $doctor['id'];
            header("Location: ${doctor_id}.html"); // Redirect to doctor-specific page
            exit();
        } else {
            echo "Invalid password. <a href='index.html'>Try again</a>";
        }
    } else {
        echo "Doctor not found. <a href='index.html'>Try again</a>";
    }
    
    $stmt->close();
}
$conn->close();
?>
