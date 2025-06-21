<?php
// update_challenge.php is a PHP file that increments the value stored in completed_challenges when the user clicks on "Challenge Completed!" button
include 'dbconnection.php';
session_start();
$user_id = $_POST['user_id'] ?? 1;
// this increments the value stored in completed_challenges
$update_query = "UPDATE users SET completed_challenges = completed_challenges + 1 WHERE id = $user_id";
$connection->query($update_query);
// this redirects user back to main page
header("Location: index.php");
exit;
?>