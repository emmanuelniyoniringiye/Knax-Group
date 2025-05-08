<?php
session_start();
include 'admin_header.php';
require_once '../config/db.php';
$id = $_GET['id'];
$fetch = mysqli_query($conn, "SELECT students.*, users.name, users.email FROM students JOIN users ON students.user_id = users.id WHERE students.id=$id");
$data = mysqli_fetch_assoc($fetch);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $reg = $_POST['registration_no'];
 $gender = $_POST['gender'];
 $birth = $_POST['birth_date'];
 $updateUser = "UPDATE users SET name='$name', email='$email' WHERE id=" . $data['user_id'];
 $updateStudent = "UPDATE students SET registration_no='$reg', gender='$gender', birth_date='$birth' WHERE id=$id";
 if (mysqli_query($conn, $updateUser) && mysqli_query($conn, $updateStudent)) {
 header("Location: manage_students.php");
 exit;
 } else {
 echo "Update failed: " . mysqli_error($conn);
 }
}
?>
<h2>Edit Student</h2>
<form method="POST" action="">
 Name: <input type="text" name="name" value="<?= $data['name'] ?>"><br>
 Email: <input type="email" name="email" value="<?= $data['email'] ?>"><br>
 Reg No: <input type="text" name="registration_no" value="<?= $data['registration_no'] ?>"><br>
 Gender:
 <select name="gender">
 <option <?= $data['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
 <option <?= $data['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
 </select><br>
 Birth Date: <input type="date" name="birth_date" value="<?= $data['birth_date'] ?>"><br>
 <input type="submit" value="Update Student">
</form>
<?php include 'admin_footer.php'; ?>
