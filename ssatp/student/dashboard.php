<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/register.php");
    exit();
}

// Include database connection
require_once '../config/db.php';

// Fetch student information from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM students WHERE id = $user_id";
$result= mysqli_query($conn,$query);

$user = '';
if ($result && mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
    $user = htmlspecialchars($student['name']);
}

include '../includes/studentHeader.php';
?>

<div class="container">
    <h1>Welcome, <?php echo $user; ?></h1>
    <nav class="student-nav">
        <ul>
            <li><a href="../student/submit-journal.php">Journal</a></li>
            <li><a href="../student/join-club.php">Clubs</a></li>
            <li><a href="../student/view_feeback.php">Feedback</a></li>
            <li><a href="../student/view_notifications.php">Notifications</a></li>
        </ul>
    </nav>

    <section class="student-info">
        <h2>Your Information</h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
        <p><strong>Enrollment Date:</strong> <?php echo htmlspecialchars($student['enrollment_date']); ?></p>
    </section>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
