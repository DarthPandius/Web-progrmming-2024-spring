<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM credentials
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["pass_hash"])) {
            
            session_start();
            session_regenerate_id();
            $sql2 = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $user["email"]);
            $result2 = $mysqli->query($sql2);
            $userId = $result2->fetch_assoc();

            $_SESSION["user_id"] = $userId["id"];
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
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
    <title> Log In </title>
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
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login Credentials</em>
        
    <?php endif; ?>
    
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    
        <a href="reset-password.php">Forgot password?</a>
    </form>
    
    
</body>
</html>

