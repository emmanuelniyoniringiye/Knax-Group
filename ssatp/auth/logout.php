<?php
// Start the session and destroy all session data to log out the user
session_start();
session_unset();
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit;
?>
