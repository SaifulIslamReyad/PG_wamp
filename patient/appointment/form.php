<?php 
if (isset($_REQUEST['patient_id'])) {
    $patient_id = intval($_REQUEST['patient_id']);
} else {
    die("Error: Missing patient ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Registered Doctors</title>
  <link rel="stylesheet" href="form.css"> 
  <link rel="stylesheet" href="../../nav.css">
</head>
<body>
<nav class="cc-navbar">
      <div class="cc-navbar-container">
        <div class="cc-navbar-inner">
          <!-- Logo + Brand -->
          <div class="cc-logo-brand">
            <img class="cc-logo" src="../../assets/clinicode.png" alt="ZS Sharif Dental Logo" />
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
<h1>All Registered Doctors</h1>

<!-- Filter Form -->
<div class="filter-container">
  <input type="text" id="filterName" placeholder="Search by Name" oninput="filterDoctors()">
  <input type="text" id="filterLocation" placeholder="Search by Location" oninput="filterDoctors()">
  <input type="text" id="filterSpecialization" placeholder="Search by Specialization" oninput="filterDoctors()">
</div>

<!-- Doctors Table -->
<table id="doctorsTable" class="doctor-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Qualification</th>
      <th>Location</th>
      <th>Specializations</th>
    </tr>
  </thead>
  <tbody id="doctorsList">
    <!-- Doctors rows will be injected here -->
  </tbody>
</table>

<script>
  let doctorsData = []; // Variable to hold the fetched doctor data

  // Fetch doctors data from the backend
  async function fetchDoctors() {
    try {
      const res = await fetch('get_doctors.php'); // Backend PHP file that returns doctors' data in JSON format
      const data = await res.json();  // Convert the response to JSON
      doctorsData = data.doctors;     // Store the doctors data
      displayDoctors(doctorsData);    // Display all doctors initially
    } catch (error) {
      document.getElementById('doctorsList').innerHTML = '<tr><td colspan="7">Error loading doctors.</td></tr>';
    }
  }

  // Function to display the list of doctors
  function displayDoctors(doctors) {
    const container = document.getElementById('doctorsList');
    container.innerHTML = '';  // Clear the container before appending new data

    if (doctors.length === 0) {
        container.innerHTML = '<tr><td colspan="7">No doctors found.</td></tr>';
        return;
    }
    doctors.forEach(doc => {
    const row = document.createElement('tr');
    
    // Set the cursor to pointer to indicate it's clickable
    row.style.cursor = 'pointer';
    
    const patientId = <?= json_encode($patient_id); ?>;
    // Add the click event listener to the row
    row.onclick = function() {
    window.location.href = `doctor_details.php?doctor_id=${doc.doctor_id}&patient_id=${patientId}`;
};

    
    // Create the row content
    row.innerHTML = `
        <td>${doc.doctor_name}</td>
        <td>${doc.doctor_email}</td>
        <td>${doc.mobile}</td>
        <td>${doc.qualification}</td>
        <td>${doc.chamber_address}</td>
        <td>${doc.specializations.join(', ')}</td>
    `;
    
    // Append the row to the container
    container.appendChild(row);
});


}


  // Function to filter doctors based on the input values
  function filterDoctors() {
    const nameFilter = document.getElementById('filterName').value.toLowerCase();
    const locationFilter = document.getElementById('filterLocation').value.toLowerCase();
    const specializationFilter = document.getElementById('filterSpecialization').value.toLowerCase();

    const filteredDoctors = doctorsData.filter(doc => {
      const nameMatch = doc.doctor_name.toLowerCase().includes(nameFilter);
      const locationMatch = doc.chamber_address.toLowerCase().includes(locationFilter);
      const specializationMatch = doc.specializations.some(specialization => specialization.toLowerCase().includes(specializationFilter));
      
      return nameMatch && locationMatch && specializationMatch;
    });

    displayDoctors(filteredDoctors); // Display the filtered list of doctors
  }

  // Call the fetchDoctors function when the page is loaded
  window.onload = fetchDoctors;
</script>

</body>
</html>
