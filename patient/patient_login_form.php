<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>form</title>
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    />
    <link rel="stylesheet" href="../css/dog_form.css" />
    <link rel="stylesheet" href="../css/hero.css" />
    <link rel="stylesheet" href="../css/utility_hero.css" />
    <link rel="stylesheet" href="../css/animation.css" />
    

    <script src="../js/dog_form.js" defer></script>
  </head>
  <body>
    <?php include "../navbar.php" ?>
    <section class="hero">
              <div class="container-hero flex">
                <div class="hero__text">
                  <div class="hero__icon-shape">
                    <img class="hero__icon--two animate1" src="/PG_wamp/images/hero/stethoscope.png" alt="hero shape" />
                  </div>
                </div>
                <div class="hero__img">
                  <div class="hero__icon-shape">
                    <img class="hero__icon--four animate-4" src="/PG_wamp/images/hero/medical-symbol (1).png" alt="hero shape" />
                  </div>
                </div>
              </div>
    </section>

    <div class="container-inup-form">
      <div class="reyad">

      <div class="face">
      <img src="/PG_wamp/images/stethoscope.png" class="center-image" alt="stethoscope">

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
              fill="#243946"
            ></path>
          </svg>
          <div class="glow"></div>
        </div>
        <div class="mouth">
          <svg class="smile" viewBox="-2 -2 84 23" width="84" height="23">
            <path
              d="M0 0c3.76 9.279 9.69 18.98 26.712 19.238 17.022.258 10.72.258 28 0S75.959 9.182 79.987.161"
              fill="none"
              stroke-width="3"
              stroke-linecap="square"
              stroke-miterlimit="3"
            ></path>
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

    <div class="tengah">
      <div class="login">
        <form action="login.php" method="post">
              
            <label>
              <div class="fas fa-user"></div>
              <input name="phone" class="username" type="number" autocomplete="on" placeholder="Phone" />
            </label>
            <label>
              <div class="fas fa-lock"></div>
              <input name="password" class="password" type="password" autocomplete="off" placeholder="Password" />
              <button class="password-button-eye">👁️</button>
            </label>
            <button type="submit" class="login-button">Log in</button>
        </form>
        <div class="footer">
        Don't have account yet?
        <a class="footer-a" href="./signup.php">Sign Up</a>
      
        </div>
        
      </div>
    </div>

      
    <link rel="stylesheet" href="../css/dog_form.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></script>
  </body>
</html>