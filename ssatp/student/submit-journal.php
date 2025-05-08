<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $created_at = date("Y-m-d H:i:s");
    $insert = "INSERT INTO journals (student_id, content, created_at) VALUES ($student_id, '$content', '$created_at')";
    if (mysqli_query($conn, $insert)) {
        $message = "Journal entry submitted successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

include '../includes/studentHeader.php';
?>

<div class="container">
    <h2>Submit Journal Entry</h2>
    <?php if ($message != ''): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <textarea name="content" rows="6" cols="50" placeholder="Write your journal..." required></textarea><br>
        <input type="submit" value="Submit">
    </form>
</div>

<?php include '../includes/footer.php'; ?>
<style>
.container {
    max-width: 600px;
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
