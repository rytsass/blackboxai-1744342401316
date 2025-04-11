<?php
session_start();
$name = isset($_SESSION['name']) ? $_SESSION['$name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <h1>Thank You, <?php echo htmlspecialchars($name); ?>!</h1>
    <p>Your subscription has been received. You will receive personalized recipes soon.</p>
    <a href="logged-in.html">Go back to the homepage</a>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin-top: 20%;
        background-color: #ddf6cd;
    }
    h1 {
        color:rgb(43, 62, 30);
    }
    a {
        color: rgb(43, 62, 30);
        text-decoration: underline;

    }   
    p {
        color: rgb(43, 62, 30);
    }