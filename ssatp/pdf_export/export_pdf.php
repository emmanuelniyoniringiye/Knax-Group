<?php
require_once '../config/db.php';
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=students.doc");
$query = mysqli_query($conn, "
 SELECT u.name, u.email, s.registration_no
 FROM students s JOIN users u ON s.user_id = u.id
");
echo "<h2>Student Records</h2><table border='1'><tr><th>Name</th><th>Email</th><th>Reg No</th></tr>";
while ($row = mysqli_fetch_assoc($query)) {
 echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['registration_no']}</td></tr>";
}
echo "</table>";
