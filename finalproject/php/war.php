<?php
/**
 * 
 * This php script is used to  play the different segment of the war card game 
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
    <title>War Card Game</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/war.js"></script>
    <style>
        #pCard {
            width: 50px;
            height: 75px;
            border: 1px solid black;
            margin-left: 45px;
            background-color: white;

        }

        #cCard {
            width: 50px;
            height: 75px;
            border: 1px solid black;
            float: right;
            margin-right: 45px;
            background-color: white;
        }

        #cardMat {
            width: 20%;
            margin-right: 40%;
            height: 125px;
            border: 1px solid black;
            float: right;
            background-color: green;
        }

        h1 {
            margin-top: 10%;
        }
    </style>
</head>

<body>
    <?php
    if ($access) {
    ?>
        <h1><B>War Card Game</B></h1>
        <form id='intro'>
            <p>This game is played like the card game war.
                You player will click the start round button to beging a round. You will select a card from the top of the deck and place it on the card mat.
                Then it will be the computer turn the computer will get a card from the top of the deck and place it on the card mat. Who ever has a high value card at the end wins the round(Ace is high card; 2 is low card).
                The first to 5 rounds won wins the game. You can press the help button to read these intrustion anytime.Click Start Game to start playing.
            </p>
            <input type='submit' value='Start Game'>
        </form>

        <form id='game'>
            <div id="cardMat">
                <p id=cCard></p>
                <p id=pCard></p>

            </div>
            <p id=tround></p>
            <p id=pround></p>
            <p id=cround></p>
            <p id=outcome></p>
            <input type='submit' id="getcard" value='Start Round'>
        </form>

        <form id='gethelp'>

            <input type='submit' id="gethelp" value="Help">

        </form>

        <form id='help'>
            <p>This game is played like the card game war.
                You player will click the start round button to beging a round. You will select a card from the top of the deck and place it on the card mat.
                Then it will be the computer turn the computer will get a card from the top of the deck and place it on the card mat. Who ever has a high value card at the end wins the round(Ace is high card; 2 is low card).
                The first to 5 rounds won wins the game. You can press the help button to read these intrustion anytime.Click Start Game to continue playing.
                <input type='submit' value='Go back to Game'>
        </form>


        <p id="summary"></p>
        <p id="tableoutcome"></p>

        <form id="playagain">
            <input type='submit' value='Play Again'>
        </form>


        <p  ><a href='menu.php'>GO back to menu</a></p>


    <?php
    } else {
        echo "<h1>Not Logged in. Access denied.</h1>";
        echo "<p><a href='../index.html'>GO back to Login</a></p>";
    }
    ?>
</body>

</html>