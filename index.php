<?php
// index.php is a PHP file for the main page which displays user info, lets the user choose difficulty level, displays a challenge and shows the result
include 'dbconnection.php';
session_start();
// this redirects the user to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
// this fetches user data from the database
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = $connection->query($user_query);
$user = $user_result->fetch_assoc();
// this calculates success rate in the form of percentage
if ($user['total_challenges'] > 0) {
    $success_rate = round(($user['completed_challenges'] / $user['total_challenges']) * 100);
} else {
    $success_rate = 0;
}
$challenge = null;
// this handles challenge generation on form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['difficulty'])) {
    $difficulty = $_POST['difficulty'];
    $challenge_query = "SELECT * FROM challenges WHERE difficulty_level = '$difficulty' ORDER BY RAND() LIMIT 1";
    $result = $connection->query($challenge_query);
    $challenge = $result->fetch_assoc();
    // this updates the total challenge count 
    $connection->query("UPDATE users SET total_challenges = total_challenges + 1 WHERE id = $user_id ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Roulette</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- this displays the website's name on the top -->
        <h1>Food Roulette</h1>
        <!-- this displays the username, no. of challenges completed and success rate -->
        <p><strong>User:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Number of Challenges Completed:</strong> <?= $user['completed_challenges']?> / <?= $user['total_challenges'] ?></p>
        <p><strong>Success Rate:</strong> <?= $success_rate ?>%</p>
        <!-- this form is for choosing difficulty level -->
        <form method="POST" action="">
            <label for="difficulty">Choose Difficulty Level:</label>
            <select name="difficulty" id="difficulty" required>
                <option value="">Select</option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select> 
            <button type="submit">Spin the Roulette!</button>  
        </form>
        <!-- this displays a challenge if selected -->
        <?php if ($challenge): ?>
             <div class="challenge">
                <h3>Spin Result:</h3>
                <p><?= htmlspecialchars($challenge['name']) ?></p>
                <form method="POST" action="update_challenge.php">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <button type="submit">Challenge Completed!</button>
                </form>
            </div>
        <?php endif; ?>
        <!-- this displays logout button at the bottom of the page -->
        <div class="logout-container">
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>