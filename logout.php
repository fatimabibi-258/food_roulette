<?php
// logout.php is a PHP file that ends the session and redirects the user to login page
session_start();
// this clears all session data
session_destroy();
// this redirects the user to login page
header("Location: login.php");
exit;
?>