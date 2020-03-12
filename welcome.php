<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./scss/main.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="welcome-form">
    <div class="page-header">
        <centre>
        <img id="login-logo" src="image-resized/black-samsung-logo.png" />    </centre>
        <header><h1>STOCK CONTROL SYSTEM</h1></header>

        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b><br><br><br>WELCOME TO THE SAMSUNG STOCK CONTROL SYSTEM</h1>
        <br><br><br><br>
    </div>
    <p>
        <a href="index.php" class="btn btn-warning">Access Samsung Stock Control System</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</div>
</body>
</html>