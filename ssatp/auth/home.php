<?php
require_once '../config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

    <header>
        
        <nav>
            <ul>
                <?php
             echo   "<li><a href='../includes/header.php'>Home</a></li>";
              echo    "<li><a href='../auth/login.php'>Login</a></li>";
             echo  "<li><a href='../auth/register.php'>Register</a></li>";
             echo "<li><a href='../student/dashboard.php'>Student Dashboard</a></li>";
             echo    "<li><a href='../teacher/dashboard.php'>Teacher Dashboard</a></li>";
             echo    "<li><a href='../admin/dashboard.php'>Admin Dashboard</a></li>";
                ?>
            </ul>
        </nav>
  
    </header>
    <h1>Welcome to our Smart Student Activity & Performance Tracker</h1>
    <div class="header-content-row">
        <div class="header-image">
            <img src="../images/tt.jpg" alt="">
        </div>
        <div class="header-description">
            <p>This is the image for better look</p>
            <p>So , it should be very imaginative one</p>
            <p>To all wants to feel better with.</p>
        </div>
    </div>
    <div class="box">
<!-- <ul>
    <li><a href="#">home</a></li>
    <li><a href="#">home</a></li>
    <li><a href="#">home</a></li>

</ul> -->
    </div>
    <footer>
    <p>&copy; <?php echo date("Y");  echo "All rights reserved"; ?> Your happiness is Our priority. </p>
    <p>Contact us: <a href="mailto:eliabniyomugabo4@gmail.com.com">&copy;eliabniyomugabo14@gmail.com</a></p>
    </footer>
</body>
</html>

