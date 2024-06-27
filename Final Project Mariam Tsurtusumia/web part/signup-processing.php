<?php
// Array ( [name] => anme [email] => [password] => [password_confirmation] => )
if(empty($_POST["name"])||empty($_POST["email"])||empty($_POST["password"])||empty($_POST["password_confirmation"])){
    die("Please Make Sure That all the fields are filled");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Pleas Make Sure Passwords Match");
}

$db = require __DIR__ . "/database.php";
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$addUser = "INSERT INTO users ( name, email)
        VALUES (?, ?)";

$fillCredentials = "INSERT INTO credentials (email, pass_hash)
        VALUES (?, ?)";
        
$stmtAdd = $db->stmt_init();

if ( ! $stmtAdd ->prepare($addUser)) {
    die("SQL error: wasnt edded user");
}
$stmtCred = $db->stmt_init();
if ( ! $stmtCred->prepare($fillCredentials)) {
    die("SQL error: wasnt edded credential");
}

$stmtAdd->bind_param("ss",
                  $_POST["name"],
                  $_POST["email"],
                  );
                  

$stmtCred->bind_param("ss",
                  $_POST["email"],
                  $password_hash,
                  );
;                 

try{
    if($stmtAdd->execute()){
        $stmtCred->execute();
        header("Location: Login.php");
        exit;
    }
}catch(mysqli_sql_exception $e){
    die("email already taken, go back");
}
$stmtCred->close();
