<?php
session_start();
include("../config/db.php");

function log_action($conn, $action, $target = null) {
 $actor_id = $_SESSION['user_id'];
 $actor_role = $_SESSION['role'];
 $created_at = date("Y-m-d H:i:s");
 $sql = "INSERT INTO audit_logs (action, actor_id, actor_role, target, created_at)
 VALUES ('$action', $actor_id, '$actor_role', '$target', '$created_at')";
 $result= mysqli_query($conn, $sql);
 if($result){
    
 }
}
//include '../logs/log_action.php';
$student_id = $_SESSION['user_id'];

log_action($conn, 'Added performance score', "Student ID $student_id");
