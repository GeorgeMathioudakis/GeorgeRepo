/// George mathioudakis 
/// December 12,2020
/// This  is a javascript file used for  listening  to change between user wanting to delte there account and double checking that they do
$(document).ready(function () {
    $("#submit").hide();
    $("#warning").submit(function (event) {
        event.preventDefault();
        $(this).hide();
        $("#submit").show();
    });
});
