<?php
session_start();
require_once '../config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $role = $_POST['role']; // Must be 'admin', 'teacher', or 'student'

    // Validate role
    $valid_roles = array('admin', 'teacher', 'student');
    if (!in_array($role, $valid_roles)) {
        $message = "Invalid role selected.";
    } else {
        // Check if email already exists
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $message = "Email already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user using prepared statement
            $insert_stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_stmt, "ssss", $name, $email, $hashed_password, $role);

            if (mysqli_stmt_execute($insert_stmt)) {
                $message = "Registration successful. <a href='login.php'>Login now</a>";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($insert_stmt);
        }
        mysqli_stmt_close($stmt);
    }
}
include "../includes/registerHeader.php";
?>
<div class="form">
    <!-- Simple HTML Form -->
    <h2>Register</h2>
    <?php if ($message != ''): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" >
        <input type="text" name="name" required placeholder="Enter your name.."><br><br>
        <input type="email" name="email" required placeholder="Enter your email.."><br><br>
        <input type="password" name="password" required placeholder="Enter your password.."><br><br>
        <strong>Role:</strong>
        <select name="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <input type="submit" value="Register">
    </form>
</div>
<!-- <div class="footer"> -->
    <footer>&copy;2025</footer>
<!-- </div> -->
<style>
    /* body {
        background-color: black;
    } */
    h2 {
        text-align: center;
        color: #151541;;
    }
    .message {
        text-align: center;
        color: #ff4d4d;
        margin-bottom: 15px;
    }
    strong {
        font-size: 23px;
        color:#151541;
    }
    select {
        width: 160px;
        height: 30px;
        margin-right: 11px;
    }
    form {
        text-align: center;
    }
    input {
        text-align: center;
        width: 13rem;
        height: 2rem;
        color: rgb(97, 98, 180);
    }
    /* .form {
        background-color: #fff;
        max-width: 274px;
        
        height: 330px;
        border-radius: 10px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    } */
   
   footer{
    position:fixed;
    bottom: 0;
    
   }
</style>
