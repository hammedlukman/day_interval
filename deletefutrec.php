<?php
$con = mysqli_connect("localhost","root","","intervaldb") 
or die ("Cannot connect to database".mysqli_connect_error());
// $_GET['ID'];
$img = "DELETE  FROM futuretb  WHERE ID = '$_GET[ID]'";
$query = mysqli_query($con,$img) or die ("Access denied". mysqli_error($img));
// echo '<script> alert ("Delete successfully") </script>';
echo header("Location: future.php");
?>