<?php
session_start();
$email = $_SESSION['email'];
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}else{
  include "header.php" ;
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intervaldb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Interval Calculator</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    


    <style>
        th, td {
            border: 1px solid #1c87c9;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #fff;
            color: #1c87c9;
        }
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
  display: flex;
  flex-direction: column;
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1  style='text-align:center'>Future Event</h1>
            <div class="info">
                <p>Date and Time: <input type="datetime-local" name="to" id="to" ></p>
                <p>Event: <input type="text" name="txt" id="txt"></p>
                <button type="submit" class="button" name="submit">Set Future Event</button><br><br>
                <input type="submit" class="button" name="viewtable" value="View Record">
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {        
            if (isset($_POST['viewtable'])) {
                reload_page($servername, $dbname, $username, $password, $email);
            } elseif (isset($_POST['submit'])) {
                $date = $_POST['to'];
                $event = $_POST['txt'];
        
                // Check if the text box is empty
                if (empty($event) || empty($date)) {
                    echo "<script>alert('Please enter value into input.');</script>";
                } else {
                    $sql = "INSERT INTO futuretb (Email, Date, Event) VALUES ('$email','$date', '$event')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script> alert('Data saved successfully.');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    reload_page($servername, $dbname, $username, $password, $email);
                }
            }
        }
        $conn->close();

        function reload_page($servername, $dbname, $username, $password, $email) {
            try {
                $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $con->query("SELECT * FROM futuretb WHERE Email='$email' ORDER BY ID DESC");
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $con = null;
            ?>
            <div class="right-part">
            <h1 align="center">Future Event Record</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Interval</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) : ?>
                            <tr>
                                <td><?php echo $row['Event']; ?></td>
                                <td><?php echo $row['dateentered']; ?></td>
                                <td id="interval_<?php echo $row['ID']; ?>"></td>
                                <td><a href="deletefutrec.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record')"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <script>
                                function updateInterval_<?php echo $row['ID']; ?>(eventDate) {
                                    var toDate = new Date(eventDate);
                                    var fromDate = new Date();
                                    var diffTime = toDate - fromDate;

                                    if (diffTime > 0) {
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

                                        var diffHours = parseInt(diffTime / (60 * 60 * 1000)) % 24;
                                        var diffMinutes = parseInt(diffTime / (60 * 1000)) % 60;
                                        var diffSeconds = parseInt(diffTime / 1000) % 60;

                                        document.getElementById('interval_<?php echo $row['ID']; ?>').innerHTML =
                                        years +' Years, ' +  months +' Months, ' + weeks + ' Weeks, ' +remainingdays +   ' Days' + '<br>' +
                                            'Time: ' + diffHours + 'h ' + diffMinutes + 'm ' + diffSeconds + 's';
                                    } else {
                                        document.getElementById('interval_<?php echo $row['ID']; ?>').innerText = 'Event reached!';
                                    }
                                }

                                updateInterval_<?php echo $row['ID']; ?>('<?php echo $row['Date']; ?>');

                                setInterval(function () {
                                    updateInterval_<?php echo $row['ID']; ?>('<?php echo $row['Date']; ?>');
                                }, 1000);

                            </script>

                        <?php endforeach; }?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </body>
    
    </html>
