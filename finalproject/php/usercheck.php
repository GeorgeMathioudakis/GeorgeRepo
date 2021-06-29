<?php
/**
 * 
 * This php script is used to check if a user is in the database so they can not use the same username
 * 
 * George Mathioudakis, 
 * December 12/2020
 */
include "connect1.php";

$username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);

$command = "SELECT * FROM users WHERE username = ?";
$stmt = $dbh->prepare($command);
$params = [$username];
$success = $stmt->execute($params);
$check = $stmt->fetch();

if($check) {
    echo (1);
} else {
    echo (0);
}
