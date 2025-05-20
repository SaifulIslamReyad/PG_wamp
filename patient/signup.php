<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Sign Up</title>
    <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="/PG_wamp/css/layout.css">
    <script src="../js/index.js"></script>
</head>

<body>
    <?php include '../navbar.php'; ?>

    <section class="hero">
        <div class="container flex">
            <div class="hero__text">       
                <div class="hero__features"></div>
                <div class="hero__icon-shape">
                    <img class="hero__icon--two animate1" src="/PG_wamp/images/hero/stethoscope.png" alt="hero shape" />
                </div>
            </div>
            <div class="hero__img">
                <div class="hero__icon-shape">
                    <img class="hero__icon--one animate3" src="/PG_wamp/images/hero/hospital.png" alt="hero shape" />
                    <img class="hero__icon--four animate-4" src="/PG_wamp/images/hero/medical-symbol (1).png" alt="hero shape" />
                </div>
            </div>
        </div>
    </section>

    <div class="reyad_container">
        <h2>Sign Up to Join Us</h2>
        <form action="patient_signup.php" method="post" id="signup">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" placeholder="Enter your date of birth" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <link rel="stylesheet" href="../css/general.css">
</body>

</html>
