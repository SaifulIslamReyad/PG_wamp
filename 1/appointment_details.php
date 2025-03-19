<?php
include('../db_connect.php'); // Include the database connection

// Get the appointment number from the URL
$appointment_no = isset($_GET['appointment_no']) ? $_GET['appointment_no'] : '';

// Fetch appointment, patient, and medicine details based on appointment_no
$sql = "SELECT 
            a.appointment_no, 
            p.patient_name, 
            a.phone, 
            p.patient_gender, 
            p.patient_NID, 
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

// Check if the appointment exists
if ($result->num_rows > 0) {
    $appointment = $result->fetch_assoc();
} else {
    echo "No appointment found!";
    exit;
}

// Fetch medicines related to the appointment
$sql_medicines = "SELECT fm.medicine_name, m.dosage, m.before_after, m.duration
                  FROM medicines m
                  JOIN favourite_medicines fm ON m.medicine_id = fm.medicine_id
                  WHERE m.appointment_no = ?";
$stmt_medicines = $conn->prepare($sql_medicines);
$stmt_medicines->bind_param("i", $appointment_no);
$stmt_medicines->execute();
$result_medicines = $stmt_medicines->get_result();
$medicines = [];
while ($medicine = $result_medicines->fetch_assoc()) {
    $medicines[] = $medicine;
}

$stmt->close();
$stmt_medicines->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment & Prescription Details</title>
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="suhadstyles.css">
    <link rel="stylesheet" href="addmedi.css">
    <style>
        /* Styles for side-by-side layout */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }
        .appointment-details{
            width: 30%;
        }
        .prescription-generator {
            width: 70%;
            border: 2px solid white;
            border-radius: 20px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <!-- Appointment Details Section -->
        <div class="appointment-details">
            <h1>Appointment Details</h1>

            <h2>Patient Information</h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($appointment['patient_name']) ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($appointment['patient_gender']) ?></p>
            <p><strong>NID:</strong> <?= htmlspecialchars($appointment['patient_NID']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($appointment['phone']) ?></p>

            <h2>Appointment Information</h2>
            <p><strong>Problem:</strong> <?= htmlspecialchars($appointment['problem']) ?></p>
            <p><strong>Appointment Date:</strong> <?= htmlspecialchars($appointment['appointment_date']) ?></p>
            <p><strong>Appointment Time:</strong> <?= htmlspecialchars($appointment['appointment_time']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($appointment['status']) ?></p>

            <h2>Medicines Prescribed</h2>
            <?php if (count($medicines) > 0): ?>
                <ul>
                    <?php foreach ($medicines as $medicine): ?>
                        <li>
                            <strong>Medicine:</strong> <?= htmlspecialchars($medicine['medicine_name']) ?><br>
                            <strong>Dosage:</strong> <?= htmlspecialchars($medicine['dosage']) ?><br>
                            <strong>When to Take:</strong> <?= htmlspecialchars($medicine['before_after']) ?><br>
                            <strong>Duration:</strong> <?= htmlspecialchars($medicine['duration']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No medicines prescribed for this appointment.</p>
            <?php endif; ?>

            <a href="dashboard.html">Back to Dashboard</a>
        </div>

        <!-- Prescription Generator Section -->
        <div class="prescription-generator">
            <header>
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
                    <img src="logo.jpg" alt="Clinic Logo" class="clinic-logo">
                    <div class="logo-and-specialization">
                        <p class="specialization">
                            Oral and dental specialist & surgeon<br>
                            Special Training on Root canal Treatment<br>
                            BMDC Regi No: 14041
                        </p>
                    </div>
                </div>
            </header>

            <div class="form-container">
                <form id="prescription-form">
                    <div class="info-row">
                        <div class="left">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required value="<?= htmlspecialchars($appointment['patient_name']) ?>">
                        </div>
                        <div class="right">
                            <label for="age">Age:</label>
                            <input type="number" id="age" name="age" required>

                            <label for="sex">Sex:</label>
                            <select id="sex" name="sex" required>
                                <option value="Male" <?= $appointment['patient_gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $appointment['patient_gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= $appointment['patient_gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>

                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" required>
                        </div>
                    </div>

                    <div id="cc">
                        <label for="cc-input">C/C:</label>
                        <input type="text" id="cc-input" name="cc" required>
                    </div>

                    <div id="medicine-list"></div>

                    <button type="button" id="add-medicine-btn">+ Add Medicine</button>

                    <button type="button" onclick="generatePrescription()">Generate Prescription</button>
                </form>
            </div>
        </div>
    </div>

    <script src="suhadscripts.js"></script>
</body>
</html>
