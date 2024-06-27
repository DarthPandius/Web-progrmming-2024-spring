<?php

session_start();
$id = null;
if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    $id = $user["id"];
}
echo $id;

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->file($_FILES["image"]["tmp_name"]);

$mime_types = ["image/gpj", "image/png", "image/jpeg"];

if (!in_array($_FILES["image"]["type"], $mime_types)) {
    header("Location: file-upload.html");
    die("Invalid file type");
}

$fileName = $_FILES["image"]["name"];
echo $fileName;
$destDir = __DIR__ . "/uploads/" . $fileName;
$i = 1;

$pathinfo = pathinfo($_FILES["image"]["name"]);
$base = $pathinfo["filename"];

while (file_exists($destDir)) {

    $filename = $base . "($i)." . $pathinfo["extension"];
    $destDir = __DIR__ . "/uploads/" . $filename;

    $i++;
}
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $destDir)) {

    exit("Can't move uploaded file");
}


$db = require __DIR__ . "/database.php";

$addImg = "INSERT INTO uploads (path_to_file)
        VALUES (?)";

$addJunction = "INSERT INTO user_img (userId, fileId)
        VALUES (?, ?)";

$stmtAdd = $db->stmt_init();

if (!$stmtAdd->prepare($addImg)) {
    die("SQL error: cannot add image");
}
$stmtAdd->bind_param(
    "s",
    $destDir,
);

try {
    if ($stmtAdd->execute()) {
        $imgId = $db->insert_id;
        echo "uploaded file id : ";
        echo $imgId;

        $stmtAddJuntion = $db->stmt_init();

        if (!$stmtAddJuntion->prepare($addJunction)) {
            die("SQL error: cannot add image");
        }
        $stmtAddJuntion->bind_param(
            "ss",
            $id,
            $imgId,
        );
        $stmtAddJuntion->execute();
        echo "File uploaded successfully.";
        
        header("Location: images.php");
                    exit;
    }
} catch (mysqli_sql_exception $e) {
    die("faied to upload, go back");
}
