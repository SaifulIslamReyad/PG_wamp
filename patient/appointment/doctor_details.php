<?php
  // Include database connection
  include('../../db_connect.php');

  // Get doctor_id and patient_id from URL
  if (isset($_GET['doctor_id']) && isset($_GET['patient_id'])) {
      $doctor_id = intval($_GET['doctor_id']);
      $patient_id = intval($_GET['patient_id']);
  } else {
      die("Error: Missing doctor ID or patient ID.");
  }

  // Fetch doctor details
  $query = "SELECT * FROM doctors WHERE doctor_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $doctor_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $doctor = $result->fetch_assoc();

  // Fetch specializations
  $spec_query = "
    SELECT s.specialization_name 
    FROM specializations s
    JOIN doctor_specialization ds ON s.specialization_id = ds.specialization_id
    WHERE ds.doctor_id = ?
  ";
  $spec_stmt = $conn->prepare($spec_query);
  $spec_stmt->bind_param("i", $doctor_id);
  $spec_stmt->execute();
  $spec_result = $spec_stmt->get_result();

  $specializations = [];
  while ($row = $spec_result->fetch_assoc()) {
      $specializations[] = $row['specialization_name'];
  }

  // Example hardcoded values
  $consultation_time = "9:00 AM - 5:00 PM";
  $address = "Nathullabad Bus Terminal";
  $fee = "500 Taka";
  $booking_charge = "100 Taka";
  $ratings = 4.5;
  $reviews = "Great doctor, very knowledgeable.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doctor Details & Appointment</title>
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />

  <link rel="stylesheet" href="details.css">
  <link rel="stylesheet" href="../../nav.css">
</head>

<body>

<?php include '../../navbar.php'; ?>

<div class="container"> 

<div class="doctor-details-container small-container">
  <h2>👨‍⚕️ <?php echo $doctor['doctor_name']; ?></h2>
  <p><strong>📨 Email:</strong> <?php echo $doctor['doctor_email']; ?></p>
  <p><strong>📱 Mobile:</strong> <?php echo $doctor['mobile']; ?></p>
  <p><strong>🎓 Qualification:</strong> <?php echo $doctor['qualification']; ?></p>


  <p><strong>🩺 Specializations:</strong> <?php echo implode(', ', $specializations); ?></p>
  <p><strong>🕒 Consultation Time:</strong> <?php echo $consultation_time; ?>
    </p>

  <p><strong>📍 Chamber location:</strong> <?php echo $address ," , ", $doctor['chamber_address'] ; ?></p>

  <p><strong>💰 Fee:</strong> <?php echo $fee; ?></p>
  <p><strong>💳 Booking Charge:</strong> <?php echo $booking_charge; ?></p>
  <p><strong>🧑‍🤝‍🧑 Total patients:</strong> <?php echo 9000; ?></p>
  <p>
    <strong>✨ Ratings:</strong> 
    <?php echo $ratings, "/5"; ?> 
    <?php
      $stars = floor($ratings);
      for ($i = 0; $i < $stars; $i++) {
        echo '⭐';
      }
    ?>
  </p>
    <!-- Embedded Google Map -->
    <div class="map-container">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3669.9707810422466!2d90.3460164!3d22.7145092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37553427816dde59%3A0x60f09fb3f33c67e8!2sNathullahbad%20Central%20Bus%20Terminal!5e0!3m2!1sen!2sbd!4v1713957389915!5m2!1sen!2sbd" 
      width="100%" 
      height="250" 
      style="border:0; border-radius: 10px;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>


<!-- Appointment Form Section -->
<div class="appointment-form-container small-container">
  <h2>🩺Book Appointment</h2>

  <form action="submit_appointment.php?patient_id=<?php echo $patient_id; ?>&doctor_id=<?php echo $doctor_id; ?>" method="post">
    <!-- Hidden inputs -->
    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">

    <div class="form-group">
      <label for="problem">Medical Issue:</label>
      <input type="text" id="problem" name="problem" placeholder="Describe your issue" required>
    </div>

<!-- HTML -->
<div class="form-group">
  <label for="appointment_date">Available Appointment Date:</label>
  <input type="hidden" id="appointment_date" name="appointment_date" required>
  <div class="calendar-picker" id="calendar-picker"></div>
</div>

<?php include "payment.php" ?>
    <button type="submit">Book Appointment</button>
  </form>
</div>
</div>

<script>
    // JavaScript
document.addEventListener("DOMContentLoaded", function () {
  const calendar = document.getElementById("calendar-picker");
  const dateInput = document.getElementById("appointment_date");

  const today = new Date();

  for (let i = 0; i < 30; i++) {
    const date = new Date();
    date.setDate(today.getDate() + i);

    const option = document.createElement("div");
    option.textContent = date.toDateString().slice(0, 10); // e.g., "Wed Apr 17"
    option.dataset.value = date.toLocaleDateString('en-CA'); // Format: YYYY-MM-DD

    option.addEventListener("click", () => {
      // Set value to hidden input
      dateInput.value = option.dataset.value;

      // Highlight selected
      document.querySelectorAll("#calendar-picker div").forEach(el => {
        el.classList.remove("selected");
      });
      option.classList.add("selected");
    });

    calendar.appendChild(option);
  }
});

</script>

</body>
</html>


