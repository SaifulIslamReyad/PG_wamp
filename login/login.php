<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../general.css">
    <link rel="stylesheet" href="../nav.css">
    
</head>
<body>
<?php include '../nav.php'; ?>

      
    
    <div class="container">
        
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
           
        </form>
    </div>

</body>
</html>