<?php
/**
 * 
 * This php script is used to  ask the user what type of highscore table they want of top winners or looser
 * 
 * George Mathioudakis, 001211882
 * December 12/2020
 */

session_start();
$access = isset($_SESSION["username"]);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Highscores</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/gethighscore.js"></script>
    <style>
        h1{
            margin-top: 15%;
        }
        #score{
            border: 1px solid black;
            width: 25%;
            margin-left: 35%;
        }
        input{
            float: right;
        }
        label{
            border: 1px solid black;
        }
        #table{
            margin-top: 0%;
        }

    </style>
</head>

<body>
    <?php
    if ($access) {
        echo " <h1><B>HighScores</B></h1>";
        echo "<form id='options'>";
        echo "<label for='wins'>Wins leaderboad</label><br>";
        echo "<input type='radio' id ='wins' name='radioButton' value='wins' checked>";
        echo "<label for='losses'>Losses leaderboad</label><br>";
        echo "<input type='radio' id='losses' name='radioButton' value='losses'>";
        echo "<input type='submit' value='Get Results'>";
        echo "</form>";

        echo " <h1 id = 'table'></h1>";
        echo "<ol id='output'></ol>";
        echo "<p><a href='menu.php'>GO back to menu</a></p>";
    } else {
        echo "<h1>Not Logged in. Access denied.</h1>";
        echo "<p><a href='../index.html'>GO back to Login</a></p>";
    }
    ?>
</body>

</html>