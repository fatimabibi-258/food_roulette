<?php
// dbconnection.php is a PHP file used to connect to the MySQL database using mysqli
$connection = new mysqli("localhost", "root", "", "food_roulette");
// this checks if the connection was successful
if ($connection->connect_error) {
    die("Database connection failed:".$connection->connect_error);  
} 
?>