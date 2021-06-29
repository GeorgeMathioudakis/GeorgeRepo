<?php
/**
 * 
 * This php script is used to  delete the current users account with there username 
 * 
 * George Mathioudakis, 001211882
 * December 12/2020
 */
session_start();
include "connect2.php";

$username = "$_SESSION[username]";

if (isset($_SESSION["username"])) {

    $command = "DELETE FROM users WHERE username = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success1 = $stmt->execute($params);

    $command = "DELETE FROM highscore WHERE username = ?";
    $stmt = $dbh->prepare($command);
    $params = [$username];
    $success2 = $stmt->execute($params);
}


$access = isset($_SESSION["username"]);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/delete.js"></script>

</head>

<body>
    <?php
    if ($access) {
        if ($success1 && $success2) {
            session_destroy();
    ?>
    

            <p>You account has been deleted</p>
            <p><a href='../index.html'>GO back to Home page</a></p>


    <?php
        }
    } else {
        echo "<h1>Not Logged in. Access denied.</h1>";
        echo "<p><a href='../index.html'>GO back to Login</a></p>";
    }
    ?>
</body>

</html>