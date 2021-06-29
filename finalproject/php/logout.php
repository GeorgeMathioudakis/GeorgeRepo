<?php
/**
 * 
 * This php script is used to  show the logged out state of the user
 * 
 * George Mathioudakis, 001211882
 * December 12/2020
 */
session_start();
session_unset();
session_destroy();
?><!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <h1>You have been logged out.</h1>
    <a href="../index.html">Back to home page</a>
</body>

</html>