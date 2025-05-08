<?php
session_start();
include 'admin_header.php';
require_once '../config/db.php';
if ($_SESSION['role'] !== 'admin') {
 header("Location: ../auth/login.php");
 exit;
}
$result = mysqli_query($conn, "SELECT * FROM audit_logs ORDER BY created_at DESC");
?>
<h2>Audit Logs</h2>
<table border="1">
 <tr><th>Action</th><th>Actor</th><th>Target</th><th>Date</th></tr>
 <?php while ($row = mysqli_fetch_assoc($result)) { ?>
 <tr>
 <td><?= $row['action'] ?></td>
 <td><?= $row['actor_role'] ?> (ID: <?= $row['actor_id'] ?>)</td>
 <td><?= $row['target'] ?></td>
 <td><?= $row['created_at'] ?></td>
 </tr>
 <?php } ?>
</table>
<?php include 'admin_footer.php'; ?>

