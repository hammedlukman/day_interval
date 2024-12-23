<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
if(isset($_POST['register'])){
    $con = mysqli_connect("localhost","root","","intervaldb") or die("can not connect to database".mysqli_connect_error());
    $name=$_POST['personname'];
    $num=$_POST['phonenum'];
    $mail=$_POST['personemail'];
    $passcode=$_POST['passwo'];

    if (empty($name) || empty($num) || empty($mail) || empty($passcode)) {
          echo "<script>alert('Please enter value into input.');</script>";
      } else{
    $check_email_query = "SELECT * FROM registrationtb WHERE Email = '$mail'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_result) > 0) {
        echo "<script>alert('Email already registered. Please use a different email.');</script>";
    } else {
        $insat = "INSERT INTO registrationtb(Name,PhoneNumber,Email,Password) values ('$name','$num','$mail','$passcode')"; 
        $queryy = mysqli_query($con, $insat) or die("can not access".mysqli_error($con));

        echo "<script>alert('SUCCESSFUL REGISTERED');</script>";
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
    <title>Registration</title>
    <head>
        <style>
           body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 300px;
            margin: 150px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #log {
            text-align: center;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
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
        .header-name{
  font-weight: bold;
  color: #1c87c9;
  padding:0 60px;     
}

        </style>
    </head>
</head>
<body>
    <h1 class="header-name">Web Diary</h1>
    <div class="container">
        <h2 align="center">REGISTRATION</h2>
        <form action="" method="post" enctype="multipart/form-data" id="log">
            <input type="text" name="personname" id="personname" placeholder="Name">
            <input type="text" name="phonenum" id="phonenum" placeholder="Phone Number">
            <input type="email" name="personemail" id="personemail" placeholder="Email">
            <input type="password" name="passwo" id="passwo" placeholder="Password">
            <input type="checkbox" onclick="togglePasswordVisibility()" id="viewPassword">
            <span >Show password</span>
            <br><br>
            <input type="submit" value="Register" name="register">
        </form><br>
        Already have an account? <a href="login.php">login here </a>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwo");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>