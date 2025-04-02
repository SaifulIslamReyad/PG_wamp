<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="dashboard-container">
        <?php
        session_start();
        include('../db_connect.php');
        if (isset($_SESSION['patient_id'])) {
            $patient_id = $_SESSION['patient_id'];
            echo "<h1>Welcome, " . $_SESSION['patient_name'] . "</h1>";
            echo "<p>Phone: " . $_SESSION['patient_phone'] . "</p>";
            echo "<p>Date of Birth: " . $_SESSION['patient_dob'] . "</p>";
            echo "<p>Gender: " . $_SESSION['patient_gender'] . "</p>";

            // Fetch all prescriptions
            $prescription_ids_sql = "SELECT p.prescription_id, p.issued_date, d.doctor_name, d.qualification FROM prescriptions p JOIN appointments a ON p.prescription_id = a.appointment_no JOIN doctors d ON a.doctor_id = d.doctor_id WHERE a.patient_id = ?";
            $stmt = $conn->prepare($prescription_ids_sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $prescriptions_result = $stmt->get_result();

            $all_prescriptions = [];
            while ($prescription = $prescriptions_result->fetch_assoc()) {
                $prescription_id = $prescription['prescription_id'];
                $medicines_sql = "SELECT m.medicine_name, pm.dosage, pm.before_after, pm.duration FROM prescribed_medicines pm JOIN medicines m ON pm.medicine_id = m.medicine_id WHERE pm.prescription_id = ?";
                $stmt_meds = $conn->prepare($medicines_sql);
                $stmt_meds->bind_param("i", $prescription_id);
                $stmt_meds->execute();
                $medicines_result = $stmt_meds->get_result();
                $medicines = [];
                while ($medicine = $medicines_result->fetch_assoc()) {
                    $medicines[] = $medicine;
                }
                $all_prescriptions[] = [
                    'prescription_id' => $prescription_id,
                    'issued_date' => $prescription['issued_date'],
                    'doctor_name' => $prescription['doctor_name'],
                    'qualification' => $prescription['qualification'],
                    'medicines' => $medicines
                ];
            }
            // echo "<pre>";
            // print_r($all_prescriptions);
            // echo "</pre>";


            echo '<div class="prescription-info">';
            if (!empty($all_prescriptions)) {
                foreach ($all_prescriptions as $prescription) {
                    echo '<div class="prescription-card">';
                    echo '<h3>Prescription ID: ' . htmlspecialchars($prescription['prescription_id']) . '</h3>';
                    echo '<p><strong>Issued Date:</strong> ' . htmlspecialchars($prescription['issued_date']) . '</p>';
                    echo '<p><strong>Doctor:</strong> ' . htmlspecialchars($prescription['doctor_name']) . ' (' . htmlspecialchars($prescription['qualification']) . ')</p>';
                    echo '<h4>Medicines:</h4>';
                    if (!empty($prescription['medicines'])) {
                        echo '<table class="medicine-table"><thead><tr><th>Medicine Name</th><th>Dosage</th><th>Before/After Meal</th><th>Duration</th></tr></thead><tbody>';
                        foreach ($prescription['medicines'] as $medicine) {
                            echo '<tr><td>' . htmlspecialchars($medicine['medicine_name']) . '</td><td>' . htmlspecialchars($medicine['dosage']) . '</td><td>' . htmlspecialchars($medicine['before_after']) . '</td><td>' . htmlspecialchars($medicine['duration']) . '</td></tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo '<p>No medicines prescribed.</p>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No previous prescriptions found.</p>';
            }
            echo '</div>';
        } else {
            header("Location: ../index.html");
            exit();
        }


        if (isset($_SESSION['patient_id'])) {
            $patient_id = $_SESSION['patient_id'];
        
            $sql = "SELECT a.appointment_no, a.problem, a.appointment_date, a.appointment_time, a.status, 
                d.doctor_name, d.qualification 
                FROM appointments a 
                JOIN doctors d ON a.doctor_id = d.doctor_id 
                WHERE a.patient_id = ? 
                ORDER BY a.appointment_no DESC";

            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            echo '<div class="appointments-container">';
        
            while ($appointment = $result->fetch_assoc()) {
                echo '<div class="appointment-row">';
                echo '<span><strong>Appointment No:</strong> ' . htmlspecialchars($appointment['appointment_no']) . '</span>';
                echo '<span><strong>Problem:</strong> ' . htmlspecialchars($appointment['problem']) . '</span>';
                echo '<span><strong>Date:</strong> ' . htmlspecialchars($appointment['appointment_date']) . '</span>';
                echo '<span><strong>Time:</strong> ' . htmlspecialchars($appointment['appointment_time']) . '</span>';
                echo '<span><strong>Status:</strong> ' . htmlspecialchars($appointment['status']) . '</span>';
                echo '<span><strong>Doctor:</strong> ' . htmlspecialchars($appointment['doctor_name']) . ' (' . htmlspecialchars($appointment['qualification']) . ')</span>';
                echo '</div>';
            }
        
            echo '</div>';
        } else {
            header("Location: ../index.html");
            exit();
        }

        ?>
        <div class="takeapp">
            <a href="appointment_form.php?patient_id=<?php echo $patient_id; ?>">Take Appointment</a>
        </div>

    </div>
</body>
</html>
