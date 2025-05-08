<?php
session_start();
include("../includes/header.php");

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    //header(refresh:2);
    header("Location: ../auth/register.php");
    exit();
}

// Include database configuration
require_once '../config/db.php';

// Fetch teacher-specific data (e.g., classes, announcements)
$teacher_id = $_SESSION['user_id'];
$query="SELECT * FROM classes";
//$query = "SELECT c.class_name FROM classes c JOIN teacher_classes tc ON c.id = tc.class_id WHERE tc.teacher_id = $teacher_id";
$result = mysqli_query($conn, $query);

$classes = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $classes[] = $row;
    }
}

include '../includes/teacherHeader.php';
?>

<div class="container teacher-info">
    <h1>Teacher Dashboard</h1>
    <h2>Your Classes</h2>
    <?php if (count($classes) > 0): ?>
    <ul>
        <?php foreach ($classes as $class): ?>
            <li><?php echo htmlspecialchars($class['class_name']); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>You are not assigned to any classes yet.</p>
    <?php endif; ?>
</div>

<footer>&copy;2025</footer>


<!--  -->
<style>
    footer{
        position:inherit;
        width: 100%;
        top: 0px;
    }
/* .container {
    max-width: 700px;
    margin: 20px auto;
    padding: 10px;
} */
/* .teacher-info h1, .teacher-info h2 {
    text-align: center;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    background-color: #f2f2f2;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
} */
</style>
