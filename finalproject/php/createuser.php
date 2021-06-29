<?php
/**
 * 
 * This php script is used to  receives 2 get parameter and insert them into a database to a create a user.
 * Thenecho back if it was succsessful 
 * 
 * George Mathioudakis, 
 * December 12/2020
 */

include "connect2.php";

$username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
$hash = password_hash($password, PASSWORD_DEFAULT);
$command = "INSERT INTO users( username, password) VALUES (?,?)";
$stmt = $dbh->prepare($command);
$params = [$username,$hash];
$success = $stmt->execute($params);


if ($success) {
    echo (1);
} else {
    echo (0);
}
