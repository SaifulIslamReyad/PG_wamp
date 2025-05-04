<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Login</title>
    <link rel="stylesheet" href="../css/layout.css">
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
            <img class="hero__icon--one animate3" src="/PG_wamp/images/hero/hospital.png" alt="hero shape" />
            <!-- <img class="hero__icon--three animate-4" src="/PG_wamp/images/hero/medical-symbol.png" alt="hero shape" /> -->
            <img class="hero__icon--four animate-4" src="/PG_wamp/images/hero/medical-symbol (1).png" alt="hero shape" />
          </div>
        </div>
        <!-- //////////////////////////// -->
      </div>
    </section>


    <div class="reyad_container">
        <h2>Doctor's Login</h2>
        <form action="doctor_login.php" method="post">
        
            <label for="doctor_email">Email:</label>
            <input type="email" id="doctor_email" name="doctor_email" required>

            <label for="doctor_password">Password:</label>
            <input type="password" id="doctor_password" name="doctor_password" required>


            <input type="submit" value="Login">
            <p style="margin: 25px; font-size: 18px;">Don't have an account? 
        <a href="../signup/doctor_signup_form.php">Click here to sign up</a>
      </p>

      <link rel="stylesheet" href="../general.css">


           
        </form>

    </div>

</body>
</html>