<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন</title>
    <link rel="stylesheet" href="../general.css">
    <link rel="stylesheet" href="/PG_wamp/css/layout.css">
</head>

<body>

<?php include '../nav.php'; ?>
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
        <h2>আপনার মেডিকেল ইতিহাস দেখতে ও অ্যাপয়েন্টমেন্ট নিতে লগইন করুন</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="phone">ফোন নম্বর:</label>
                <input type="number" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">পাসওয়ার্ড:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">লগইন করুন</button>
            <p style="margin: 20px; font-size: 18px;">একাউন্ট নেই? 
                <a href="./signup.php">সাইন আপ করতে এখানে ক্লিক করুন</a>
            </p>
        </form>
    </div>
    <link rel="stylesheet" href="../general.css">

</body>

</html>
