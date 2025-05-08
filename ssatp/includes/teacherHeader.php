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
             echo   "<li><a href='footer.php'>Home</a></li>";
              echo    "<li><a href='../auth/login.php'>Login</a></li>";
             echo  "<li><a href='../auth/register.php'>Register</a></li>";
             echo "<li><a href='../student/dashboard.php'>Student Dashboard</a></li>";
             echo    "<li><a href='../teacher/dashboard.php'>Teacher Dashboard</a></li>";
             echo    "<li><a href='../admin/dashboard.php'>Admin Dashboard</a></li>";
                ?>
            </ul>
        </nav>
  
    </header>
    
</body>
</html>

