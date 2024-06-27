<?php
session_start();
$id = null;
$imagePaths = [];
if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    $id = $user["id"];
}
if ($id !== null) {
    $result = $mysqli->query("SELECT u.path_to_file FROM uploads u
            JOIN user_img ui ON u.fileId = ui.fileId
            WHERE ui.userId = $id");

    if (!$result) {
        die("SQL error: " . $mysqli->error);
    }

    while ($row = $result->fetch_assoc()) {
        $imagePaths[] = $row['path_to_file'];
    }

    $mysqli->close();
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
    <link rel="stylesheet" href="styles.css">
    <title>Pictures</title>

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
    <?php if (isset($user)) : ?>
        <h1>My Images</h1>
        <div class="image-gallery">
            <ul>
                <?php foreach ($imagePaths as $path) : ?>
                    <?php $relativePath = str_replace('C:\wamp64\www\web-programming\Final Project/', './', $path); ?>
                    <li><a href="<?php echo htmlspecialchars($relativePath); ?>" target="_blank">"<?php echo htmlspecialchars($relativePath); ?>" </a><br></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php else : ?>
        <h4>File Viewing Is Only available for authorised users, please sign in</h4>
        <p><a href="Login.php">Log in</a> or <a href="signup.html">sign up</a></p>
    <?php endif; ?>


</body>