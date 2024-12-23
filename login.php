<?php
session_start();

if(isset($_POST['login'])){
$con = mysqli_connect("localhost","root","","intervaldb") or die("can not connect to database".mysqli_connect_error());
$_SESSION['email'] = $_POST['email'];
$email = $_SESSION['email'];
$pass =$_POST['pass'];
if (empty($email) || empty($pass)) {
          echo "<script>alert('Please enter value into input.');</script>";
} else {
$check ="SELECT * FROM registrationtb WHERE Email='$email' and Password='$pass'";
$pro =mysqli_query($con, $check) or die ("Access denied ".mysqli_error($con));
$result = mysqli_num_rows($pro);
if ($result>0){
    $_SESSION['loggedin'] = true;
header('Location:dayinterval.php');
}
else{
echo "<script> alert('WRONG DETAILS');</script>";
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
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
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

        input[type="text"],
        input[type="email"],
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
<body>
<h1 class="header-name">Web Diary </h1>
    <div class="container">
        <h2 align="center">LOGIN</h2>
        <form action="" method="post" id="log" name="log">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" id="pass" placeholder="Password">
            <input type="checkbox" onclick="togglePasswordVisibility()" id="viewPassword">
            <span >Show password</span>
            <br><br>
            <input type="submit" value="Log In" name="login">
        </form><br>
        <!-- <a href="forgetpassword.php">Forget Password?</a> <br><br> -->
        Create an account? <a href="Register.php">Register here </a>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("pass");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
