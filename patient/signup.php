<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রোগী সাইন আপ</title>
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
        <h2>আমাদের সাথে যোগ দিতে সাইন আপ করুন</h2>
        <form action="patient_signup.php" method="post" id="signup">
            <div class="form-group">
                <label for="name">পুরো নাম:</label>
                <input type="text" id="name" name="name" placeholder="আপনার পুরো নাম লিখুন" required>
            </div>

            <div class="form-group">
                <label for="dob">জন্ম তারিখ:</label>
                <input type="date" id="dob" name="dob" placeholder="আপনার জন্ম তারিখ লিখুন" required>
            </div>

            <div class="form-group">
                <label for="gender">লিঙ্গ:</label>
                <select name="gender" id="gender" required>
                    <option value="" disabled selected>লিঙ্গ নির্বাচন করুন</option>
                    <option value="M">পুরুষ</option>
                    <option value="F">নারী</option>
                    <option value="O">অন্যান্য</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone">ফোন নম্বর:</label>
                <input type="tel" id="phone" name="phone" placeholder="আপনার ফোন নম্বর লিখুন" required>
            </div>

            <div class="form-group">
                <label for="password">পাসওয়ার্ড:</label>
                <input type="password" id="password" name="password" placeholder="পাসওয়ার্ড লিখুন" required>
            </div>

            <button type="submit">সাবমিট করুন</button>
        </form>
    </div>
    <link rel="stylesheet" href="../css/general.css">

</body>

</html>
