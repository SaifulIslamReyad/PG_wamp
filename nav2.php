<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>nothing</title>
  <link rel="shortcut icon" href="/PG_wamp/images/clinicode.png" type="image/x-icon" />

</head>


<style>

.cc-navbar {
    background-color: white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  }
  
  .cc-navbar-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 16px;
  }
  
  .cc-navbar-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 64px;
  }
  
  .cc-logo-brand {
    display: flex;
    align-items: center;
  }
  
  .cc-logo {
    height: 40px;
    width: auto;
    margin-right: 8px;
  }
  
  .cc-brand-name {
    font-size: 20px;
    font-weight: 600;
    color: #1e3a8a;
  }
  
  .cc-nav-links {
    display: flex;
    gap: 24px;
  }
  
  .cc-nav-link {
    text-decoration: none;
    font-weight: 500;
    color: #374151; 
    transition: color 0.3s ease-in-out;
  }
  
  .cc-nav-link:hover {
    color: #061d5c; 
  }
  
  @media (max-width: 640px) {
    .cc-nav-links {
      display: none;
    }
  }
  

</style>
<body>
  
<nav class="cc-navbar">
  <div class="cc-navbar-container">
    <div class="cc-navbar-inner">
      <!-- Logo + Brand -->
      <a href="/PG_wamp/index.php" style="text-decoration: none;">
        <div class="cc-logo-brand">
          <img class="cc-logo" src="/PG_wamp/assets/clinicode.png" alt="ZS Sharif Dental Logo" />
          <span class="cc-brand-name">CliniCode</span>
        </div>
      </a>
      <!-- Nav Links -->
      <div class="cc-nav-links">
        <a href="/PG_wamp/index.php" class="cc-nav-link">Home</a>
        <a href="#" class="cc-nav-link">About</a> 
        <a href="#" class="cc-nav-link">Our Doctors</a>
        <a href="#" class="cc-nav-link">Services</a>
        <a href="#" class="cc-nav-link">Contact</a>
        <a href="#" class="cc-nav-link">Help</a>
      </div>
    </div>
  </div>
</nav>

</body>
</html>
