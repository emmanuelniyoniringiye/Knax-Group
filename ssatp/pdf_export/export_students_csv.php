<?php
require_once '../config/db.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=students.csv');
$output = fopen("php://output", "w");
fputcsv($output, ['Name', 'Email', 'Registration No']);
$query = mysqli_query($conn, "
 SELECT u.name, u.email, s.registration_no
 FROM students s JOIN users u ON s.user_id = u.id
");
while ($row = mysqli_fetch_assoc($query)) {
 fputcsv($output, $row);
}
fclose($output);
exit;
