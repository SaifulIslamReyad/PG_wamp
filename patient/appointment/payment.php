<?php
include '../../db_connect.php';

$phone = '01772977405';
// $query = "SELECT patient_phone FROM patient where patinet_id = 1 "; // Adjust LIMIT or WHERE clause as needed

// $result = mysqli_query($conn, $query);
// if ($row = mysqli_fetch_assoc($result)) {
//     $phone = htmlspecialchars($row['patient_phone']);
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment</title>
  <style>
    .payment-method-list {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      padding: 10px;
      justify-content: center;
    }
    .pay-method-item {
      display: flex;
      align-items: center;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px 15px;
      background-color: #fff;
      width: 150px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }
    .pay-method-item:hover {
      transform: translateY(-2px);
    }
    .icon {
      width: 48px;
      height: 48px;
      margin-right: 15px;
    }
    .title {
      font-weight: bold;
      font-size: 16px;
    }
    .subtitle {
      font-size: 13px;
      color: #666;
    }
    .verification {
      /* margin-top: 30px; */
      text-align: center;
    }
    .verification input {
      padding: 8px;
      width: 100%;
      font-size: 16px;
    }
  </style>
</head>
<body>
<strong>
  <p>Pay booking charge and keep the payment verification number </p></strong>

  <div class="payment-method-list">
    <div class="pay-method-item">
      <img class="icon" src="https://laz-img-cdn.alicdn.com/tfs/TB1Iey_osKfxu4jSZPfXXb3dXXa-96-96.png" alt="Credit/Debit Card">
      <div><div class="title">Card</div></div>
    </div>
    <div class="pay-method-item">
      <img class="icon" src="https://img.alicdn.com/imgextra/i3/O1CN01WCvNHS1szr0jNLEZT_!!6000000005838-2-tps-667-667.png" alt="Nagad">
      <div><div class="title">Nagad</div></div>
    </div>
    <div class="pay-method-item">
      <img class="icon" src="https://laz-img-cdn.alicdn.com/tfs/TB14FT1JpOWBuNjy0FiXXXFxVXa-400-400.png" alt="Bkash">
      <div><div class="title">Bkash</div></div>
    </div>
    <div class="pay-method-item">
      <img class="icon" src="https://gcp-img.slatic.net/basecamp/images/OSS_iWhp8Hi8_b09dedee68e947f9bde1f49182777d7f.png" alt="Rocket">
      <div><div class="title">Rocket</div></div>
    </div>
  </div>

  <div class="verification">
    <label for="pin">
    </label><br/>
    <input type="text" id="pin" name="pin" placeholder="      Enter payment verification number sent to you at <?php echo $phone; ?>">
  </div>

</body>
</html>
