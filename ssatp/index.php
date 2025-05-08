<?php
session_start();

// Include the database configuration file
include 'config/db.php';

// Include header
include 'includes/header.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to user dashboard based on role
    $user_role = $_SESSION['user_role'];
    if ($user_role == 'student') {
        header('Location: student/dashboard.php');
    } elseif ($user_role == 'teacher') {
        header('Location: teacher/dashboard.php');
    } elseif ($user_role == 'admin') {
        header('Location: admin/dashboard.php');
    }
    exit();
}

// Include login form
include 'auth/login.php';

// Include footer
include 'includes/footer.php';
?>