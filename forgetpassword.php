<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "intervaldb") or die("can not connect to database" . mysqli_connect_error());
    
    if (isset($_POST['reset'])) {
        $email = $_POST['reset_email'];

        if (empty($email)) {
            echo "<script>alert('Please enter your email.');</script>";
        } else {
            // Check if the email exists in the database
            $check_email_query = "SELECT * FROM registrationtb WHERE Email = '$email'";
            $check_email_result = mysqli_query($con, $check_email_query);

            if (mysqli_num_rows($check_email_result) > 0) {
                // Generate a unique token
                $token = bin2hex(random_bytes(32));

                // Store the token in the database with the user's email
                $update_token_query = "UPDATE registrationtb SET ResetToken = '$token' WHERE Email = '$email'";
                mysqli_query($con, $update_token_query);

                // Display the reset link (for simulation purposes)
                $reset_link = "http://localhost/reset_password.php?token=$token";
                echo "<script>alert('Password reset link: $reset_link');</script>";
            } else {
                echo "<script>alert('Email not found.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 300px;
            margin: 170px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #log {
            text-align: center;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1c87c9;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #1c87c9;
        }
        .header-name {
            font-weight: bold;
            color: #1c87c9;
            padding: 0 60px;     
        }         
    </style>
</head>
<body>
    <h1 class="header-name">Web Diary </h1>
    <div class="container">
        <h2 align="center">FORGOT PASSWORD</h2>
        <form action="" method="post" id="log">
            <input type="email" name="reset_email" placeholder="Enter your email">
            <br><br>
            <input type="submit" value="Reset Password" name="reset">
        </form><br>
        Remember your password? <a href="login.php">Log in here </a>
    </div>
</body>
</html>
