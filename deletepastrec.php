<?php
$con = mysqli_connect("localhost","root","","intervaldb") 
or die ("Cannot connect to database".mysqli_connect_error());
// $_GET['ID'];
$del = "DELETE  FROM pasttb  WHERE ID = '$_GET[ID]'";
$query = mysqli_query($con,$del) or die ("Access denied". mysqli_error($del));
// echo '<script> alert ("Delete successfully") </script>';
echo header("Location: past.php");
?>