<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$role = $_SESSION['role'];
$where = "WHERE target_role='$role' OR target_role='all'";
$result = mysqli_query($conn, "SELECT * FROM notifications $where ORDER BY created_by DESC");

include '../includes/StudentHeader.php';
?>

<div class="container">
    <h2>Notifications</h2>
    <?php while ($n = mysqli_fetch_assoc($result)) { ?>
    <div class="notification-entry">
        <strong><?= htmlspecialchars($n['title']) ?></strong><br>
        <?= nl2br(htmlspecialchars($n['message'])) ?><br>
        <small><?= $n['created_by'] ?></small>
    </div>
    <?php } ?>
</div>

<?php include '../includes/footer.php'; ?>
<style>
.container {
    max-width: 700px;
    margin: 20px auto;
    padding: 10px;
}
.notification-entry {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #f0f0f0;
}
</style>
