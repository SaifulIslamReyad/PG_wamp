<?php 
// Retrieve patient_id from URL
if (isset($_REQUEST['patient_id'])) {
    $patient_id = intval($_REQUEST['patient_id']);
} else {
    die("Error: Missing patient ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="../general.css">
    <!-- <link rel="stylesheet" href="appointment.css"> -->
</head>
<body>
    <div class="container">
        <h2>Appointment Form</h2>

        <form action="submit_appointment.php?patient_id=<?php echo $patient_id; ?>" method="post" id="appointmentForm">
            <!-- Hidden input to pass patient_id -->
            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">

            <div class="form-group">
                <label for="problem">Medical Issue:</label>
                <input type="text" id="problem" name="problem" placeholder="Describe your problem" required>
            </div>
            <div class="form-group">
                <label for="preffered_appointment_date">Preferred Appointment Date:</label>
                <input type="date" id="preffered_appointment_date" name="appointment_date" required>
            </div>
        <!-- <fieldset> -->
            <legend>Choose a doctor</legend>

            <div class="form-group">
                <label for="specialization">Choose Specialization:</label>
                <select name="specialization" id="specialization" required>
                    <option value="" disabled selected>Loading specializations...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="doctor">Choose a Doctor:</label>
                <select name="doctor_id" id="doctor" required>
                    <option value="" disabled selected>Select a specialization first</option>
                </select>
            </div>
            <!-- </fieldset> -->
            <button type="submit">Book Appointment</button>
        </form>
    </div>

    <script>
        // Fetch specializations on page load
        window.onload = function() {
            fetch('get_specializations.php')
                .then(response => response.json())
                .then(data => {
                    let specializationDropdown = document.getElementById('specialization');
                    specializationDropdown.innerHTML = '<option value="" disabled selected>Select Specialization</option>';
                    data.forEach(spec => {
                        specializationDropdown.innerHTML += `<option value="${spec.specialization_id}">${spec.specialization_name}</option>`;
                    });
                });
        };

        // Fetch doctors based on specialization
        document.getElementById('specialization').addEventListener('change', function() {
            let specializationId = this.value;
            fetch('get_doctors.php?specialization_id=' + specializationId)
                .then(response => response.json())
                .then(data => {
                    let doctorDropdown = document.getElementById('doctor');
                    doctorDropdown.innerHTML = '<option value="" disabled selected>Select Doctor</option>';
                    data.forEach(doc => {
                        doctorDropdown.innerHTML += `<option value="${doc.doctor_id}">${doc.doctor_name}</option>`;
                    });
                });
        });
    </script>
</body>
</html>
