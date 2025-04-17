<?php
session_start();
include('../db_connect.php');
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
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>

<body>
    <div class="dashboard-container">
                <nav class="bg-white shadow-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                <!-- Logo & Title -->
                <div class="flex items-center">
                    <img class="h-10 w-auto mr-2" src="../assets/clinicode.png" alt="ZS Sharif Dental Logo">
                    <span class="text-xl font-semibold text-blue-800">CliniCode</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex space-x-6">
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">Our Doctors</a>
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">Services</a>
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">Contact</a>
                    <a href="#" class="text-gray-700 hover:text-blue-800 font-medium">Help</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="sm:hidden">
                    <button id="mobile-menu-btn" class="text-gray-600 hover:text-blue-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    </button>
                </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="sm:hidden hidden px-4 pt-2 pb-4 space-y-2 bg-white">
                <a href="#" class="block text-gray-700 hover:text-blue-800 font-medium">Home</a>
                <a href="#" class="block text-gray-700 hover:text-blue-800 font-medium">Our Doctors</a>
                <a href="#" class="block text-gray-700 hover:text-blue-800 font-medium">Services</a>
                <a href="#" class="block text-gray-700 hover:text-blue-800 font-medium">Contact</a>
            </div>

            <!-- Toggle Script -->
            <script>
                const btn = document.getElementById('mobile-menu-btn');
                const menu = document.getElementById('mobile-menu');

                btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                });
            </script>
            </nav>



        <div class="dashboard-card">
            <div class="dashboard-header">
                <div class="avatar-circle">
                    <span><?php echo strtoupper(substr($_SESSION['patient_name'], 0, 1)); ?></span>
                </div>
                <div class="welcome-text">
                    <h2>Patient :  <?php echo htmlspecialchars($_SESSION['patient_name']); ?></h2>
                </div>
            </div>

            <div class="patient-info-grid">
                <div><strong>📞 Phone:</strong> <?php echo htmlspecialchars($_SESSION['patient_phone']); ?></div>
                <div><strong>🎂 DOB:</strong> <?php echo htmlspecialchars($_SESSION['patient_dob']); ?></div>
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
                    echo '<h3>Prescription ID: ' . htmlspecialchars($prescription['prescription_id']) . '</h3>';
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
                         ORDER BY a.appointment_no DESC";
            $stmt = $conn->prepare($appt_sql);
            $stmt->bind_param("i", $patient_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($appointment = $result->fetch_assoc()) {
                echo '<div class="appointment-row">';
                echo '<span><strong>Appointment No:</strong> ' . htmlspecialchars($appointment['appointment_no']) . '</span><br>';
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
            <a href="appointment_form.php?patient_id=<?php echo $patient_id; ?>">
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

    <!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Alpine.js for dropdown and toggle functionality (optional but helpful) -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
