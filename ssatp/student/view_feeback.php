<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$journals = mysqli_query($conn, "SELECT content, response, created_at FROM journals WHERE student_id=$student_id");

include '../includes/studentHeader.php';
?>

<div class="container">
    <h2>Your Journal Feedback</h2>
    <?php while ($j = mysqli_fetch_assoc($journals)) { ?>
    <div class="journal-entry">
        <strong>Your Entry:</strong><br>
        <?= htmlspecialchars($j['content']) ?><br><br>
        <strong>Teacher's Response:</strong><br>
        <?= $j['response'] ? htmlspecialchars($j['response']) : "<em>No response yet</em>" ?><br>
        <small><?= $j['created_at'] ?></small>
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
.journal-entry {
    border: 1px solid #aaa;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
</style>
