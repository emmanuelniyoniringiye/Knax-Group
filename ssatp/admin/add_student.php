<?php
session_start();
include 'admin_header.php';
require_once '../config/db.php'
;
if ($_SERVER
['REQUEST_METHOD'] === 'POST') {
 $name = mysqli_real_escape_string($conn, $_POST ['name']);
 $email = strtolower(trim($_POST['email']));
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 $reg = mysqli_real_escape_string($conn, $_POST['registration_no']);
 $gender = $_POST['gender'];
 $birth = $_POST['birth_date'];
 // 1. Insert into users
 $insertUser = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'student')";
 if (mysqli_query($conn, $insertUser)) {
 $user_id = mysqli_insert_id($conn);
 // 2. Insert into students
 $insertStudent = "INSERT INTO students (user_id, registration_no, gender, birth_date)
 VALUES ($user_id, '$reg', '$gender', '$birth')";
 if (mysqli_query($conn, $insertStudent)) {
 header("Location: manage_students.php");
 exit;
 } else {
 echo "Student insert error: " . mysqli_error($conn);
 }
 } else {
 echo "User insert error: " . mysqli_error($conn);
 }
}
?>
<h2>Add New Student</h2>
<form method="POST" action="" style="text-align:center;line-height:2;">
 Name: <input type="text" name="name" required><br>
 Email: <input type="email" name="email" required><br>
 Password: <input type="password" name="password" required><br>
 Reg No: <input type="text" name="registration_no" required><br>
 Gender:
 <select name="gender" required>
 <option>Male</option>
 <option>Female</option>
 </select><br>
 Birth Date: <input type="date" name="birth_date" required><br>
 <input type="submit" value="Add Student">
</form>
<?php include 'admin_footer.php'; ?>

