<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Signup</title>
    <link rel="stylesheet" href="../general.css">
    <link rel="stylesheet" href="./signup.css">
    <link rel="stylesheet" href="/PG_wamp/css/layout.css">
    <link rel="stylesheet" href="../general.css">
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />

    <script>
        function fetchSpecializations() {
            fetch('./get_specialization.php')
                .then(response => response.json())
                .then(data => {
                    const specializationContainer = document.getElementById('specialization_container');
                    specializationContainer.innerHTML = ''; 

                    data.forEach(specialization => {
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'specialization_id[]';
                        checkbox.value = specialization.specialization_id;
                        checkbox.id = 'spec_' + specialization.specialization_id;

                        const label = document.createElement('label');
                        label.htmlFor = 'spec_' + specialization.specialization_id;
                        label.textContent = specialization.specialization_name;

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('checkbox-wrapper');
                        wrapper.appendChild(checkbox);
                        wrapper.appendChild(label);

                        specializationContainer.appendChild(wrapper);
                    });
                })
                .catch(error => console.error('Error fetching specializations:', error));
        }

        window.onload = fetchSpecializations;
    </script>
</head>

<body>
  <?php include '../nav2.php'; ?>


  
  <section class="hero">
      <div class="container flex">
        <div class="hero__text">
          
          <div class="hero__features"></div>
          <!-- ///////////////////////////// -->
          <div class="hero__icon-shape">
            <img class="hero__icon--two animate1" src="/PG_wamp/images/hero/stethoscope.png" alt="hero shape" />
          </div>
        </div>
        <div class="hero__img">
          <!-- <img class="hero__main-img" src="/PG_wamp/images/hero/hero-man.png" alt="" /> -->
          <!-- <div class="hero__img-shape"></div>
          <div class="hero__img-shape"></div> -->
          <div class="hero__icon-shape">
            <!-- <img class="hero__icon--one animate3" src="/PG_wamp/images/hero/hospital.png" alt="hero shape" /> -->
            <!-- <img class="hero__icon--three animate-4" src="/PG_wamp/images/hero/medical-symbol.png" alt="hero shape" /> -->
            <img class="hero__icon--four animate-4" src="/PG_wamp/images/hero/medical-symbol (1).png" alt="hero shape" />
          </div>
        </div>
        <!-- //////////////////////////// -->
      </div>
    </section>      

    <div class="reyad_container">
        <h1>Doctor's Signup Form</h1>

        <form action="doctor_signup.php" method="post" class="signup-form">
            <label for="doctor_name">Full Name:</label>
            <input type="text" id="doctor_name" name="doctor_name" required>

            <label for="doctor_email">Email:</label>
            <input type="email" id="doctor_email" name="doctor_email" required>

            <label for="doctor_password">Password:</label>
            <input type="password" id="doctor_password" name="doctor_password" required>

            <label>Specialization:</label>
            <div id="specialization_container">
                Loading...
            </div>

            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" required>

            <label for="qualification">Qualification:</label>
            <input type="text" id="qualification" name="qualification" required>

            <label for="registration_number">Registration Number:</label>
            <input type="text" id="registration_number" name="registration_number" required>
      
            <label for="chamber_address">Chamber Location:</label>
            <input type="text" id="chamber_address" name="chamber_address" required>

            <input type="submit" value="Sign Up">
        </form>
        <link rel="stylesheet" href="./signup.css">
        <link rel="stylesheet" href="../general.css">

        <!-- <a href="../index.html" class="back-link">Back to Log in</a> -->
    </div>

</body>
</html>
