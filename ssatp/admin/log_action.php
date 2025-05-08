<?php
function log_action($conn, $action, $target = null) {
 $actor_id = $_SESSION['user_id'];
 $actor_role = $_SESSION['role'];
 $created_at = date("Y-m-d H:i:s");
 $sql = "INSERT INTO audit_logs (action, actor_id, actor_role, target, created_at)
 VALUES ('$action', $actor_id, '$actor_role', '$target', '$created_at')";
 mysqli_query($conn, $sql);
}
include '../logs/log_action.php';
log_action($conn, 'Added performance score', "Student ID $student_id");
