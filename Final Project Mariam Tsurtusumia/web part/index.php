<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Final Project">
    <meta name="keywords" content="HTML, CSS, php, Jquery">
    <meta name="author" content="Mariam Tsurtsumia">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title> My Gallery </title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Welcome To My Gallery</h1>
        <div class="nav">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="LogIn.php">Log In</a></li>
                <li><a href="signup.html">Register</a></li>
                <li><a href="about.html">Contact</a></li>
                <li><a href="file-upload.php">Image Upload</a></li>
                <li><a href="images.php">Gallery</a></li>
            </ul>
        </nav>
    </header>
    
    </div>
    <div>
        <main>
            <?php if (isset($user)) : ?>
                <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
                <p><a href="logout.php">Log out</a></p>
            <?php else : ?>
                <p>This is your persolam image repository but tu use it you must be authentificated </p>
                <?php echo "Would you like to log in?" ?>
                <p><a href="Login.php">Log in</a> or <a href="signup.html">sign up</a></p>

            <?php endif; ?>
        </main>
    </div>

</body>

</html>