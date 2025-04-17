<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Doctor's Dashboard</title>
        <link rel="stylesheet" href="dash.css"/>
        <link rel="stylesheet" href="../nav.css">
      </head>
      
<body>
  <nav class="cc-navbar">
    <div class="cc-navbar-container">
      <div class="cc-navbar-inner">
        <!-- Logo + Brand -->
        <div class="cc-logo-brand">
          <img class="cc-logo" src="../assets/clinicode.png" alt="ZS Sharif Dental Logo" />
          <span class="cc-brand-name">CliniCode</span>
        </div>
  
        <!-- Nav Links -->
        <div class="cc-nav-links">
          <a href="../index.html" class="cc-nav-link">Home</a>
          <a href="#" class="cc-nav-link">About</a>
          <a href="#" class="cc-nav-link">Our Doctors</a>
          <a href="#" class="cc-nav-link">Services</a>
          <a href="#" class="cc-nav-link">Contact</a>
          <a href="#" class="cc-nav-link">Help</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="dashboard">


      
      <div class="dashboard-header">
        <p class="date-display" id="currentDate"></p>
      </div>

      <?php
// Include the database connection
include '../db_connect.php';

// Doctor ID (you can make this dynamic via session or request)
$doctor_id = 1;
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

<!-- Summary Cards -->
<div class="stats-cards">
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

  <script src="dash.js"></script>
</body>
</html>
