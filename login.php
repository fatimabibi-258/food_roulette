<?php
// login.php is a PHP file that handles user login and starts a session on success
include 'dbconnection.php';
session_start();
$error = "";
// this checks if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    // this looks up the user by username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $connection->query($query);
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // this verifies the hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php");
            exit;
        } else {
            // this displays an error if the password is incorrect
            $error = "Incorrect password";
        }
    } else {
        // this displays an error if the username doesn't exist
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <!-- this displays any login error that occurs -->
        <?php if ($error): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <!-- this is the login form -->
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <!-- this redirects the user to registration if they do not have an account yet -->
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>    
</body>
</html>