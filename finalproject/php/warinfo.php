<?php
/**
 * 
 * This php script is used to  check if the user alreay has a record in the highscore table and add them to it with the parameter or if they alreay are i nthe table to update it.
 * 
 * George Mathioudakis, 
 * December 12/2020
 */
session_start();
include "connect2.php";


$outcome = filter_input(INPUT_GET, "outcome", FILTER_SANITIZE_STRING);

    if (isset($_SESSION["username"])) {
        $username = "$_SESSION[username]";
        $won = false;
        if ($outcome == "win") {
            $won = true;
        }
        $command = "SELECT * FROM  highscore  WHERE username = ?";
        $stmt = $dbh->prepare($command);
        $params = [$username];
        $success = $stmt->execute($params);
        $row = $stmt->fetch();

        if ($success) {

            if ($row) {
                $gamesplayed = (int)$row["gamesplayed"] + 1;

                if ($won) {
                    $wins = (int)$row["wins"] + 1;
                    $losses = (int)$row["losses"];
                } else {
                    $wins = (int)$row["wins"];
                    $losses = (int)$row["losses"] + 1;
                }

                $command = "UPDATE highscore SET gamesplayed = ? ,wins= ? , losses= ? WHERE username = ?";
                $stmt = $dbh->prepare($command);
                $params = [$gamesplayed, $wins, $losses, $username];
                $success = $stmt->execute($params);
                if ($success) {
                    echo "11";
                } else {
                    echo "0";
                }
            } else {
                if ($won) {
                    echo "got in ";
                    $command = "INSERT INTO highscore(username, gamesplayed, wins,losses) VALUES (?,1,1,0)";
                    $stmt = $dbh->prepare($command);
                    $params = [$username];
                    $success1 = $stmt->execute($params);
                    var_dump($success1);
                    if ($success1) {
                        echo "10";
                    } else {
                        echo "0";
                    }
                } else {
                    $command = "INSERT INTO highscore(username, gamesplayed, wins,losses) VALUES (?,1,0,1)";
                    $stmt = $dbh->prepare($command);
                    $params = [$username];
                    $success = $stmt->execute($params);
                    if ($success) {
                        echo "1";
                    } else {
                        echo "0";
                    }
                }
            }
        } else {
            echo "0";
        }
    } else {
    }

