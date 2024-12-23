<?php
session_start();
$email = $_SESSION['email'];

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
} else {
    include "header.php";
}

$con = mysqli_connect("localhost", "root", "", "intervaldb") or die("Cannot connect to database" . mysqli_connect_error());
$img = "SELECT * FROM registrationtb  WHERE Email='$email'";
$query = mysqli_query($con, $img) or die("Access denied" . mysqli_error($con));
$row = mysqli_fetch_array($query);

if (isset($_POST['update'])){
    $con = mysqli_connect("localhost", "root","", "intervaldb") or die("Cannot connect to database" . mysqli_connect_error());

    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];

    // Validate old password
    $check_oldpass_query = "SELECT Password FROM registrationtb WHERE Email = ?";
    $stmt = mysqli_prepare($con, $check_oldpass_query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $stored_password);
        mysqli_stmt_fetch($stmt);

        // Verify the old password
        if ($oldpass === $stored_password) {
            // Update the password
            $update_query = "UPDATE registrationtb SET Password = ? WHERE Email = ?";
            $update_stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'ss', $newpass, $email);
            mysqli_stmt_execute($update_stmt);

            echo "<script>alert('UPDATE SUCCESSFUL');</script>";
        } else {
            echo "<script>alert('Old password is incorrect.');</script>";
        }
    } else {
        echo "<script>alert('Error.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
<style>
 body {
  padding: 0;
  margin: 0;
  font-family:Arial, sans-serif;
  font-size: 14px;
  background:#f2f2f2;
}

h1 {
  margin: 0 0 20px;
  font-weight: 400;
  color: #1c87c9;
}

p {
  margin: 0 0 5px;
}

.main-block {
  /* display: flex;
  flex-direction: column; */
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

button:hover {
  background: #2371a0;
}

.right-part {
    margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background: #fff;
            border-radius: 6px;
            padding: 20px;
  
} 

@media (min-width: 768px) {
  .main-block {
    flex-direction: row;
  }
  .right-part, .form {
    width: 50%;
    color: black;
  }
}

        
    </style>
</head>
<body>

<div class="main-block">
    <form action="" method="post">
        <h1 align="center">Change Password</h1>
        <div class="info">
            <p>Old password: <input type="password" name="oldpass" id="oldpass"></p>
            <p>New password: <input type="password" name="newpass" id="newpass"></p>
            <input type="submit" value="Update Profile" class="button" name="update">
        </div>
    </form>
</div>

</body>
</html>
