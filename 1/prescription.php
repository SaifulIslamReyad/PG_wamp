<?php
include('../db_connect.php'); 

$appointment_no = isset($_GET['appointment_no']) ? $_GET['appointment_no'] : '';

$sql = "SELECT 
            a.appointment_no, 
            p.patient_name, 
            p.patient_dob,
            p.patient_phone, 
            p.patient_gender, 
            a.problem, 
            a.appointment_date, 
            a.appointment_time, 
            a.status, 
            a.doctor_id
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id
        WHERE a.appointment_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
} else {
    echo "No appointment found!";
    exit;
}

function calculateAge($dob) {
    $dob = new DateTime($dob); 
    $today = new DateTime();  
    $age = $dob->diff($today)->y;  
    return $age;
}






$sql = "SELECT patient_id FROM appointments WHERE appointment_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
    $patient_id = $patient['patient_id'];
} else {
    echo "No appointment found!";
    exit;
}

// Step 1: Get all prescription IDs for the patient along with the prescribing doctor
$prescription_ids_sql = "SELECT 
                            p.prescription_id, 
                            p.cc,
                            p.issued_date,
                            d.doctor_name,
                            d.qualification
                         FROM prescriptions p
                         JOIN appointments a ON p.prescription_id = a.appointment_no
                         JOIN doctors d ON a.doctor_id = d.doctor_id
                         WHERE a.patient_id = ?";
