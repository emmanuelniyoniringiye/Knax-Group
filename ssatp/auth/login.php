<?php
session_start();
require_once '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    // Prepare statement
    $stmt = mysqli_prepare($conn, "SELECT id, name, password, role FROM users WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password, $role);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($id && password_verify($password, $hashed_password)) {
        // Set session variables
        $_SESSION['user_id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;

        // Redirect based on role
        switch ($role) {
            case 'admin':
                header("Location: ../admin/dashboard.php");
                break;
            case 'teacher':
                header("Location: ../teacher/dashboard.php");
                break;
            case 'student':
                header("Location: ../student/dashboard.php");
                break;
            default:
                header("Location: ../login.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
include "../includes/studentHeader.php";
?>

<style>
    body {
        background-color:#ccc;
        font-family: Arial, sans-serif;
    }
    h2 {
        text-align: center;
        color: white;
        margin-top: 20px;
    }
    form {
        text-align: center;
        margin-top: 20px;
    }
    input {
        width: 15rem;
        height: 2rem;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }
    button {
        width: 80%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        font-size: 1rem;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    .form {
        background-color: gray;
        max-width: 300px;
        height: auto;
        padding: 30px 20px;
        margin: 40px auto;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 0 10px #333;
    }
    .error {
        color: #ff4d4d;
        text-align: center;
        margin-bottom: 15px;
    }
</style>

<div class="form">
    <!-- Login Form -->
    <h2>Login</h2>
    <?php if ($error != ''): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" required placeholder="Enter your email.."><br>
        <input type="password" name="password" required placeholder="Enter your password.."><br>
        <button type="submit">Login</button>
    </form>
</div>
<footer>&copy;2025</footer>

<style>
footer{
    position:inherit;
    top: 0px;
    
}
</style>