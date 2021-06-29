<?php
/**
 * 
 * This php script is used to  to be the main menu for a user when they log in by checking if they have the same password as the database one
 * 
 * George Mathioudakis, 001211882
 * December 12/2020
 */
session_start();

include "connect2.php";
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

if ($username !== null and $password !== null) {

    $command = "SELECT * FROM users WHERE username = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success = $stmt->execute($params);
    $userinfo = $stmt->fetch();
    
    if ($userinfo) {
        if ( password_verify($password,$userinfo["password"]) )
        {
            $_SESSION["username"] = $userinfo["username"];
        }
        else {
            session_unset();
            session_destroy();
        }
    }
}
?><!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        h1{
            margin-top: 10%;
            font-size: larger;
            text-decoration: underline;
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION["username"])) {
    ?>
        <h1>Welcome <?= $_SESSION["username"] ?>!</h1>
        <p>Where would you like to go?</p>
        
            <p><a href="war.php">War card game</a></p>
            <p><a href="highscore.php">highscore page</a></p>
            <p><a href="delete.php">Delete Account</a></p>
            <p><a href="logout.php">Logout</a></p>
        
    <?php
    } 
    else {
    ?>
        <h1>Login Error! Access denied.</h1>
        <a href="../index.html">Try again.</a>
    <?php
    }

    ?>
</body>

</html>