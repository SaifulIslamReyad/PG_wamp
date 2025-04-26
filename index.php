<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription Generator</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="nav.css">
</head>

<body>

  <?php include 'nav.php'; ?>
  
<!-- <section class="hero">
  <h1>Welcome to CliniCode</h1>
  <p>Your digital partner for easy and quick prescription management</p>
</section> -->

  <div class="container">
    <!-- Doctor Login Card -->
    <div class="doctor-login card">
      <h2>Doctor's Login</h2>
      <p>Login into your dashboard doctor</p>
      <button onclick="window.location.href='login/login.php'">Log in</button>
      <p style="margin-top: 30px; font-size: 14px;">Don't have an account? 
        <a href="signup/doctor_signup_form.php">Click here to sign up</a>
      </p>
    </div>

    <!-- Patient Login Card -->
    <div class="patient-login card">
      <h2>Patient's Login</h2>
      <p>Login to book appointment and find your medical history</p>
      <button onclick="window.location.href='patient/login_page.php'">Log in</button>
      <p style="margin-top: 30px; font-size: 14px;">Don't have an account? 
        <a href="patient/signup.php">Click here to sign up</a>
      </p>
    </div>
  </div>

  <footer>
    <p>© 2025 CliniCode. All Rights Reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
  </footer>

</body>

</html>
