
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar {
            background-color: #1c87c9;
        }

        .navbar-brand {
            color: #fff;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .nav-link {
            font-size: 20px;
            font-weight: bold;
        }

        .header-name {
            font-weight: bold;
            color: #fff;
        }

        .profile-icon {
            font-size: 34px;
            margin-right: 10px;
        }
        /* .dropdown-menu{
          position: relative;
          width:10px;
          background:blue;
        } */
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <h1 class="header-name">Web Diary </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarRightAlignExample"
                aria-controls="navbarRightAlignExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarRightAlignExample">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="dayinterval.php">Day Interval</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="past.php">Past Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="future.php">Future Event</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" id="profileDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle profile-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <!-- <a class="dropdown-item" href="#">Settings</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"
                       onclick="return confirm('Are you sure you want to log out')">Logout</a>
                    </div>
                </li>
            </ul>   
        </div>
    </div>
</nav>
</body>
</html>
