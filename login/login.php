<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Doctor Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <!-- Dog SVG Source: https://www.youtube.com/watch?v=0u-ryYoDqVI -->

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;500;600;700&display=swap");

    * {
      box-sizing: border-box;
      text-transform: capitalize;
      font-family: "Poppins", sans-serif;
    }

    body {
      width: 100vw;
      height: 100vh;
      overflow: hidden;
    }

    .reyad_container {
      position: relative;
      top: 50%;
      left: 50%;
      display: inline-block;
      width: 100vw;
      height: 100vh;
      border-radius: 3px;
      transform: translate(-50%, -50%);
      overflow: hidden;
      /* background-image: linear-gradient(to top right, #f9a743, #f9db5f); */
      background-color: #e0ecff;


    }

    .reyad_container .ear {
      position: absolute;
      top: -110px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background-color: #243946;
    }

    .reyad_container .ear.ear--left {
      left: -135px;
    }

    .reyad_container .ear.ear--right {
      right: -135px;
    }

    .reyad_container .face {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 200px;
      height: 150px;
      margin: 80px auto 10px;
      --rotate-head: 0deg;
      transform: rotate(var(--rotate-head));
      transition: transform 0.2s;
      transform-origin: center 20px;
      /* background-image: url(main.png); */
      /* background-size:cover;    */
      /* background-position: center;  */
      /* background-repeat: no-repeat; */
    }

    .reyad_container .eye {
      display: inline-block;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background-color: #243946;
    }

    .reyad_container .eye.eye--left {
      margin-right: 40px;
    }

    .reyad_container .eye.eye--right {
      margin-left: 40px;
    }

    .reyad_container .eye .glow {
      position: relative;
      top: 13px;
      right: -12px;
      width: 12px;
      height: 6px;
      border-radius: 50%;
      background-color: #fff;
      transform: rotate(-30deg);
    }

    .reyad_container .eye.eye--right .glow {
      transform: rotate(12deg);
      right: -2px;
    }


    .reyad_container .nose {
      position: relative;
      top: 30px;
      transform: scale(1.1);
    }

    .reyad_container .nose .glow {
      position: absolute;
      top: 3px;
      left: 32%;
      width: 15px;
      height: 8px;
      border-radius: 50%;
      background-color: #476375;
    }

    .reyad_container .mouth {
      position: relative;
      margin-top: 45px;
    }

    .reyad_container svg.smile {
      position: absolute;
      left: -28px;
      top: -19px;
      transform: scaleX(1.1);
      stroke: #243946;
    }

    .reyad_container .mouth-hole {
      position: absolute;
      top: 0;
      left: -50%;
      width: 60px;
      height: 15px;
      border-radius: 50%/100% 100% 0% 0;
      transform: rotate(180deg);
      background-color: #243946;
      z-index: -1;
    }

    .reyad_container .tongue {
      position: relative;
      top: 5px;
      width: 30px;
      height: 20px;
      background-color: #ffd7dd;
      transform-origin: top;
      transform: rotateX(60deg);
    }

    .reyad_container .tongue.breath {
      -webkit-animation: breath 0.3s infinite linear;
      animation: breath 0.3s infinite linear;
    }

    .reyad_container .tongue-top {
      position: absolute;
      bottom: -15px;
      width: 30px;
      height: 30px;
      border-radius: 15px;
      background-color: #ffd7dd;
    }

    .reyad_container .line {
      position: absolute;
      top: 0;
      width: 30px;
      height: 5px;
      background-color: #fcb7bf;
    }

    .reyad_container .median {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 4px;
      height: 25px;
      border-radius: 5px;
      background-color: #fcb7bf;
    }

    .reyad_container .hands {
      position: relative;
    }

    .reyad_container .hands .hand {
      position: absolute;
      top: -3px;
      display: flex;
      transition: transform 0.5s ease-in-out;
      z-index: 1;
    }

    .reyad_container .hands .hand--left {
      left: -85px;
    }

    .reyad_container .hands .hand--left.hide {
      transform: translate(2px, -155px) rotate(-160deg);
    }

    .reyad_container .hands .hand--left.peek {
      transform: translate(0px, -120px) rotate(-160deg);
    }

    .reyad_container .hands .hand--right {
      left: 30px;
    }

    .reyad_container .hands .hand--right.hide {
      transform: translate(-6px, -155px) rotate(160deg);
    }

    .reyad_container .hands .hand--right.peek {
      transform: translate(-4px, -120px) rotate(160deg);
    }

    .reyad_container .hands .finger {
      position: relative;
      z-index: 0;
    }

    .reyad_container .hands .finger .bone {
      width: 20px;
      height: 20px;
      border: 2px solid #243946;
      border-bottom: none;
      border-top: none;
      background-color: #805e1c;
    }

    .reyad_container .hands .finger .nail {
      position: absolute;
      left: 0;
      top: 10px;
      width: 20px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid #243946;
      background-color: #805e1c;
      z-index: -1;
    }

    .reyad_container .hands .finger:nth-child(1),
    .reyad_container .hands .finger:nth-child(3) {
      left: 4px;
      z-index: 1;
    }

    .reyad_container .hands .finger:nth-child(1) .bone,
    .reyad_container .hands .finger:nth-child(3) .bone {
      height: 10px;
    }

    .reyad_container .hands .finger:nth-child(3) {
      left: -4px;
    }

    .reyad_container .hands .finger:nth-child(2) {
      top: -5px;
      z-index: 2;
    }

    .reyad_container .hands .finger:nth-child(1) .nail,
    .reyad_container .hands .finger:nth-child(3) .nail {
      top: 0px;
    }

    .reyad_container .tengah {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .reyad_container .login {
      position: relative;
      display: flex;
      flex-direction: column;
    }

    .reyad_container .login label {
      position: relative;
      /* padding: 0 20px; */
      display: block;
      width: 100%;
      padding: 0.375rem 0.75rem;
      /* font-size: 1rem; */
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border-radius: 10px;
      margin: 1px;
      opacity: 0.92;
    }

    .reyad_container .login label .fas {
      position: absolute;
      top: 32%;
      left: 25px;
      /* color: #bbb; */
      font-size: 1.2rem;
    }

    .reyad_container .login label .fas:before {
      position: relative;
      left: 1px;
    }

    .reyad_container .login input,
    .reyad_container .login .login-button {
      /* width: 100%; */
      height: 35px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
    }

    /* .reyad_container .fa-user {
  font-size: 1.3rem;
} */
    .reyad_container .login input {
      padding: 0 50px 0 0px;
      margin: 5px 0;
      box-shadow: none;
      outline: none;
    }

    .reyad_container .login input::-moz-placeholder {
      color: #ccc;
    }

    .reyad_container .login input:-ms-input-placeholder {
      color: #ccc;
    }

    .reyad_container .login input::placeholder {
      color: #ccc;
    }

    .reyad_container .login input.password {
      padding: 0 90px 0 40px;
    }

    .reyad_container .login .password-button {
      position: absolute;
      top: 15px;
      right: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      /* width: 80px; */
      height: 27px;
      border-radius: 10px;
      border: none;
      outline: none;
      background-color: inherit;
      color: #fff;
      font-size: 30px;
    }

    .reyad_container .login .password-button:active {
      transform: scale(0.95);
    }

    .reyad_container .login .login-button {
      width: 100%;
      margin: 20px 0px 0px;
      align-items: center;
      outline: none;
      background-color: #243946;
      color: #fff;
      transition: transform 0.1s;
    }

    .reyad_container .login .login-button:active {
      transform: scale(0.95);
    }

    .reyad_container .login .login-button:hover {
      background-color: #495e6b;
    }

    .reyad_container .footer {
      text-align: center;
      margin-top: 15px;
      font-size: 1rem;
      font-family: "Poppins", sans-serif;
    }

    .reyad_container .footer .footer-a {
      color: #243946;
      text-decoration: none;

      transition: all 0.2s ease-in-out 0.1s;
    }

    .reyad_container .footer .footer-a:hover {
      color: #fff;
    }

    @-webkit-keyframes breath {

      0%,
      100% {
        transform: rotateX(0deg);
      }

      50% {
        transform: rotateX(60deg);
      }
    }

    @keyframes breath {

      0%,
      100% {
        transform: rotateX(0deg);
      }

      50% {
        transform: rotateX(60deg);
      }
    }

    .center-image {
      position: absolute;
      top: 118%;
      left: 75%;
      transform: translate(-50%, -50%);
      z-index: -1;
      width: 450px;
    }
  </style>

    <!-- <link rel="stylesheet" href="../css/reset.css"> -->
    <!-- <script src="../js/script.js"></script> -->

</head>

<body>
<?php include '../nav2.php'; ?>
 
<section class="hero">
<link rel="stylesheet" href="../css/hero.css">
<link rel="stylesheet" href="../css/utility.css">
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


  <!-- SVG Image Start  -->
  <div class="reyad_container">
    <!-- <div class="ear ear--left"></div>
      <div class="ear ear--right"></div> -->
    <div class="reyad">
      <div class="face">
        <img src="../assets/main.png" class="center-image" alt="stethoscope">

        <div class="eyes">
          <div class="eye eye--left">
            <div class="glow"></div>
          </div>
          <div class="eye eye--right">
            <div class="glow"></div>
          </div>
        </div>
        <div class="nose">
          <svg width="38.161" height="22.03">
            <path
              d="M2.017 10.987Q-.563 7.513.157 4.754C.877 1.994 2.976.135 6.164.093 16.4-.04 22.293-.022 32.048.093c3.501.042 5.48 2.081 6.02 4.661q.54 2.579-2.051 6.233-8.612 10.979-16.664 11.043-8.053.063-17.336-11.043z"
              fill="#243946"></path>
          </svg>
          <div class="glow"></div>
        </div>
        <div class="mouth">
          <svg class="smile" viewBox="-2 -2 84 23" width="84" height="23">
            <path d="M0 0c3.76 9.279 9.69 18.98 26.712 19.238 17.022.258 10.72.258 28 0S75.959 9.182 79.987.161"
              fill="none" stroke-width="3" stroke-linecap="square" stroke-miterlimit="3"></path>
          </svg>
          <div class="mouth-hole"></div>
          <div class="tongue breath">
            <div class="tongue-top"></div>
            <div class="line"></div>
            <div class="median"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="tengah">
      <div class="hands">
        <div class="hand hand--left">
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
        </div>
        <div class="hand hand--right">
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
          <div class="finger">
            <div class="bone"></div>
            <div class="nail"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- SVG Image End -->

    <!-- Form Start -->
    <div class="tengah">
      <div class="login">
        <form action="doctor_login.php" method="post">
              
            <label>
              <div class="fas fa-user"></div>
              <input name="doctor_email" class="username" type="email" autocomplete="on" placeholder="Email" />
            </label>
            <label>
              <div class="fas fa-lock"></div>
              <input name="doctor_password" class="password" type="password" autocomplete="off" placeholder="password" />
              <button class="password-button">👁️</button>
            </label>
            <button type="submit" class="login-button">Log in</button>
        </form>
        <div class="footer">
        Don't have account yet?
        <a class="footer-a" href="../signup/doctor_signup_form.php">Sign Up</a>
      
        </div>
        
      </div>
    </div>

    <!-- Form End -->

    <!-- Footer Start  -->
    <!-- <div class="footer"> -->
      
       
    <!-- </div> -->
  </div>
  <!-- Footer End -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></scrip>
  <script>
    /*
Inspired by: "Login Page & Homepage"
By: Neo  Link: https://dribbble.com/shots/4485321-Login-Page-Homepage
*/

    let usernameInput = document.querySelector(".username");
    let passwordInput = document.querySelector(".password");
    let showPasswordButton = document.querySelector(".password-button");
    let face = document.querySelector(".face");

    passwordInput.addEventListener("focus", (event) => {
      document.querySelectorAll(".hand").forEach((hand) => {
        hand.classList.add("hide");
      });
      document.querySelector(".tongue").classList.remove("breath");
    });

    passwordInput.addEventListener("blur", (event) => {
      document.querySelectorAll(".hand").forEach((hand) => {
        hand.classList.remove("hide");
        hand.classList.remove("peek");
      });
      document.querySelector(".tongue").classList.add("breath");
    });

    usernameInput.addEventListener("focus", (event) => {
      let length = Math.min(usernameInput.value.length - 16, 19);
      document.querySelectorAll(".hand").forEach((hand) => {
        hand.classList.remove("hide");
        hand.classList.remove("peek");
      });

      face.style.setProperty("--rotate-head", `${-length}deg`);
    });

    usernameInput.addEventListener("blur", (event) => {
      face.style.setProperty("--rotate-head", "0deg");
    });

    usernameInput.addEventListener(
      "input",
      _.throttle((event) => {
        let length = Math.min(event.target.value.length - 16, 19);

        face.style.setProperty("--rotate-head", `${-length}deg`);
      }, 100)
    );

    showPasswordButton.addEventListener("click", (event) => {
      if (passwordInput.type === "text") {
        passwordInput.type = "password";
        document.querySelectorAll(".hand").forEach((hand) => {
          hand.classList.remove("peek");
          hand.classList.add("hide");
        });
      } else {
        passwordInput.type = "text";
        document.querySelectorAll(".hand").forEach((hand) => {
          hand.classList.remove("hide");
          hand.classList.add("peek");
        });
      }
    });

  </script>
</body>

</html>