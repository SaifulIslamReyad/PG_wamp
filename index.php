<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CliniCode</title>
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />-
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="css/layout.css" />
  <link rel="stylesheet" href="index.css">
  <script src="index.js"></script>
  <style>
  </style>
</head>


<body>
  
 <?php include "navbar.php" ?>

<main>
        <section class="hero">
          <div class="container flex">
            <div class="hero__text">
              <h1 class="hero__heading">
                <br />
                From Appointment to Prescription – Fully Digital
              </h1>
              <p class="hero__description">
                <br />
                Providing you with the right service is our responsibility
              </p>
              <div class="hero__features">
                <div onclick="window.location.href='login/login.php'" class="hero__features-box">
                  <img src="images/hero/4.png" alt="features image" />
                  <span class="inup">Doctor Login / Signup</span>
                </div>
                <div onclick="window.location.href='patient/login_page.php'" class="hero__features-box">
                  <img src="images/hero/team.png" alt="features image" />
                  <span class="inup">Patient Login / Signup</span>
                </div>
              </div>
              <div class="hero__icon-shape">
                <img class="hero__icon--two animate1" src="images/hero/stethoscope.png" alt="hero shape" />
              </div>
            </div>
            <div class="hero__img">
              <img class="hero__main-img" src="images/hero/hero-man.png" alt="" />
              <div class="hero__img-shape"></div>
              <div class="hero__img-shape"></div>
              <div class="hero__icon-shape">
                <img class="hero__icon--one animate3" src="images/hero/hospital.png" alt="hero shape" />
                <img class="hero__icon--three animate-4" src="images/hero/medical-symbol.png" alt="hero shape" />
                <img class="hero__icon--four animate-4" src="images/hero/medical-symbol (1).png" alt="hero shape" />
              </div>
            </div>
          </div>
        </section>

        <section class="search">
          <div class="container flex justify-content-center">
            <div class="search__banner">
              <div class="flex gap-2 justify-content-center">
                <div class="search__inputs">
                  <div class="form-group">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input class="form-input" type="text" id="search" autocomplete="off"
                      placeholder="Search doctor by name" />
                  </div>
                  <div class="form-group">
                    <i class="fa-solid fa-location-dot"></i>
                    <input class="form-input" type="text" id="search" autocomplete="off"
                      placeholder="Search doctor by chamber location" />
                  </div>
                </div>
                <button type="button" class="btn btn__primary">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
              <div class="search__description flex flex-d-column gap-15">
                <p>You might be looking for</p>
                <div class="search__tags flex gap-1">
                  <button type="button" class="btn btn__secondary">
                    Dr. Ashraful Islam Suhad
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                  <button type="button" class="btn btn__secondary">
                    Dr. Jebin Zaman
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                  <button type="button" class="btn btn__secondary">
                    Barishal
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                  <button type="button" class="btn btn__secondary">
                    Khulna
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="popular-searches">
          <div class="container">
            <div class="section-title">
              <h2>Specialties</h2>
            </div>
            <div class="search__category">
              <ul class="search__tabs">
                <li class="tab__item active">General</li>
                <li class="tab__item">Dental</li>
                <li class="tab__item">Others</li>
              </ul>
              <div class="tabs__content">
                <div class="tab__content active" id="tab_content1">
                  <div class="categories-item-box item--one">
                    <div class="icon">
                      <img src="images/hair-loss.png" alt="Hair Loss" />
                    </div>
                    <p>Dermatology</p>
                  </div>
                  <div class="categories-item-box item--two">
                    <div class="icon">
                      <img src="images/pulmonology.png" alt="Internal Medicine" />
                    </div>
                    <p>Internal Medicine</p>
                  </div>
                  <div class="categories-item-box item--three">
                    <div class="icon">
                      <img src="images/neurology (1).png" alt="Neurology" />
                    </div>
                    <p>Neurology</p>
                  </div>
                  <div class="categories-item-box item--four">
                    <div class="icon">
                      <img src="images/dental-care.png" alt="Dental Care" />
                    </div>
                    <p>Dentistry</p>
                  </div>
                  <div class="categories-item-box item--five">
                    <div class="icon">
                      <img src="images/medicine.png" alt="General Medicine" />
                    </div>
                    <p>General Medicine</p>
                  </div>
                  <div class="categories-item-box item--six">
                    <div class="icon">
                      <img src="images/nose.png" alt="ENT" />
                    </div>
                    <p>ENT (Ear, Nose & Throat)</p>
                  </div>
                </div>

                <div class="tab__content" id="tab_content2">
                  <div class="categories-item-box item--six">
                    <div class="icon">
                      <img src="images/nose.png" alt="ENT" />
                    </div>
                    <p>ENT (Ear, Nose & Throat)</p>
                  </div>
                  <div class="categories-item-box item--five">
                    <div class="icon">
                      <img src="images/medicine.png" alt="General Medicine" />
                    </div>
                    <p>General Medicine</p>
                  </div>
                  <div class="categories-item-box item--four">
                    <div class="icon">
                      <img src="images/dental-care.png" alt="Dental Care" />
                    </div>
                    <p>Dentistry</p>
                  </div>
                  <div class="categories-item-box item--three">
                    <div class="icon">
                      <img src="images/neurology (1).png" alt="Neurology" />
                    </div>
                    <p>Neurology</p>
                  </div>
                  <div class="categories-item-box item--two">
                    <div class="icon">
                      <img src="images/pulmonology.png" alt="Internal Medicine" />
                    </div>
                    <p>Internal Medicine</p>
                  </div>
                  <div class="categories-item-box item--one">
                    <div class="icon">
                      <img src="images/hair-loss.png" alt="Hair Loss" />
                    </div>
                    <p>Dermatology</p>
                  </div>
                </div>

                <div class="tab__content" id="tab_content3">
                  <div class="categories-item-box item--one">
                    <div class="icon">
                      <img src="images/hair-loss.png" alt="Hair Loss" />
                    </div>
                    <p>Dermatology</p>
                  </div>
                  <div class="categories-item-box item--five">
                    <div class="icon">
                      <img src="images/medicine.png" alt="General Medicine" />
                    </div>
                    <p>General Medicine</p>
                  </div>
                  <div class="categories-item-box item--four">
                    <div class="icon">
                      <img src="images/dental-care.png" alt="Dental Care" />
                    </div>
                    <p>Dentistry</p>
                  </div>
                  <div class="categories-item-box item--three">
                    <div class="icon">
                      <img src="images/neurology (1).png" alt="Neurology" />
                    </div>
                    <p>Neurology</p>
                  </div>
                  <div class="categories-item-box item--two">
                    <div class="icon">
                      <img src="images/pulmonology.png" alt="Internal Medicine" />
                    </div>
                    <p>Internal Medicine</p>
                  </div>
                  <div class="categories-item-box item--six">
                    <div class="icon">
                      <img src="images/nose.png" alt="ENT" />
                    </div>
                    <p>ENT (Ear, Nose & Throat)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>



        <section class="find">
          <div class="container flex justify-content-between">
            <div class="find__text">
              <div class="section-title">
                <h2>
                  Find the Right Doctor <br />
                  Right at Your Fingertips
                </h2>
              </div>
              <ul class="find__list">
                <li class="find__item">
                  <i class="bx bx-search"></i>
                  <h3>Find Nearby Hospitals/Clinics</h3>
                  <p>
                    <br />
                  </p>
                </li>
                <li class="find__item">
                  <i class="bx bx-user-voice"></i>
                  <h3>Find Specialists</h3>
                  <p>
                    <br />
                  </p>
                </li>
                <li class="find__item">
                  <i class="bx bx-phone-call"></i>
                  <h3>Contact Us</h3>
                  <p>
                    <br />
                  </p>
                </li>
              </ul>
            </div>
            <div class="find__img">
              <img src="images/2-removebg-preview.png" alt="Doctor Search Image" />
              <div class="circle circle--one"></div>
              <div class="circle circle--two"></div>
              <div class="circle circle--three"></div>
              <div class="find__search">
                <h4>Find the Best Doctor for You</h4>
                <div class="form-group">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input class="form-input" type="text" id="search" placeholder="Define Specialty"
                    autocomplete="off" />
                </div>
                <div class="form-group">
                  <i class="fa-solid fa-location-dot"></i>
                  <input class="form-input" type="text" id="location" placeholder="Define Location"
                    autocomplete="off" />
                </div>
                <button type="button" class="btn btn__primary">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  Search Now
                </button>
              </div>
            </div>
          </div>
        </section>


        <section class="why-us">
          <div class="container flex justify-content-between flex-wrap">
            <div class="why-us__img">
              <img class="why-us__pic" src="images/1-removebg-preview.png" alt="Why Choose Us Image" />
              <div class="why-us__shape"></div>
              <ul class="doctors__list">
                <li class="doctors__item">
                  <img src="images/image-1.jpg" alt="Doctor List" />
                  <h4>Dr. Suhad</h4>
                  <i class="bx bx-dots-vertical-rounded"></i>
                </li>
                <li class="doctors__item">
                  <img src="images/image-2.jpg" alt="Doctor List" />
                  <h4>Dr. Zebin</h4>
                  <i class="bx bx-dots-vertical-rounded"></i>
                </li>
                <li class="doctors__item">
                  <img src="images/image-3.jpg" alt="Doctor List" />
                  <h4>Dr. Mizan</h4>
                  <i class="bx bx-dots-vertical-rounded"></i>
                </li>
                <li class="doctors__item">
                  <img src="images/image-4.jpg" alt="Doctor List" />
                  <h4>Dr. Sohan</h4>
                  <i class="bx bx-dots-vertical-rounded"></i>
                </li>
                <li class="doctors__item">
                  <img src="images/image-2.jpg" alt="Doctor List" />
                  <h4>Dr. Maria</h4>
                  <i class="bx bx-dots-vertical-rounded"></i>
                </li>
              </ul>
            </div>
            <div class="why-us__text">
              <div class="section-title">
                <h2>
                  Why You Should Choose CliniCode <br />
                  For Your Health
                </h2>
              </div>
              <ul class="why-us__list">
                <li class="why-us__item">
                  <i class="bx bx-check-circle"></i>
                  The best doctors and hospital services provided.
                </li>
                <li class="why-us__item">
                  <i class="bx bx-check-circle"></i>
                  Fast and reliable healthcare.
                </li>
                <li class="why-us__item">
                  <i class="bx bx-check-circle"></i>
                  Easily find doctors and hospitals.
                </li>
                <li class="why-us__item">
                  <i class="bx bx-check-circle"></i>
                  Trusted patient support and consultation services.
                </li>
                <li class="why-us__item">
                  <i class="bx bx-check-circle"></i>
                  Fast appointments and an easy booking process.
                </li>
              </ul>
              <button type="button" class="btn btn__primary">
                Get Free Certification
              </button>
            </div>
          </div>
        </section>


        <section class="specialist">
          <div class="container">
            <div class="section-title text-align-center">
              <h2>Meet Our Specialists</h2>
            </div>
            <div class="grid specialist__wrapper">
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/1-removebg-preview (1).png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Saif Riyad</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/2-removebg-preview (1).png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Fahad Ali</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/3-removebg-preview.png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Sayem Howlader</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/5-removebg-preview.png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Masuma Akter</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/2-removebg-preview (1).png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Kamal Sharif</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/3-removebg-preview.png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Siam Howlader</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/5-removebg-preview.png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Jannatul</a>
                  </h3>
                    <p>Dental Surgery</p>
                </div>
              </div>
              <div class="specialist__item">
                <div class="specialist__image">
                  <img src="images/1-removebg-preview (1).png" alt="Specialist Image" />
                  <div class="specialist__overlay">
                    <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
                  </div>
                </div>
                <div class="specialist__content">
                  <h3>
                    <a href="#">Dr. Akash</a>
                  </h3>
                  <p>Dental Surgery</p>
                </div>
              </div>
            </div>
            <div class="grid pagination__wrapper">
              <div class="pagination__list flex">
                <div class="pagination_btn"></div>
                <div class="pagination_btn"></div>
                <div class="pagination_btn"></div>
                <div class="pagination_btn"></div>
              </div>
            </div>
          </div>
        </section>


        <section class="subscribe">
          <div class="container">
            <div class="subscribe__box">
              <h3 class="subscribe__title">
                Subscribe for updates on any news
              </h3>
              <div class="subscribe__input-box">
                <div class="form-group">
                  <input class="form-input" type="text" id="search" placeholder="Enter your email address"
                    autocomplete="off" />
                  <button type="button" class="btn btn__primary">
                    Subscribe
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>


  </main>
  <button id="back-to-top" class="back-to-top">
    <i class="fa-solid fa-angle-up"></i>
  </button>
    <footer>
    <p>© 2025 CliniCode. All Rights Reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
  </footer>
</body>

</html>