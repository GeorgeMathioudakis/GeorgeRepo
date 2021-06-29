<?php
/**
 * 
 * This php script is used to  double check with the user if the ywant to delete there account then send them to delete account php script
 * 
 * George Mathioudakis, 
 * December 12/2020
 */
session_start();
$access = isset($_SESSION["username"]);

?><!DOCTYPE html>
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
    ?>
        <h1><B>Warning!</B></h1>
        <form id="warning">
            <p>This will delete your account completly. You will not be able to recover this account<br>
                Press delete account to remove your account and highscore related to it.</p>
            <input type='submit' value='Delete Account'>
        </form>

        <form id="submit" action='deleteaccount.php'>
            <p>Are you sure you want to Delete you account?.</p>
            <input type='submit' value='Delete Account'>
        </form>

        <p><a href='menu.php'>GO back to menu</a></p>


    <?php
    } else {
        echo "<h1>Not Logged in. Access denied.</h1>";
        echo "<p><a href='../index.html'>GO back to Login</a></p>";
    }
    ?>
</body>

</html>
