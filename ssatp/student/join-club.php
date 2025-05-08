<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$message = '';

// Join club on POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['club_id'])) {
    $club_id = intval($_POST['club_id']);
    $joined_at = date("Y-m-d H:i:s");

    $check = mysqli_query($conn, "SELECT * FROM student_club_entries WHERE student_id=$student_id AND club_id=$club_id");
    if (mysqli_num_rows($check) == 0) {
        if (mysqli_query($conn, "INSERT INTO student_club_entries (student_id, club_id, joined_at) VALUES ($student_id, $club_id, '$joined_at')")) {
            $message = "Successfully joined the club!";
        } else {
            $message = "Error joining the club: " . mysqli_error($conn);
        }
    } else {
        $message = "You are already in this club.";
    }
}

// Fetch clubs
$clubs = mysqli_query($conn, "SELECT * FROM clubs");

include '../includes/studentHeader.php';
?>

<div class="container">
    <h2>Available Clubs</h2>
    <?php if ($message != ''): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <table class="clubs-table">
        <thead>
            <tr>
                <th>Club Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($club = mysqli_fetch_assoc($clubs)) { ?>
            <tr>
                <td><?= htmlspecialchars($club['name']) ?></td>
                <td><?= htmlspecialchars($club['description']) ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="text" name="club_id" value="<?= $club['id'] ?>">
                        <button type="submit">Join</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
<style>
.container {
    max-width: 800px;
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
.clubs-table {
    width: 100%;
    border-collapse: collapse;
}
.clubs-table th, .clubs-table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}
.clubs-table th {
    background-color: #f2f2f2;
}
.clubs-table button {
    padding: 5px 10px;
    background-color: #4CAF50;
    border: none;
    color: white;
    border-radius: 3px;
    cursor: pointer;
}
.clubs-table button:hover {
    background-color: #45a049;
}
</style>

