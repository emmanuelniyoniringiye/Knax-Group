<?php
session_start();
include '../includes/teacherHeader.php';
require_once '../config/db.php';
$role = $_SESSION['role'];
$where = "WHERE target_role='$role' OR target_role='all'";
$result = mysqli_query($conn, "SELECT * FROM notifications $where ORDER BY created_by DESC");
?>
<h2>Notifications</h2>
<?php while ($n = mysqli_fetch_assoc($result)) { ?>
 <div style="border:1px solid #ccc;padding:10px;margin-bottom:10px;">
 <strong><?= htmlspecialchars($n['title']) ?></strong><br>
 <?= nl2br(htmlspecialchars($n['message'])) ?><br>
 <small><?= $n['created_at'] ?></small>
 </div>
<?php } ?>
<?php include '../includes/footer.php'; ?>
