<?php
// register.php is a PHP file used to handle new user registration and adding user to database
include 'dbconnection.php';
session_start();
$error = "";
$success = "";
// this is for when the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    // this checks if the username already exists
    $check = $connection->query("SELECT id FROM users WHERE username = '$username'");
    if ($check->num_rows>0) {
        // this displays an error if the username is already taken
        $error = "Username already taken";
    } else {
        // this inserts a new user and its hashed password into the database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed')";
        if ($connection->query($query)){
            $success = "Account successfully created! you can now log in.";
        } else {
            // this displays an error if something went wrong during registration
            $error = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <!-- this is used for displaying error or success messages -->
        <?php if ($error): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color:green;"><?= $success ?></p>
        <?php endif; ?>
        <!-- this is the registration form -->
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <!-- this redirects the user to login if they already have an account -->
        <p>Already have an account? <a href="login.php">Log in here</a></p>
    </div>    
</body>
</html>