$stmt = $conn->prepare($prescription_ids_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$prescriptions_result = $stmt->get_result();

$all_prescriptions = [];

while ($prescription = $prescriptions_result->fetch_assoc()) {
    $prescription_id = $prescription['prescription_id'];
    $issued_date = $prescription['issued_date'];
    $cc = $prescription['cc'];
    $doctor_name = $prescription['doctor_name'];
    $qualification = $prescription['qualification'];

    // Step 2: Fetch prescribed medicines for each prescription ID
    $medicines_sql = "SELECT 
                        m.medicine_name, 
                        pm.dosage, 
                        pm.before_after, 
                        pm.duration
                      FROM prescribed_medicines pm
                      JOIN medicines m ON pm.medicine_id = m.medicine_id
                      WHERE pm.prescription_id = ?";
    $stmt = $conn->prepare($medicines_sql);
    $stmt->bind_param("i", $prescription_id);
    $stmt->execute();
    $medicines_result = $stmt->get_result();

    $medicines = [];
    while ($medicine = $medicines_result->fetch_assoc()) {
        $medicines[] = $medicine;
    }

    // Step 3: Store data in a structured format with doctor info
    $all_prescriptions[] = [
        'prescription_id' => $prescription_id,
        'issued_date' => $issued_date,
        'doctor_name' => $doctor_name,
        'qualification' => $qualification,
        'medicines' => $medicines,
        'cc'=> $cc
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />
<title>Prescription</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZS Sharif Dental Care & Surgery</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="../css/layout.css">
</head>
<script>
    function toggleTable(index) {
    const table = document.getElementById('medicine-table-' + index);
    table.style.display = table.style.display === 'none' ? 'block' : 'none';
}
</script>
<style>
 .prescription-summary {
    background-color: #f9f9f9;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.3s ease;
    margin-bottom: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.prescription-summary:hover {
    background-color: #e6f7ff;
}

</style>
<script src="../js/index.js"></script>
<body>
    
   <?php include '../navbar.php'; ?> 
    
    <div class="container-big">
        
        <div class="left-div">
            <div class="info-box">
                <div>
                <h3>Patient Information</h3>
                <p><strong>Phone:</strong> <?= htmlspecialchars($appointment['patient_phone']) ?></p>
                <p><strong>Problem:</strong> <?= htmlspecialchars($appointment['problem']) ?></p>
                <p><strong>Date of birth:</strong> <?= htmlspecialchars($appointment['patient_dob']) ?></p>
                </div>
                <div>
                <h3>Appointment Information</h3>
                <p><strong>Appointment Date:</strong> <?= htmlspecialchars($appointment['appointment_date']) ?></p>
                <p><strong>Appointment Time:</strong> <?= htmlspecialchars($appointment['appointment_time']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($appointment['status']) ?></p>
                </div>
            </div>
            
            <button id="book-appointment-btn">🧷 Book Follow-Up</button>
            <button id="book-appointment-btn">🖼️ Pictures</button>
            <button id="book-appointment-btn">📸 Add Picture</button>
            <hr>
<div class="vitals-section">
  <label>
    
    <input type="text" name="bloodPressure" placeholder="Blood Pressure (mmHg)">
  </label>

  <label>
    
    <input type="number" name="pulseRate" placeholder="Pulse Rate (bpm)">
  </label>

  <label>
    
    <input type="text" name="temperature" placeholder="Temperature (°F)">
  </label>

  <label>
    
    <input type="number" name="weight" placeholder="Weight (kg)">
  </label>

  <label>
    
    <input type="number" name="spo2" placeholder="SpO₂ (%)">
  </label>
</div>

            <hr>
            <?php include "template.php" ?>
            <hr>
    <h2 id="patient_history_h2"> Prescriptions</h2>
    <div class="prescription-info">
    <?php if (!empty($all_prescriptions)): ?>
        <?php foreach ($all_prescriptions as $index => $prescription): ?>
    <div class="prescription-card">
        <!-- Summary Line (Clickable) -->
        <div class="prescription-summary" onclick="toggleTable(<?= $index ?>)">
            <strong>Date:</strong> <?= htmlspecialchars($prescription['issued_date']) ?> |
            <strong>CC:</strong> <?= htmlspecialchars($prescription['cc']) ?>
        <p><strong>Doctor:</strong> <?= htmlspecialchars($prescription['doctor_name']) ?> (<?= htmlspecialchars($prescription['qualification']) ?>)</p>

        </div>

        <!-- Hidden Medicine Table -->
        <div id="medicine-table-<?= $index ?>" class="medicine-table-container-big" style="display: none;">
            <?php if (!empty($prescription['medicines'])): ?>
                <table class="medicine-table">
                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Dosage</th>
                            <th>Before/After Meal</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prescription['medicines'] as $medicine): ?>
                            <tr>
                                <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                                <td><?= htmlspecialchars($medicine['dosage']) ?></td>
                                <td><?= htmlspecialchars($medicine['before_after']) ?></td>
                                <td><?= htmlspecialchars($medicine['duration']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No medicines prescribed.</p>
            <?php endif; ?>
            <button class="details-btn"> ✨ Details </button>
        </div>
    </div>
<?php endforeach; ?>

    <?php else: ?>
        <p>No previous prescriptions found.</p>
    <?php endif; ?>
</div>
   


        </div>
        <div class="right-div">
            <header class="nav-header">
                <h1>ZS Sharif Dental Care & Surgery</h1>
                <p class="tagline">You smile, our team smiles</p>
                <div class="header-content">
                    <div class="clinic-info">
                        <p class="doctor-info">
                            <span>Dr. Md. Ashraful Islam Suhad <br></span>
                            BDS (Dhaka University)<br>
                            Sher-E-Bangla Medical College and hospital, Barishal
                        </p>
                    </div>
                    <img src="assets/logo.jpg" alt="Clinic Logo" class="clinic-logo">
                    <div class="logo-and-specialization">
                        <p class="specialization">
                            Oral and dental specialist & surgeon<br>
                            Special Training on Root canal Treatment<br>
                            BMDC Regi No: 14041 <br>
                            Dhaka University
                        </p>
                    </div>
                </div>
            </header >

            <div class="patient-info">
                <label>Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($appointment['patient_name']) ?>" required>

                <label>Age:</label>
                <input type="number" id="age" name="age" value="<?= calculateAge($appointment['patient_dob']) ?>" required>

                <label>Sex:</label>
                <input type="text" id="sex" name="sex" value="<?= htmlspecialchars($appointment['patient_gender']) ?>" required>

                <label>Date:</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" required>
            </div>


            <div class="main-content">
                <div class="left-section">
                    <label>🔹C/C:</label>
                    <input type="text" id="cc-input" name="cc" required>
                    <br>
                    <label>🔹M/H:</label>
                    <ol>
                        <li>HTN</li>
                        <li>DM</li>
                        <li>Asthma</li>
                        <li>Bleeding disorder</li>
                        <li>Pregnancy</li>
                        <li>Hepatitis</li>
                        <li>Kidney disease</li>
                        <li>Others</li>
                    </ol>
                    <br>
                    <label>🔹O/E:</label>
                    <ol>
                        <li>Caries</li>
                        <li>Pulpitis</li>
                        <li>Gingivitis</li>
                        <li>Periodontitis</li>
                        <li>Plaque</li>
                        <li>Calculus</li>
                        <li>Pericoronitis</li>
                        <li>Impaction</li>
                        <li>Others</li>
                    </ol>
                    <div class="investigation-box">
                        <br>
                        <label>🔹Investigation:</label>
                        <br><br>
                        <div class="quadrant-container-big">
                            <div class="quadrant"><input type="text" id="q1" name="q1" placeholder="Q1"></div>
                            <div class="quadrant"><input type="text" id="q2" name="q2" placeholder="Q2"></div>
                            <div class="quadrant"><input type="text" id="q3" name="q3" placeholder="Q3"></div>
                            <div class="quadrant"><input type="text" id="q4" name="q4" placeholder="Q4"></div>
                        </div>
                        <br>
                        <input type="text" id="investigation-extra" name="investigation-extra"
                            placeholder="Investigation Details">
                    </div>
                    <div class="treatment-box">
                        <br>
                        <label>🔹Treatment Plan:</label>
                        <br><br>
                        <div class="quadrant-container-big">
                            <div class="quadrant"><input type="text" id="q1" name="q1" placeholder="T1"></div>
                            <div class="quadrant"><input type="text" id="q2" name="q2" placeholder="T2"></div>
                            <div class="quadrant"><input type="text" id="q3" name="q3" placeholder="T3"></div>
                            <div class="quadrant"><input type="text" id="q4" name="q4" placeholder="T4"></div>
                        </div>
                        <br>
                        <input type="text" id="treatment-extra" name="treatment-extra" placeholder="Treatment Details">
                    </div>
                </div>
                <div class="right-section">
                    <h2>Rx</h2>
                    <div id="medicine-container-big"></div>
                    <button id="add-medicine">+</button>
                    
                    <button type="button" id="generate-prescription-btn" onclick="generatePrescription()">🖨️Print</button>

                </div>
            </div>
            <div class="footer-p">
                <p>চেম্বার ১: হোসাইনিয়া মাদরাসা সড়ক, বৈদ্যপাড়া, বরিশাল।</p>
                <p>চেম্বার ২:, শরীফ ভিলা, ভাটিখানা প্রধান সড়ক, বরিশাল।</p>
                <p>📞 +880162-8949739</p>
            </div>
        </div>
    </div>
    <?php include "../footer.php" ?>


    <script>
    // Load medicines from get_medicines.php
    let medicineList = [];

    fetch('./get_medicines.php')
        .then(response => response.json())
        .then(data => {
            medicineList = data;
        });

    document.getElementById('add-medicine').addEventListener('click', () => {
        const medicineEntry = document.createElement('div');
        medicineEntry.classList.add('medicine-entry');
        const uniqueId = Date.now();

        // Create datalist with unique id for each entry (optional)
        const datalistId = `medicine-suggestions-${uniqueId}`;
        const datalist = document.createElement('datalist');
        datalist.id = datalistId;

        medicineList.forEach(medicine => {
            const option = document.createElement('option');
            option.value = medicine;
            datalist.appendChild(option);
        });

        medicineEntry.innerHTML = `
            <div class="last">  
                <input type="text" class="medicine-input" name="medicine" placeholder="Enter or choose a medicine" list="${datalistId}">
                <button type="button" class="remove-medicine">-</button>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" class="morning" name="time" value="morning" id="morning-${uniqueId}">
                <label for="morning-${uniqueId}">Morning</label>

                <input type="checkbox" class="noon" name="time" value="noon" id="noon-${uniqueId}">
                <label for="noon-${uniqueId}">Noon</label>

                <input type="checkbox" class="night" name="time" value="night" id="night-${uniqueId}">
                <label for="night-${uniqueId}">Night</label>

                <input type="checkbox" class="eat-when-pain" name="eat-when-pain" id="eat-when-pain-${uniqueId}">
                <label for="eat-when-pain-${uniqueId}">Eat when you feel pain</label>
            </div>

            <div class="eating">
                <input type="checkbox" class="before-eating" name="before-eating" id="before-eating-${uniqueId}">
                <label for="before-eating-${uniqueId}">Before eating</label>
                <input type="checkbox" class="after-eating" name="after-eating" id="after-eating-${uniqueId}" checked>
                <label for="after-eating-${uniqueId}">After eating</label>
                <input type="number" class="days-input" name="days" placeholder="Days">
            </div>
        `;

        medicineEntry.appendChild(datalist);
        document.getElementById('medicine-container-big').appendChild(medicineEntry);

        medicineEntry.querySelector('.remove-medicine').addEventListener('click', () => {
            medicineEntry.remove();
        });
    });
</script>


    <script src="generate.js"></script>

</body>

</html>