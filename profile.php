<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
} else {
    include "header.php";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "intervaldb") or die("Cannot connect to the database" . mysqli_connect_error());

    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $mail = mysqli_real_escape_string($con, $_POST['mail']);
        $phonenum = mysqli_real_escape_string($con, $_POST['phonenum']);

        $update_query = "UPDATE registrationtb SET Name = '$name', PhoneNumber = '$phonenum' WHERE Email = '$mail'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            echo "<script>alert('Update successful');</script>";
        } else {
            echo '<script>alert("Update failed");</script>';
        }
    }
}

$con = mysqli_connect("localhost", "root", "", "intervaldb") or die("Cannot connect to the database" . mysqli_connect_error());
$email = $_SESSION['email'];
$img_query = "SELECT * FROM registrationtb  WHERE Email='$email'";
$query_result = mysqli_query($con, $img_query) or die("Access denied" . mysqli_error($con));
$row = mysqli_fetch_array($query_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 14px;
            background: #f2f2f2;
        }

        h1 {
            margin: 0 0 20px;
            font-weight: 400;
            color: #1c87c9;
        }

        .main-block {
            justify-content: center;
            padding: 30px;
        }

        form {
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background: #fff;
            border-radius: 6px;
            padding: 20px;
        }

        input {
            width: calc(100% - 18px);
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #1c87c9;
            outline: none;
        }

        .button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #1c87c9;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background: #2371a0;
        }

        .change {
            background: #1c87c9;
            color: #fff;
            padding: 15px 30px;
            border-radius: 6px;
            font-size: 17px;
            /* position: absolute;
            right:30px;
            top:100px; */
        
            margin-top: 20px;
        }
        .change:hover{
          background: #1c87c9;
            color: #fff;
            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="main-block">
    <form action="" method="post"><br>
    <a href="changepassword.php" class="change">Change Password</a><br><br>
        <h1 align="center">Edit Profile</h1>
        <div class="info">
            <p>Name: <input type="text" name="name" id="name" value="<?php echo $row['Name']; ?>"></p>
            <p>Email: <input type="email" name="mail" id="mail" value="<?php echo $row['Email']; ?>"readonly></p>
            <p>Phone Number: <input type="number" name="phonenum" id="phonenum"value="<?php echo $row['PhoneNumber']; ?>" readonly></p>
            <input type="submit" value="Update Profile" class="button" name="update">
        </div>
        

    </form>
</div>

</body>
</html>
