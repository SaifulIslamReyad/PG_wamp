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
        <h2>Log in to see your medical and history and take appointment</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="number" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

</body>

</html>