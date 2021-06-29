/// George mathioudakis 001211882
/// December 12,2020
/// This  is a javascript file used for  listening  to what type of highscore table they want and recieve a json encoded oen then display it to the user
$(document).ready(function () {
    let type;
    $("ol").hide();


    $("#options").submit(function (event) {
        event.preventDefault();
        console.log("submit event");
        let win = $("#wins")
        if (win.is(":checked")) {
            type = "wins"
            

        } else {
            type = "losses"
            
        }
        let url = "gethighscore.php?type=" +type
        fetch(url, {
                credentials: "include"
            })
            .then(response => response.json())
            .then(success)
    });

    function success(leaderboard) {
        console.log(leaderboard);
        $("ol").show();
        $("#table").show();
        if(type === "wins"){
            document.getElementById("table").innerHTML ="Wins Table"
        }else{
            document.getElementById("table").innerHTML ="<B>Losses Table<B>"
        }
        $("#options").hide();

        leaderboard.forEach(
            record =>
            document.getElementById("output").innerHTML +=
            "<li id='score'>Username: " + record.username + " Games Played: " + record.gamesplayed + " Wins: " + record.wins + " losses: " + record.losses + "</li> "

        );
    };

});