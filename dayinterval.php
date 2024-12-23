<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:login.php');
    exit();
}else{
  include "header.php" ;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Web Diary</title>
<script>
function calculateInterval() {
  var from = document.getElementById('from').value;
  var to = document.getElementById('to').value;

  if (!from || !to) {
    alert('Please enter values in both text boxes.');
    return;
  }

  var fromDate = new Date(from);
  var toDate = new Date(to);

  var diffTime = toDate - fromDate;
  var diffDays = parseInt(diffTime / (86400000));
  var diffWeeks = parseInt(diffDays / 7);
  var diffMonths = (toDate.getFullYear() - fromDate.getFullYear()) * 12 + (toDate.getMonth() - fromDate.getMonth());
  var diffYears = parseInt(diffMonths / 12);

  var years = parseInt(diffDays / 365);
  var remainingDays = diffDays % 365;
  var months = parseInt(remainingDays / 30);
  var remainingMonths = remainingDays % 30;
  var weeks = parseInt(remainingMonths / 7);
  var remainingdays = remainingMonths % 7;

  document.getElementById('result').innerHTML =
    'Days: ' + diffDays + '<br>' +
    'Weeks: ' + diffWeeks + '<br>' +
    'Months: ' + diffMonths + '<br>' +
    'Years: ' + diffYears + '<br>' +
    'Years: ' + years + ', Months: ' + months + ', Weeks: ' + weeks + ', Days: ' + remainingdays;
}
</script>


<style>
html, body {
  padding: 0;
  margin: 0;
  font-family: Roboto, Arial, sans-serif;
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
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.form {
  padding: 25px;
  margin: 25px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  background: #fff;
  border-radius: 6px;
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
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  background: #fff;
  border-radius: 6px;
  width: 400px;
  height: 270px;
  margin-top: 20px;
  padding: 10px;
  font-size:20px;
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
    <div class="form">
      <h1 align="center">Date Interval Calculator</h1>
      <div class="info">
        <p>From:<input type="date" id="from" required></p>
        <p>To:<input type="date" id="to" required></p>
      </div>
      <button  class="button" onclick="calculateInterval()">Calculate</button> <br> <br>
    </div>
    <div class="right-part">
      <h1 align="center" >Response</h1>
      <div id="result"></div>
    </div>
  </div>
</body>
</html>
