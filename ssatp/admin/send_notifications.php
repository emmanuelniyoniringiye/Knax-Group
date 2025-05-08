<?php
session_start();
include 'admin_header.php';
require_once '../config/db.php';
if ($_SESSION['role'] !== 'admin') {
 header("Location: ../auth/login.php");
 exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $target_role = $_POST['target_role'];
    $created_by = $_SESSION['user_id'];
    $sql = "INSERT INTO notifications (title, message, target_role, created_by)
    VALUES ('$title', '$message', '$target_role', $created_by)";
    if (mysqli_query($conn, $sql)) {
    echo "Notification sent.";
    } else {
    echo "Error: " . mysqli_error($conn);
    }
   }
   ?>
   <h2>Send Notification</h2>
   <form method="POST">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="message" placeholder="Message" required></textarea><br>
    <select name="target_role">
    <option value="student">Students</option>
    <option value="teacher">Teachers</option>
    <option value="all">All</option>
    </select><br>
    <input type="submit" value="Send">
   </form>
<?php include 'admin_footer.php'; ?>
   