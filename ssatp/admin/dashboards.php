<?php
session_start();
include 'admin_header.php';
require_once '../config/db.php';
if ($_SESSION['role'] !== 'admin') {
 header("Location: ../auth/login.php");
 exit;
}
// Top 5 students by average score
$top_students = mysqli_query($conn, "
 SELECT u.name, AVG(p.score) as avg_score
 FROM performances p
 JOIN students s ON p.student_id = s.id
 JOIN users u ON s.user_id = u.id
 GROUP BY s.id
 ORDER BY avg_score DESC
 LIMIT 5
");
// Top 5 most active clubs
$top_clubs = mysqli_query($conn, "
 SELECT c.name, COUNT(*) as members
 FROM student_club_entries e
 JOIN clubs c ON e.club_id = c.id
 GROUP BY e.club_id
 ORDER BY members DESC
 LIMIT 5
");
?>
<h2>Admin Dashboard</h2>
<h3>Top Performing Students</h3>
<ul>
<?php while ($s = mysqli_fetch_assoc($top_students)) { ?>
 <li><?= $s['name'] ?> - Avg Score: <?= round($s['avg_score'], 2) ?></li>
<?php } ?>
</ul>
<h3>Most Active Clubs</h3>
<ul>
<?php while ($c = mysqli_fetch_assoc($top_clubs)) { ?>
    <li><?= $c['name'] ?> - Members: <?= $c['members'] ?></li>
<?php } ?>
</ul>
<?php include 'admin_footer.php'; ?>
