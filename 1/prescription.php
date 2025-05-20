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
    <link rel="stylesheet" href="../css/main.css">
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
                <p><strong>Name:</strong> <?= htmlspecialchars($appointment['patient_name']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($appointment['patient_phone']) ?></p>
                <p><strong>Problem:</strong> <?= htmlspecialchars($appointment['problem']) ?></p>
                </div>
                <div>
                <h3>Appointment Information</h3>
                <p><strong>Appointment Date:</strong> <?= htmlspecialchars($appointment['appointment_date']) ?></p>
                <p><strong>Appointment Time:</strong> <?= htmlspecialchars($appointment['appointment_time']) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($appointment['status']) ?></p>
                </div>
            </div>
            
            <button id="book-appointment-btn">🔖 PROFILE</button>
            <button id="book-appointment-btn">🧷 BOOK FOLLOW-UP</button>
            <button id="book-appointment-btn">🖇️ IMAGES</button>
            <button id="book-appointment-btn">📷 ADD IMAGE</button>
            <div id="popup-profile" class="popup-overlay">
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <h3>More Patient Information</h3>
                    <p><strong>✨ Name:</strong> <?= htmlspecialchars($appointment['patient_name']) ?></p>
                    <p><strong>📞 Phone:</strong> <?= htmlspecialchars($appointment['patient_phone']) ?></p>
                    <p><strong>👼 Date Of Birth:</strong> <?= htmlspecialchars($appointment['patient_dob']) ?></p>
                    <p><strong>🏠 Address:</strong> Gollamari, Khulna</p>
                    <p><strong>👷 Profession:</strong> Student</p>
                    <p><strong>👪 Marital Status:</strong> Single</p>
                    <p><strong>🩸 Blood group:</strong> B+</p>
                    <p><strong>🛐 Religion:</strong> Islam</p>
                    <p><strong>🛐 Nationality:</strong> Bangladeshi</p>
                    <p><strong>👴 Age:</strong> <?= calculateAge($appointment['patient_dob']) ?> </p>
                    <p><strong>🚻 Gender:</strong> <?= htmlspecialchars($appointment['patient_gender']) ?> </p>
                </div>
            </div>
            <style>
                .popup-overlay {
                    display: none; 
                    position: fixed;
                    top: 0; left: 0;
                    width: 100%; height: 100%;
                    background: rgba(0, 0, 0, 0.6);
                    z-index: 1000;
                    }

                    .popup-content {
                    background: #fff;
                    padding: 20px;
                    width: 300px;
                    max-width: 90%;
                    margin: 100px auto;
                    border-radius: 8px;
                    position: relative;
                    }

                    .close-btn {
                    position: absolute;
                    top: 5px; right: 10px;
                    cursor: pointer;
                    font-size: 20px;
                    color: #333;
                    }

            </style>
            <script>
                const btn = document.getElementById("book-appointment-btn");
                const popup = document.getElementById("popup-profile");
                const closeBtn = popup.querySelector(".close-btn");

                btn.onclick = () => popup.style.display = "block";
                closeBtn.onclick = () => popup.style.display = "none";

                window.onclick = (e) => {
                    if (e.target === popup) {
                    popup.style.display = "none";
                    }
                };
            </script>

            <hr>
<div class="vitals-section">


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
    <label>
    
    <input type="text" name="bloodPressure" placeholder="Blood Pressure (mmHg)">
  </label>
  <label>
  <input type="number" name="bloodSugar" placeholder="Blood Sugar (mg/dL)">
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
            <strong></strong> <?= htmlspecialchars($prescription['issued_date']) ?> |
            <strong></strong> <?= htmlspecialchars($prescription['cc']) ?> |
        <strong></strong> <?= htmlspecialchars($prescription['doctor_name']) ?> (<?= htmlspecialchars($prescription['qualification']) ?>)

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
            <button class="details-btn"> ✨ DETAILS </button>
            <hr>
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
                    <label for="cc-input">🔹C/C:</label>
                    <input style="margin-top:2px" list="cc-options" id="cc-input" name="cc" required placeholder="Type/Select" />

                        <datalist id="cc-options">
                        <option value="Toothache">
                        <option value="Sensitivity to hot or cold">
                        <option value="Swollen gums">
                        <option value="Bleeding gums">
                        <option value="Bad breath">
                        <option value="Loose tooth">
                        <option value="Broken tooth">
                        <option value="Tooth discoloration">
                        <option value="Jaw pain">
                        <option value="Mouth ulcers">
                        <option value="Food impaction">
                        <option value="Clicking sound in jaw">
                        <option value="Pain during chewing">
                        <option value="Dental check-up">
                        <option value="Follow-up visit">
                        </datalist>

                    <br>
                    <label>🔹M/H:</label>
                                        
                <ul style="list-style: none; padding-left: 0;">
                    <li><label><input type="checkbox" name="history[]" value="HTN"> HTN</label></li>
                    <li><label><input type="checkbox" name="history[]" value="DM"> DM</label></li>
                    <li><label><input type="checkbox" name="history[]" value="Asthma"> Asthma</label></li>
                    <li><label><input type="checkbox" name="history[]" value="Bleeding disorder"> Bleeding disorder</label></li>
                    <li><label><input type="checkbox" name="history[]" value="Pregnancy"> Pregnancy</label></li>
                    <li><label><input type="checkbox" name="history[]" value="Hepatitis"> Hepatitis</label></li>
                    <li><label><input type="checkbox" name="history[]" value="Kidney disease"> Kidney disease</label></li>
                    <li>
                        <label>Others: 
                            <input type="text" name="history[]" placeholder="Specify other condition">
                        </label>
                    </li>

                </ul>

<br>

<!-- O/E Findings -->
<label>🔹O/E:</label>
<ul style="list-style: none; padding-left: 0;">
  <li><label><input type="checkbox" name="oe[]" value="Caries"> Caries</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Pulpitis"> Pulpitis</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Gingivitis"> Gingivitis</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Periodontitis"> Periodontitis</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Plaque"> Plaque</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Calculus"> Calculus</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Pericoronitis"> Pericoronitis</label></li>
  <li><label><input type="checkbox" name="oe[]" value="Impaction"> Impaction</label></li>
    <li>
        <label>Others: 
            <input type="text" name="history[]" placeholder="Specify other condition">
        </label>
    </li>
</ul>

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
                    
                    <button type="button" id="generate-prescription-btn" onclick="generatePrescription()">🖨️ PRINT</button>

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