<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
include 'admin_header.php';
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> (Admin)</h1>

<ul>
    <li><a href="manage_students.php">Manage Students</a></li>
    <li><a href="send_notifications.php">Send Notifications</a></li>
    <li><a href="analytics.php">View Analytics</a></li>
    <li><a href="audit_logs.php">Audit Logs</a></li>
</ul>

<?php include 'admin_footer.php'; ?>
