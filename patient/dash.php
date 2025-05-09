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

<script>
  function toggleMenu() {
      const menu = document.getElementById('dropdownMenu');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }

    // Optional: Close the menu if clicked outside
    window.addEventListener('click', function(e) {
      const menu = document.getElementById('dropdownMenu');
      if (!e.target.matches('.dots-button')) {
        menu.style.display = 'none';
      }
    });
</script>

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
                        <div class="menu-container">
                            <button class="dots-button" onclick="toggleMenu()">⋮</button>
                            <div class="dropdown-menu" id="dropdownMenu">
                            <button onclick="location.href='add-prescription.php'">🥼 Profile</button>
                            <button onclick="location.href='add-prescription.php'">⚙️Update Profile</button>
                            <!-- <button onclick="location.href='add-prescription.php'">🔄 Switch Chamber</button> -->
                            <button onclick="location.href='add-prescription.php'">🖇️ Images</button>
                            <button onclick="location.href='add-prescription.php'">📷 Add Image</button>
                            <button onclick="location.href='add-prescription.php'">👨‍🦼 All Doctors</button>
                            <!-- <button onclick="location.href='add-prescription.php'">➕ Create Patient</button> -->
                            <button onclick="location.href='add-prescription.php'">✨ Seen List</button>
                            <button onclick="location.href='add-prescription.php'">🖇 Follow-up List</button>
                            <!-- <button onclick="location.href='add-prescription.php'">🫖 Holiday</button> -->
                            <button onclick="location.href='add-prescription.php'">📞 Call settings</button>
                            <!-- <button onclick="location.href='add-prescription.php'">💊 Templates</button> -->
                            <!-- <button onclick="location.href='add-prescription.php'">➕ Add Templates</button> -->
                            <!-- <button onclick="location.href='add-prescription.php'">🛠 Edit Prescription</button> -->
                            <button onclick="location.href='add-prescription.php'">📤 Log out</button>
                            </div>
                        </div>
                
            </div>

            <div class="patient-info-grid">
                <div><strong>📞 Phone:</strong> <?php echo htmlspecialchars($_SESSION['patient_phone']); ?></div>
                <div><strong>🎂 Date of birth:</strong> <?php echo htmlspecialchars($_SESSION['patient_dob']); ?></div>
                <div><strong>🚻 Gender:</strong> <?php echo htmlspecialchars($_SESSION['patient_gender']); ?></div>
                <div><strong>🏚️ Address: </strong> Gollamari, Khulna</div>
            </div>

            <!-- <div class="profile-actions">
                <a href="update_profile.php" class="update-btn"> ⚙️Update</a>
            </div> -->
        </div>

        <hr><hr>

        <div class="toggle-buttons">
            <button onclick="showSection('prescriptions')" class="active">View Prescriptions</button>
            <button onclick="showSection('appointments')">View Appointments</button>
        </div>

        <!-- Prescriptions Section -->
 
        <div id="prescriptions" class="section active">
            <form class="filter-form" onsubmit="event.preventDefault(); filterPrescriptions();">

                <input type="text" id="filter_doctor" class="find" placeholder="Filter by doctor" />
                <input type="text" id="filter_problem" class="find" placeholder="Filter by CC" />
                <div class="input-group">
                    <label for="filter_date">Filter by date</label>
                    <input type="date" id="filter_date" class="find" />
                </div>
                <!-- <button type="submit" class="hide-btn">🔍 Filter</button> -->
            </form>
            <?php
            $prescription_sql = "SELECT p.prescription_id, p.issued_date, p.cc, d.doctor_name, d.qualification 
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
                    'cc' => $prescription['cc'],
                    'medicines' => $medicines
                ];
            }

            if (!empty($all_prescriptions)) {
                foreach ($all_prescriptions as $prescription) {
                    echo '<div class="prescription-card">';
                    echo '<h3><strong>Chief Complaint:</strong>  ' . htmlspecialchars($prescription['cc']) . '</h3>';
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
                    echo '<div class="button-container">
                            <button class="hide-btn">👀 HIDE</button>
                            <button class="hide-btn"> ✨ DETAILS </button>

                        </div>';
                    echo '</div>';

                }
            } else {
                echo '<p>No previous prescriptions found.</p>';
            }
            ?>
        </div>

        <!-- Appointments Section -->


        <div id="appointments" class="section">
        <form class="filter-form" onsubmit="event.preventDefault(); filterPrescriptions();">
                
                <input type="text" id="filter_doctor" class="find" placeholder="Filter by doctor" />
                <input type="text" id="filter_problem" class="find" placeholder="Filter by Problem" />
                <div class="input-group">
                    <label for="filter_date">Filter by date</label>
                    <input type="date" id="filter_date" class="find" />
                </div>
                <!-- <button type="submit" class="hide-btn">🔍 Filter</button> -->
            </form>
            <?php
                $appt_sql = "SELECT a.appointment_no, a.problem, a.appointment_date, a.appointment_time, a.status, a.doctor_id, d.doctor_name, d.qualification 
                FROM appointments a 
                JOIN doctors d ON a.doctor_id = d.doctor_id 
                WHERE a.patient_id = ? 
                AND a.status = 'appointed'
                ORDER BY a.appointment_no DESC";

                $stmt = $conn->prepare($appt_sql);
                $stmt->bind_param("i", $patient_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($appointment = $result->fetch_assoc()) {
                $doctor_id = $appointment['doctor_id'];
                $appointment_no = $appointment['appointment_no'];
                $appointment_date = $appointment['appointment_date'];

                $serial_sql = "SELECT COUNT(*) + 1 AS serial
                                FROM appointments
                                WHERE doctor_id = ?
                                AND status = 'appointed'
                                AND appointment_date = ?
                                AND appointment_no < ?";

                $serial_stmt = $conn->prepare($serial_sql);
                $serial_stmt->bind_param("isi", $doctor_id, $appointment_date, $appointment_no);
                $serial_stmt->execute();
                $serial_result = $serial_stmt->get_result();
                $row = $serial_result->fetch_assoc();
                $serial = $row['serial'];

                echo '<div class="prescription-card">';
                echo '<span><strong>Problem:</strong> ' . htmlspecialchars($appointment['problem']) . '</span><br>';
                echo '<span><strong>Date:</strong> ' . htmlspecialchars($appointment['appointment_date']) . '</span><br>';
                echo '<span><strong>Time:</strong> ' . htmlspecialchars($appointment['appointment_time']) . '</span><br>';
                echo '<span><strong>Status:</strong> ' . htmlspecialchars($appointment['status']) . '</span><br>';
                echo '<span><strong>Doctor:</strong> ' . htmlspecialchars($appointment['doctor_name']) . ' (' . htmlspecialchars($appointment['qualification']) . ')</span><br>';
                echo '<span><strong>Serial:</strong> ' . htmlspecialchars($serial) . '</span><br>';
                echo '<div class="button-container">
                            <button class="hide-btn">⚙️ EDIT</button>
                            <button class="hide-btn">✨ DETAILS</button>
                        </div>';
                echo '</div>';
                }
                ?>

        </div>

        <!-- Take Appointment Button -->
        <div class="takeapp">
            <a href="appointment/form.php?patient_id=<?php echo $patient_id; ?>">
                <i class="fas fa-capsules icon"></i> TAKE NEW APPOINTMENT
            </a>
        </div>
        
    </div>
<?php include "../footer.php" ?>

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

<link rel="stylesheet" href="dash.css">

</body>
</html>
