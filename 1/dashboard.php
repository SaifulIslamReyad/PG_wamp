<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Doctor's Dashboard</title>
        <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />
        <link rel="stylesheet" href="../css/dashboard.css"/>
        <script src="../js/index.js"></script>
        <script src="dashboard.js"></script>
      </head>
      
<body>
<?php include '../navbar.php'; ?>


  <div class="dashboard">
      

<?php
// Include the database connection
include '../db_connect.php';

// Doctor ID (you can make this dynamic via session or request)
$doctor_id = 1;
date_default_timezone_set('Asia/Dhaka');
$today = date('Y-m-d');

// Queries with doctor filter
$totalQuery = "SELECT COUNT(*) AS total FROM appointments WHERE doctor_id = $doctor_id AND appointment_date = '$today'";
$pendingQuery = "SELECT COUNT(*) AS pending FROM appointments WHERE doctor_id = $doctor_id AND status = 'Appointed' AND appointment_date = '$today'";
$completedQuery = "SELECT COUNT(*) AS completed FROM appointments WHERE doctor_id = $doctor_id AND status = 'Seen' AND appointment_date = '$today'";
// Execute
$totalResult = $conn->query($totalQuery)->fetch_assoc();
$pendingResult = $conn->query($pendingQuery)->fetch_assoc();
$completedResult = $conn->query($completedQuery)->fetch_assoc();
?>

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

<div class="dashboard-header">
  <div class="doctor-profile">
    <img src="../images/suhad.png" alt="Doctor" class="doctor-img">
    <div>
      <h2>Dr. Ashraful Islam Suhad</h2>
      <p>Oral & Dental Specialist</p>
    </div>
  <div class="menu-container">
    <button class="dots-button" onclick="toggleMenu()">⋮</button>
    <div class="dropdown-menu" id="dropdownMenu">
      <button onclick="location.href='add-prescription.php'">🥼 Profile</button>
      <button onclick="location.href='add-prescription.php'">🔄 Switch Chamber</button>
      <button onclick="location.href='add-prescription.php'">➕ Add Chamber</button>
      <button onclick="location.href='add-prescription.php'">👨‍🦼 All Patients</button>
      <button onclick="location.href='add-prescription.php'">➕ Create Patient</button>
      <button onclick="location.href='add-prescription.php'">✨ Seen List</button>
      <button onclick="location.href='add-prescription.php'">🖇 Follow-up List</button>
      <button onclick="location.href='add-prescription.php'">🫖 Holiday</button>
      <button onclick="location.href='add-prescription.php'">📞 Call settings</button>
      <button onclick="location.href='add-prescription.php'">💊 Templates</button>
      <button onclick="location.href='add-prescription.php'">➕ Add Templates</button>
      <button onclick="location.href='add-prescription.php'">🛠 Edit Prescription</button>
      <button onclick="location.href='add-prescription.php'">📤 Log out</button>
    </div>
  </div>
  </div>


</div>


<!-- Summary Cards -->
<div class="stats-cards">
<div class="date card">
  <h3>It's</h3>
        <p class="date-display" id="currentDate"></p>
</div>
  <div class="card">
    <h3>Total Appointments</h3>
    <p id="totalAppointments"><?= $totalResult['total'] ?></p>
  </div>
  <div class="card">
    <h3>Pending</h3>
    <p id="pendingAppointments"><?= $pendingResult['pending'] ?></p>
  </div>
  <div class="card">
    <h3>Completed</h3>
    <p id="completedAppointments"><?= $completedResult['completed'] ?></p>
  </div>
</div>
    <div class="appointment-filters">
      <button class="button" id="todayBtn">Today's Appointments</button>
      <button class="button" id="allBtn">All Appointments</button>
      <div class="button" >Appointments of date
      <input type="date" id="datePicker">
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Serial</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Problem</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="appointmentsList">
      </tbody>
    </table>
  </div>

  <script>
    document.getElementById("currentDate").textContent = "🗓️"+
    new Date().toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  </script>

  <script src="dashboard.js"></script>
  <link rel="stylesheet" href="../css/dashboard.css">
</body>
</html>
