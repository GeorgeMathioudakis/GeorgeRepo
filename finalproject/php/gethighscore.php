<?php
/**
 * 
 * This php script is used to   get a parameter called type to know how to order the  select stament.
 * That then is echod json encode to be displayed to highscore php script
 * 
 * George Mathioudakis, 
 * December 12/2020
 */
include "connect2.php";
session_start();
$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);


    if (isset($_SESSION["username"])) {

        $command = "SELECT *  FROM highscore ORDER BY $type DESC";
        $stmt = $dbh->prepare($command);
        $success = $stmt->execute();

        $output = [];
        while ($row = $stmt->fetch()) {
            $highscores = [
                "username" => $row["username"],
                "gamesplayed" => (int)$row["gamesplayed"],
                "wins" => (int)$row["wins"],
                "losses" => (int)$row["losses"]
            ];
            $output[] = $highscores;
        }
        echo json_encode($output);
    }

