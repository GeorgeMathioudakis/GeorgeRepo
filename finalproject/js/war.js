/// George mathioudakis 
/// December 12,2020
/// This  is a javascript file used for  listening  button presses for the iuser to start the round of war for the user and then send inforamtion 
///to  php file to insert or update user info in highscore table and tell the user what happend.
$(document).ready(function () {
    let type;
    $("#game").hide();
    $("#help").hide();
    $("#gethelp").hide();
    $("#end").hide();
    $("#playagain").hide();
    let pRoundsWon = 0;
    let cRoundsWon = 0;
    let info;
    let pCard;
    let cCard;
    let pOutput = document.getElementById("pCard");
    let cOutput = document.getElementById("cCard");
    let outcome = document.getElementById("outcome");
    let getcard = document.getElementById("getcard")
    let round = document.getElementById("tround")
    let pRound = document.getElementById("pround")
    let cRound = document.getElementById("cround")
    let roundCount = 0;
    pRound.innerHTML = "Player Wins: " + pRoundsWon;
    cRound.innerHTML = "Computer Wins: " + cRoundsWon;
    round.innerHTML = "Rounds Played: " + roundCount;
    $("#pCard").hide();
    $("#cCard").hide();

    $("#intro").submit(function (event) {
        event.preventDefault();
        $("#intro").hide();
        $("#game").show();
        $("#gethelp").show();

    });

    $("#gethelp").submit(function (event) {
        event.preventDefault();
        $("#game").hide();
        $("#help").show();
        $("#gethelp").hide();
    });

    $("#help").submit(function (event) {
        event.preventDefault();
        $("#game").show();
        $("#help").hide();
        $("#gethelp").show();
    });

    $("#game").submit(function (event) {
        event.preventDefault();
        pRound.innerHTML = "Player Wins: " + pRoundsWon;
        cRound.innerHTML = "Computer Wins: " + cRoundsWon;
        round.innerHTML = "Rounds Played: " + roundCount;
        roundCount++
        $('a').hide();
        getcard.style.display = "none";
        $("#gethelp").hide();
        outcome.style.color = "black"
        outcome.style.float = "right";
        outcome.innerHTML = "You are drawing a card from the top of the deck";
        setTimeout(pGetCard, 1900);
        setTimeout(cGetCard, 2300);
    });

    let pGetCard = function () {
        $("#pCard").show();
        pCard = Math.floor((Math.random() * 13) + 1);

        if (pCard == 1) {
            pOutput.innerHTML = "A";
            pCard = 14;
        } else if (pCard === 11) {
            pOutput.innerHTML = "J";
        } else if (pCard === 12) {
            pOutput.innerHTML = "Q";
        } else if (pCard === 13) {
            pOutput.innerHTML = "K";
        } else {
            pOutput.innerHTML = pCard;
        }

    }
    let cGetCard = function () {

        outcome.innerHTML = "It is now the computers turn to draw from the top of the deck";
        setTimeout(function () {
            cCard = Math.floor((Math.random() * 13) + 1);

            $("#cCard").show();
            $("#outcome").hide();

            if (cCard === 1) {
                cOutput.innerHTML = "A";
                cCard = 14;
            } else if (cCard == 11) {
                cOutput.innerHTML = "J";
            } else if (cCard == 12) {
                cOutput.innerHTML = "Q";
            } else if (cCard == 13) {
                cOutput.innerHTML = "K";
            } else {
                cOutput.innerHTML = cCard;
            }


        }, 2500);

        setTimeout(function () {
            $("#pCard").hide();
            $("#cCard").hide();
            $("#outcome").show();

            if (pCard > cCard) {
                outcome.style.color = "green"
                outcome.innerHTML = "You won that round"
                pRoundsWon++
                pRound.innerHTML = "Player Wins: " + pRoundsWon;
            } else if (pCard === cCard) {
                outcome.style.color = "yellow"
                outcome.innerHTML = "No one won that round"
            } else {
                outcome.style.color = "red"
                outcome.innerHTML = "The computer won that round"
                cRoundsWon++
                cRound.innerHTML = "Computer Wins: " + cRoundsWon;
            }


            let endgameswitch = false
            if (pRoundsWon === 5) {
                $("#game").hide();
                $("#end").show();
                $("#gethelp").hide();
                endgameswitch = true;
                document.getElementById("summary").innerHTML = " Ya you won the game."
                info = "win"
            } else if (cRoundsWon === 5) {
                $("#game").hide();
                $("#end").show();
                $("#gethelp").hide();
                document.getElementById("summary").innerHTML = " Aww you lost the game."
                info = "loose"
                endgameswitch = true;
            } else {
                getcard.style.display = "";
                $("#gethelp").show();
                $('a').show();
                round.innerHTML = "Rounds Played " + roundCount;

            }

            if (endgameswitch === true) {
                let url = "warinfo.php?&outcome=" + info;
                fetch(url, {
                        credentials: "include"
                    })
                    .then(response => response.text())
                    .then(success)
            }


        }, 3800);
    }



    function success(data) {
        if (data === "11") {
            
            document.getElementById("tableoutcome").innerHTML = "Your Highscore has been updated";
        } else {
            document.getElementById("tableoutcome").innerHTML = "You have been added to the highscore table";
        }
        $("#playagain").show();
        $('a').show();

    }
    $("#playagain").submit(function (event) {
        event.preventDefault();
        $("#game").hide();
        $("#help").hide();
        $("#gethelp").hide();
        $("#end").hide();
        pRoundsWon = 0;
        cRoundsWon = 0;
        $("#pCard").hide();
        $("#cCard").hide();
        $("#intro").show();
        roundCount = 0
        pRound.innerHTML = "Player Wins: " + pRoundsWon;
        cRound.innerHTML = "Computer Wins: " + cRoundsWon;
        round.innerHTML = "Rounds Played " + roundCount;
        document.getElementById("tableoutcome").innerHTML = "";
        $("#playagain").hide()
        outcome.innerHTML = ""
        $("#getcard").show()
        document.getElementById("summary").innerHTML = ""


    });



});
