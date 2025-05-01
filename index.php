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
  <link rel="stylesheet" href="footer.css">

  <style>
    footer {
      margin: 60px auto;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #607d8b;
    }
    .cc-logo-brand {
      display: flex;
      align-items: center;
    }

    .cc-logo {
      height: 40px;
      width: auto;
      margin-right: 8px;
      border: 1px solid;
      border-radius: 20%;
    }

    .cc-brand-name {
      font-size: 20px;
      font-weight: 600;
      color: #1e3a8a;
    }

    .inup {
      padding: 5px;
    }
    .inup:hover {
      transform: scale(1.1) translateX(3px);
    }
    

  </style>
</head>


<body>
 <?php include "nav.php" ?>
  <!-- main -->
  <main>
    <!-- hero -->
    <section class="hero">
      <div class="container flex">
        <div class="hero__text">
          <h1 class="hero__heading">
            <br />
            এপয়েন্টমেন্ট থেকে প্রেসক্রিপশন সম্পূর্ণ ডিজিটাল
          </h1>
          <p class="hero__description">

            <br />
            আপনাকে সঠিক সেবা দেয়া আমাদের দায়িত্ব
          </p>
          <div class="hero__features">
            <div onclick="window.location.href='login/login.php'" class="hero__features-box">
              <img src="images/hero/4.png" alt="features image" />

              <span  class="inup">

                ডাক্তার লগইন / সাইনআপ</span>
            </div>
            <div onclick="window.location.href='patient/login_page.php'" class="hero__features-box">
              <img src="images/hero/team.png" alt="features image" />
              <span  class="inup"> রোগী লগইন / সাইনআপ</span>
            </div>
          </div>
          <!-- ///////////////////////////// -->
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
        <!-- //////////////////////////// -->
      </div>
    </section>
    <!-- search -->
    <section class="search">
      <div class="container flex justify-content-center">
        <div class="search__banner">
          <!-- search inputs -->
          <div class="flex gap-2 justify-content-center">
            <div class="search__inputs">
              <div class="form-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="form-input" type="text" id="search" autocomplete="off"
                  placeholder="নাম দিয়ে ডাক্তার খুঁজে বের করুন" />
              </div>
              <div class="form-group">
                <i class="fa-solid fa-location-dot"></i>
                <input class="form-input" type="text" id="search" autocomplete="off"
                  placeholder="চেম্বার লোকেশন দিয়ে ডাক্তার খুঁজে বের করুন " />
              </div>
            </div>
            <button type="button" class="btn btn__primary">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
          <!-- search tags -->
          <div class="search__description flex flex-d-column gap-15">
            <p>আপনি সম্ভবত খুঁজছেন</p>
            <div class="search__tags flex gap-1">
              <button type="button" class="btn btn__secondary">
                ডা. আশরাফুল ইসলাম সুহাদ
                <i class="fa-solid fa-xmark"></i>
              </button>
              <button type="button" class="btn btn__secondary">
                ডা. জেবিন জামান
                <i class="fa-solid fa-xmark"></i>
              </button>
              <button type="button" class="btn btn__secondary">
                বরিশাল
                <i class="fa-solid fa-xmark"></i>
              </button>
              <button type="button" class="btn btn__secondary">
                খুলনা
                <i class="fa-solid fa-xmark"></i>
              </button>
              <!-- <button type="button" class="btn btn__secondary">
                  COVID-19
                  <i class="fa-solid fa-xmark"></i>
                </button>
                <button type="button" class="btn btn__secondary">
                  Orthopedic Surgery
                  <i class="fa-solid fa-xmark"></i>
                </button>
                <button type="button" class="btn btn__secondary btn__more">
                  More
                </button> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--popular search -->
    <section class="popular-searches">
      <div class="container">
        <!-- section title -->
        <div class="section-title">
          <h2>বিশেষত্ব সমূহ</h2>
        </div>
        <!-- section main part -->
        <div class="search__category">
          <!-- search tabs list -->
          <ul class="search__tabs">
            <li class="tab__item active">সাধারন</li>
            <li class="tab__item">দন্ত</li>
            <li class="tab__item">অন্যান্য</li>
          </ul>
          <!-- search tabs content -->
          <div class="tabs__content">
            <div class="tab__content active" id="tab_content1">
              <div class="categories-item-box item--one">
                <div class="icon">
                  <img src="images/hair-loss.png" alt="চুল পড়া" />
                </div>
                <p>চর্মরোগবিদ্যা</p>
              </div>
              <div class="categories-item-box item--two">
                <div class="icon">
                  <img src="images/pulmonology.png" alt="ইন্টারনাল মেডিসিন" />
                </div>
                <p>অভ্যন্তরীণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--three">
                <div class="icon">
                  <img src="images/neurology (1).png" alt="স্নায়ুবিদ্যা" />
                </div>
                <p>স্নায়ুবিদ্যা</p>
              </div>
              <div class="categories-item-box item--four">
                <div class="icon">
                  <img src="images/dental-care.png" alt="ডেন্টাল কেয়ার" />
                </div>
                <p>ডেন্টিস্ট্রি</p>
              </div>
              <div class="categories-item-box item--five">
                <div class="icon">
                  <img src="images/medicine.png" />
                </div>
                <p>সাধারণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--six">
                <div class="icon">
                  <img src="images/nose.png" />
                </div>
                <p>নাক, কান ও গলা রোগ</p>
              </div>
            </div>

            <div class="tab__content" id="tab_content2">
              <div class="categories-item-box item--six">
                <div class="icon">
                  <img src="images/nose.png" />
                </div>
                <p>নাক, কান ও গলা রোগ</p>
              </div>
              <div class="categories-item-box item--five">
                <div class="icon">
                  <img src="images/medicine.png" />
                </div>
                <p>সাধারণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--four">
                <div class="icon">
                  <img src="images/dental-care.png" alt="ডেন্টাল কেয়ার" />
                </div>
                <p>ডেন্টিস্ট্রি</p>
              </div>
              <div class="categories-item-box item--three">
                <div class="icon">
                  <img src="images/neurology (1).png" alt="স্নায়ুবিদ্যা" />
                </div>
                <p>স্নায়ুবিদ্যা</p>
              </div>
              <div class="categories-item-box item--two">
                <div class="icon">
                  <img src="images/pulmonology.png" alt="ইন্টারনাল মেডিসিন" />
                </div>
                <p>অভ্যন্তরীণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--one">
                <div class="icon">
                  <img src="images/hair-loss.png" alt="চুল পড়া" />
                </div>
                <p>চর্মরোগবিদ্যা</p>
              </div>
            </div>

            <div class="tab__content" id="tab_content3">
              <div class="categories-item-box item--one">
                <div class="icon">
                  <img src="images/hair-loss.png" alt="চুল পড়া" />
                </div>
                <p>চর্মরোগবিদ্যা</p>
              </div>
              <div class="categories-item-box item--five">
                <div class="icon">
                  <img src="images/medicine.png" />
                </div>
                <p>সাধারণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--four">
                <div class="icon">
                  <img src="images/dental-care.png" alt="ডেন্টাল কেয়ার" />
                </div>
                <p>ডেন্টিস্ট্রি</p>
              </div>
              <div class="categories-item-box item--three">
                <div class="icon">
                  <img src="images/neurology (1).png" alt="স্নায়ুবিদ্যা" />
                </div>
                <p>স্নায়ুবিদ্যা</p>
              </div>
              <div class="categories-item-box item--two">
                <div class="icon">
                  <img src="images/pulmonology.png" alt="ইন্টারনাল মেডিসিন" />
                </div>
                <p>অভ্যন্তরীণ চিকিৎসা</p>
              </div>
              <div class="categories-item-box item--six">
                <div class="icon">
                  <img src="images/nose.png" />
                </div>
                <p>নাক, কান ও গলা রোগ</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="find">
      <div class="container flex justify-content-between">
        <div class="find__text">
          <!-- section title -->
          <div class="section-title">
            <h2>
              সঠিক চিকিৎসক খুঁজুন <br />
              আপনার হাতের নাগাল থেকেই
            </h2>
            <!-- <p>ক্লিনিকোড আপনাকে প্রয়োজনীয় তথ্য ও সরঞ্জাম সরবরাহ করে</p> -->
          </div>
          <ul class="find__list">
            <li class="find__item">
              <i class="bx bx-search"></i>
              <h3>নিকটস্থ হাসপাতাল/চেম্বার খুঁজুন</h3>
              <p>
                <br />

              </p>
            </li>
            <li class="find__item">
              <i class="bx bx-user-voice"></i>
              <h3>বিশেষজ্ঞ খুঁজুন</h3>
              <p>
                <br>
              </p>
            </li>
            <li class="find__item">
              <i class="bx bx-phone-call"></i>
              <h3>যোগাযোগ করুন</h3>
              <p>
                <br />
              </p>
            </li>
          </ul>
        </div>
        <div class="find__img">
          <img src="images/2-removebg-preview.png" alt="ডাক্তার খুঁজুন ছবি" />
          <div class="circle circle--one"></div>
          <div class="circle circle--two"></div>
          <div class="circle circle--three"></div>
          <div class="find__search">
            <h4>আপনার জন্য সেরা চিকিৎসক খুঁজুন</h4>
            <div class="form-group">
              <i class="fa-solid fa-magnifying-glass"></i>
              <input class="form-input" type="text" id="search" placeholder="স্পেশালিটি নির্ধারণ করুন"
                autocomplete="off" />
            </div>
            <div class="form-group">
              <i class="fa-solid fa-location-dot"></i>
              <input class="form-input" type="text" id="location" placeholder="লোকেশন নির্ধারণ করুন"
                autocomplete="off" />
            </div>
            <button type="button" class="btn btn__primary">
              <i class="fa-solid fa-magnifying-glass"></i>
              অনুসন্ধান করুন
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Why choose us -->
    <section class="why-us">
      <div class="container flex justify-content-between flex-wrap">
        <div class="why-us__img">
          <img class="why-us__pic" src="images/1-removebg-preview.png" alt="কেন আমাদের নির্বাচন করবেন ছবি" />
          <div class="why-us__shape"></div>
          <ul class="doctors__list">
            <li class="doctors__item">
              <img src="images/image-1.jpg" alt="ডাক্তারের তালিকা" />
              <h4>ডা. সুহাদ</h4>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="doctors__item">
              <img src="images/image-2.jpg" alt="ডাক্তারের তালিকা" />
              <h4>ডা. জেবিন</h4>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="doctors__item">
              <img src="images/image-3.jpg" alt="ডাক্তারের তালিকা" />
              <h4>ডা. মিজান</h4>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="doctors__item">
              <img src="images/image-4.jpg" alt="ডাক্তারের তালিকা" />
              <h4>ডা. সোহান</h4>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
            <li class="doctors__item">
              <img src="images/image-2.jpg" alt="ডাক্তারের তালিকা" />
              <h4>ডা. মারিয়া</h4>
              <i class="bx bx-dots-vertical-rounded"></i>
            </li>
          </ul>
        </div>
        <div class="why-us__text">
          <!-- section title -->
          <div class="section-title">
            <h2>
              কেন আপনি CliniCode <br />
              নির্বাচন করবেন
            </h2>
            <!-- <p>Wecare আপনাকে প্রয়োজনীয় তথ্য ও সরঞ্জাম সরবরাহ করে</p>  -->
          </div>
          <ul class="why-us__list">
            <li class="why-us__item">
              <i class="bx bx-check-circle"></i>
              সেরা চিকিৎসক এবং হাসপাতাল সার্ভিস প্রদান।
            </li>
            <li class="why-us__item">
              <i class="bx bx-check-circle"></i>
              দ্রুত এবং নির্ভরযোগ্য স্বাস্থ্যসেবা।
            </li>
            <li class="why-us__item">
              <i class="bx bx-check-circle"></i>
              সহজে ডাক্তার ও হাসপাতাল খুঁজে পাওয়া যায়।
            </li>
            <li class="why-us__item">
              <i class="bx bx-check-circle"></i>
              বিশ্বস্ত রোগী সহায়তা এবং পরামর্শ সেবা।
            </li>
            <li class="why-us__item">
              <i class="bx bx-check-circle"></i>
              দ্রুত অ্যাপয়েন্টমেন্ট এবং সহজ বুকিং প্রক্রিয়া।
            </li>
          </ul>
          <button type="button" class="btn btn__primary">
            বিনামূল্যে সার্টিফিকেশন নিন
          </button>
        </div>
      </div>
    </section>

    <!-- specialist -->
    <section class="specialist">
      <div class="container">
        <!-- section title -->
        <div class="section-title text-align-center">
          <h2>আমাদের বিশেষজ্ঞদের সাথে পরিচিত হন</h2>
          <!-- <p>আমরা আপনাকে প্রয়োজনীয় সরঞ্জাম এবং তথ্য প্রদান করি</p> -->
        </div>
        <!-- specialist part -->
        <div class="grid specialist__wrapper">
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/1-removebg-preview (1).png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. সাইফ রিয়াদ</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/2-removebg-preview (1).png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. ফাহাদ আলি</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/3-removebg-preview.png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. সায়েম হাওলাদার</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/5-removebg-preview.png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. মাসুমা আক্তার</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/2-removebg-preview (1).png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. কামাল শরীফ</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/3-removebg-preview.png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. সিয়াম হাওলাদার</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/5-removebg-preview.png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. জান্নাতুল</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
            </div>
          </div>
          <!-- item -->
          <div class="specialist__item">
            <div class="specialist__image">
              <img src="images/1-removebg-preview (1).png" alt="বিশেষজ্ঞের ছবি" />
              <div class="specialist__overlay">
                <a class="specialist__link" href="#"><i class="bx bx-link-alt"></i></a>
              </div>
            </div>
            <div class="specialist__content">
              <h3>
                <a href="#">ডা. আকাশ</a>
              </h3>
              <p>ডেন্টাল সার্জারি</p>
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

    <!-- feedback -->
    <!-- <section class="feedback">
        <div class="container">
            <div class="section-title text-align-center">
                <h2>আমাদের রোগীদের প্রতিক্রিয়া আমাদের সম্পর্কে</h2>
                <p>
                    আমরা 1987 সাল থেকে Medi House পেশাদার পরিষেবা প্রদান করে আসছি। সফলভাবে আমরা রোগীদের যত্ন নিচ্ছি।
                </p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <div class="feedback__media">
                    <img src="images/header-slide-img3.png" alt="feedback image" />
                    <div class="feedback__shape"></div>
                </div>
                <div class="feedback__content">
                    <div class="feedback__user">
                        <div class="feedback__user-img">
                            <img src="images/pic4.jpg" alt="feedback image" />
                        </div>
                        <div class="feedback__user-info">
                            <h4>শিবা এসলামি</h4>
                            <p>তাবরিজ, ইরান</p>
                            <div class="feedback__rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>
                        </div>
                    </div>
                    <p class="feedback__description">
                        "আমি ২০২৩ সাল থেকে ক্লিনিকোড এর  পরিষেবা গ্রহণ করে আসছি। ক্লিনিকোসফলভাবে আমরা রোগীদের
                        যত্ন নিচ্ছি এবং এটি আমাদের জন্য অত্যন্ত গুরুত্বপূর্ণ।"
                    </p>
                    <div class="grid pagination__wrapper">
                        <div class="pagination__list flex">
                            <div class="pagination_btn"></div>
                            <div class="pagination_btn"></div>
                            <div class="pagination_btn"></div>
                            <div class="pagination_btn"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- subscribe  -->
    <section class="subscribe">
      <div class="container">
        <div class="subscribe__box">
          <h3 class="subscribe__title">
            যেকোনো খবরের আপডেটের<br />
            জন্য সাবস্ক্রাইব করুন
          </h3>
          <div class="subscribe__input-box">
            <div class="form-group">
              <input class="form-input" type="text" id="search" placeholder="আপনার ইমেল ঠিকানা দিন"
                autocomplete="off" />
              <button type="button" class="btn btn__primary">
                সাবস্ক্রাইব করুন
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
  <!-- footer -->
  <!-- <footer class="footer">
      <div class="container footer__wrapper">
        <div class="footer__item">
          <div class="footer__logo">
            <a class="site-logo" href="index.html">
              <i class="fa-solid fa-circle-plus"></i>
              CliniCode
            </a>
          </div>
          <div class="footer__social">
            <a class="footer__socials-list" href="#">
              <i class="fa-brands fa-facebook-square"></i>
            </a>
            <a class="footer__socials-list" href="#">
              <i class="bx bxl-linkedin-square"></i>
            </a>
            <a class="footer__socials-list" href="#">
              <i class="bx bxl-skype"></i>
            </a>
            <a class="footer__socials-list" href="#">
              <i class="bx bxl-twitter"></i>
            </a>
            <a class="footer__socials-list" href="#">
              <i class="bx bxl-youtube"></i>
            </a>
            <a class="footer__socials-list" href="#">
              <i class="bx bxl-medium"></i>
            </a>
          </div>
        </div>
        <div class="footer__item">
          <h4>For Patients</h4>
          <ul class="footer__navbar">
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Dental Services</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Emergency Medicine</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Ophthalmology</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Orthopedic Surgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Neurosurgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Radiation Oncology</a>
            </li>
          </ul>
        </div>
        <div class="footer__item">
          <h4>For Providers</h4>
          <ul class="footer__navbar">
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Dental Services</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Emergency Medicine</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Ophthalmology</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Orthopedic Surgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Neurosurgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Radiation Oncology</a>
            </li>
          </ul>
        </div>
        <div class="footer__item">
          <h4>For Partners</h4>
          <ul class="footer__navbar">
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Dental Services</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Emergency Medicine</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Ophthalmology</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Orthopedic Surgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Neurosurgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Radiation Oncology</a>
            </li>
          </ul>
        </div>
        <div class="footer__item">
          <h4>For Partners</h4>
          <ul class="footer__navbar">
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Dental Services</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Emergency Medicine</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Ophthalmology</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Orthopedic Surgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Neurosurgery</a>
            </li>
            <li class="footer__nav-item">
              <a class="footer__nav-link" href="#">Radiation Oncology</a>
            </li>
          </ul>
        </div>
      </div>
    </footer> -->
    <footer>
    <p>© 2025 CliniCode. All Rights Reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
  </footer>
  <script src="./js/script.js"></script>
</body>

</html>