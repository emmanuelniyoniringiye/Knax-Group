<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit;
}

$message = '';

// Respond to journal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $journal_id = intval($_POST['journal_id']);
    $response = mysqli_real_escape_string($conn, $_POST['response']);
    if (mysqli_query($conn, "UPDATE journals SET response='$response' WHERE id=$journal_id")) {
        $message = "Response sent.";
    } else {
        $message = "Error sending response: " . mysqli_error($conn);
    }
}

// Fetch journal entries
$journals = mysqli_query($conn, "
    SELECT j.id, u.name, j.content, j.response
    FROM journals j
    JOIN students s ON j.student_id = s.id
    JOIN users u ON s.user_id = u.id
");

include '../includes/teacherHeader.php';
?>

<div class="container">
    <h2>Respond to Student Journals</h2>
    <?php if ($message != ''): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php while ($j = mysqli_fetch_assoc($journals)) { ?>
    <div class="journal-entry">
        <strong><?= htmlspecialchars($j['name']) ?>:</strong> <?= htmlspecialchars($j['content']) ?><br><br>
        <form method="POST" action="">
            <input type="hidden" name="journal_id" value="<?= $j['id'] ?>">
            <textarea name="response" placeholder="Write feedback..." required><?= htmlspecialchars($j['response']) ?></textarea><br>
            <input type="submit" value="Send Response">
        </form>
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
.message {
    padding: 10px;
    background-color: #d4edda;
    color: #155724;
    border-radius: 5px;
    margin-bottom: 15px;
}
.journal-entry {
    border: 1px solid #aaa;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
textarea {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    resize: vertical;
}
input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
