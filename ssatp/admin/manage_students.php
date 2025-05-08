<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';
include 'admin_header.php';

$sql = "SELECT students.*, users.name, users.email
        FROM students
        JOIN users ON students.user_id = users.id";
$result = mysqli_query($conn, $sql);
?>

<h2>All Students</h2>
<a href="add_student.php" class="button-link">+ Add New Student</a>
<table class="admin-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Reg No</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['registration_no']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['birth_date']) ?></td>
            <td>
                <a href="edit_student.php?id=<?= $row['id'] ?>">Edit</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php include 'admin_footer.php'; ?>
