<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = intval($_POST['student_id']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $score = floatval($_POST['score']);
    $term = mysqli_real_escape_string($conn, $_POST['term']);

    $sql = "INSERT INTO performances (student_id, subject, score, term)
            VALUES ($student_id, '$subject', $score, '$term')";

    if (mysqli_query($conn, $sql)) {
        $message = "Performance recorded!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Fetch students
$students = mysqli_query($conn, "SELECT s.id, u.name FROM students s JOIN users u ON s.user_id = u.id");

include '../includes/teacherHeader.php';
?>

<div class="container">
    <h2>Add Student Performance</h2>
    <?php if ($message != ''): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Student:</label>
        <select name="student_id" required>
            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php } ?>
        </select><br><br>
        <input type="text" name="subject" placeholder="Subject" required><br>
        <input type="number" name="score" placeholder="Score" step="0.1" required><br>
        <input type="text" name="term" placeholder="Term (e.g. Term 1)" required><br>
        <input type="submit" value="Submit Performance">
    </form>
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
input[type="text"], input[type="number"], select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
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
