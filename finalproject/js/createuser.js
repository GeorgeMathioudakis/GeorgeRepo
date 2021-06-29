/// George mathioudakis 
/// December 12,2020
/// This  is a javascript file used for  listening  to input for the user to make sure they input correct information and do not make a username that alreay exist in the users table.
window.addEventListener("load", function () {
    let userNameSwitch = false;
    let passwordSwitch = false;
    let error1 = document.getElementById("error1");
    let error2 = document.getElementById("error2");
    let error3 = document.getElementById("error3");
    error1.style.display = "none";
    error2.style.display = "none";

    document.getElementById("usn").addEventListener("input", function () {



        let url = "php/usercheck.php?username=" + this.value;
        fetch(url, {
                credentials: "include"
            })
            .then(response => response.text())
            .then(function (data) {
                if (data === "1") {
                    document.getElementById("usn").style.backgroundColor = "red";
                    userNameSwitch = false;
                    error1.style.display = "";
                    error1.style.color = "red";
                    error1.innerHTML = "Error username already exists";

                } else if (document.getElementById("usn").value.trim() === "" || document.getElementById("usn").value.length < 3 || document.getElementById("usn").value.length > 12) {
                    userNameSwitch = false;
                    document.getElementById("usn").style.backgroundColor = "red";
                    error1.style.display = "";
                    error1.style.color = "red";
                    error1.innerHTML = "Error username is incorrect format";

                } else {
                    document.getElementById("usn").style.backgroundColor = "green";
                    document.getElementById("usn").style.color = "white";
                    error1.style.display = "none";
                    error1.innerHTML = "";
                    userNameSwitch = true;
                }
            })
    });

    document.getElementById("psw").addEventListener("input", function () {


        if (this.value.trim() === "" || this.value.length < 3 || this.value.length > 12) {
            passwordSwitch = false;
            this.style.backgroundColor = "red";
            error2.style.display = "";
            error2.innerHTML = "Error password is incorrect format";

        } else {
            this.style.backgroundColor = "green";
            this.style.color = "white";
            error2.style.color = "red";
            error2.style.display = "none";
            error2.innerHTML = "";
            passwordSwitch = true;

        }


    })


    document.forms.createuser.addEventListener("submit", function (e) {
        e.preventDefault();
        if (userNameSwitch === true && passwordSwitch === true) {
            console.log("submit event");
            let username = document.getElementById("usn").value;
            let password = document.getElementById("psw").value;
            let url = "php/createuser.php?username=" + username + "&password=" + password;
            fetch(url, {
                    credentials: "include"
                })
                .then(response => response.text())
                .then(success)
        } else {

            error3.style.color = "red";
            error3.innerHTML = "Error information entered is incorrect";
        }
    });

    function success(data) {
        if (data === "1") {
            document.getElementById("createuser").style.display = "none"
            document.getElementById("title").innerHTML = "Finished account creation"
            document.getElementById("loginlink").innerHTML = "<p><a href= 'index.html'>Back to login page</a></p>"
        }

    }

});
