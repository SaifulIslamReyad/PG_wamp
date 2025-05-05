<?php
session_start();
include('../db_connect.php');

if (isset($_GET['patient_id'])) {
    $_SESSION['patient_id'] = $_GET['patient_id']; // store it in session
}

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../index.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="../nav.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">   
</head>
<script src="https://cdn.tailwindcss.com"></script>
<script src="../js/index.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<body>
    <?php include "../navbar.php"  ?>
    <div class="dashboard-container">

        <div class="dashboard-card">
            <div class="dashboard-header">
                <div class="avatar-circle">
                    <span><?php echo strtoupper(substr($_SESSION['patient_name'], 0, 1)); ?></span>
                </div>
                <div class="welcome-text">
                    <h2><?php echo htmlspecialchars($_SESSION['patient_name']); ?></h2>
                </div>
            </div>

            <div class="patient-info-grid">
                <div><strong>📞 Phone:</strong> <?php echo htmlspecialchars($_SESSION['patient_phone']); ?></div>
                <div><strong>🎂 Date of birth:</strong> <?php echo htmlspecialchars($_SESSION['patient_dob']); ?></div>
                <div><strong>🚻 Gender:</strong> <?php echo htmlspecialchars($_SESSION['patient_gender']); ?></div>
                <div><strong>🏚️ Address: </strong> Gollamari, Khulna</div>
            </div>

            <div class="profile-actions">
                <a href="update_profile.php" class="update-btn"> ⚙️Update</a>
            </div>
        </div>

        <hr><hr>

        <div class="toggle-buttons">
            <button onclick="showSection('prescriptions')" class="active">View Prescriptions</button>
            <button onclick="showSection('appointments')">View Appointments</button>
        </div>

        <!-- Prescriptions Section -->
        <div id="prescriptions" class="section active">
            <?php
            $prescription_sql = "SELECT p.prescription_id, p.issued_date, d.doctor_name, d.qualification 
                                 FROM prescriptions p 
                                 JOIN appointments a ON p.prescription_id = a.appointment_no 
                                 JOIN doctors d ON a.doctor_id = d.doctor_id 
                                 WHERE a.patient_id = ?";
            $stmt = $conn->prepare($prescription_sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $prescriptions_result = $stmt->get_result();

            $all_prescriptions = [];
            while ($prescription = $prescriptions_result->fetch_assoc()) {
                $prescription_id = $prescription['prescription_id'];

                $med_sql = "SELECT m.medicine_name, pm.dosage, pm.before_after, pm.duration 
                            FROM prescribed_medicines pm 
                            JOIN medicines m ON pm.medicine_id = m.medicine_id 
                            WHERE pm.prescription_id = ?";
                $stmt_meds = $conn->prepare($med_sql);
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

            if (!empty($all_prescriptions)) {
                foreach ($all_prescriptions as $prescription) {
                    echo '<div class="prescription-card">';
                    // echo '<h3>Prescription ID: ' . htmlspecialchars($prescription['prescription_id']) . '</h3>';
                    echo '<p><strong>Issued Date:</strong> ' . htmlspecialchars($prescription['issued_date']) . '</p>';
                    echo '<p><strong>Doctor:</strong> ' . htmlspecialchars($prescription['doctor_name']) . ' (' . htmlspecialchars($prescription['qualification']) . ')</p>';
                    echo '<h4>Medicines:</h4>';
                    if (!empty($prescription['medicines'])) {
                        echo '<table class="medicine-table"><thead><tr><th>Medicine Name</th><th>Dosage</th><th>Before/After Meal</th><th>Duration</th></tr></thead><tbody>';
                        foreach ($prescription['medicines'] as $med) {
                            echo '<tr><td>' . htmlspecialchars($med['medicine_name']) . '</td><td>' . htmlspecialchars($med['dosage']) . '</td><td>' . htmlspecialchars($med['before_after']) . '</td><td>' . htmlspecialchars($med['duration']) . '</td></tr>';
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
            ?>
        </div>

        <!-- Appointments Section -->
        <div id="appointments" class="section">
            <?php
            $appt_sql = "SELECT a.appointment_no, a.problem, a.appointment_date, a.appointment_time, a.status, d.doctor_name, d.qualification 
                         FROM appointments a 
                         JOIN doctors d ON a.doctor_id = d.doctor_id 
                         WHERE a.patient_id = ? 
                         and a.status='appointed'
                         ORDER BY a.appointment_no DESC";
            $stmt = $conn->prepare($appt_sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($appointment = $result->fetch_assoc()) {
                echo '<div class="appointment-row">';
                
                echo '<span><strong>Problem:</strong> ' . htmlspecialchars($appointment['problem']) . '</span><br>';
                echo '<span><strong>Date:</strong> ' . htmlspecialchars($appointment['appointment_date']) . '</span><br>';
                echo '<span><strong>Time:</strong> ' . htmlspecialchars($appointment['appointment_time']) . '</span><br>';
                echo '<span><strong>Status:</strong> ' . htmlspecialchars($appointment['status']) . '</span><br>';
                echo '<span><strong>Doctor:</strong> ' . htmlspecialchars($appointment['doctor_name']) . ' (' . htmlspecialchars($appointment['qualification']) . ')</span>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Take Appointment Button -->
        <div class="takeapp">
            <a href="appointment/form.php?patient_id=<?php echo $patient_id; ?>">
                <i class="fas fa-capsules icon"></i> Take Appointment
            </a>
        </div>
        
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(id).classList.add('active');

            document.querySelectorAll('.toggle-buttons button').forEach(btn => {
                btn.classList.remove('active');
            });

            if (id === 'prescriptions') {
                document.querySelector('.toggle-buttons button:nth-child(1)').classList.add('active');
            } else {
                document.querySelector('.toggle-buttons button:nth-child(2)').classList.add('active');
            }
        }
    </script>


</body>
</html>
