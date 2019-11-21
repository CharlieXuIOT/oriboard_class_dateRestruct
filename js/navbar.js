$(document).ready(function () {
    $.ajax({
        type: "POST",
        // url: "php/navbar.php",
        url: "/oriboard_class_dateRestruct/php/member.php",
        data: {
            "action": "navbar"
        },
        success: function (response) {
            response = JSON.parse(response);
            // if (response != "guest") {
            if (response["account"] != "") {
                // $("#navAccount").text("Hi, " + response);
                $("#navAccount").text("Hi, " + response["account"]);
                $("#navAccount").removeClass('hidden');
                $("#navUpload").removeClass('hidden');
                $("#navNew").removeClass('hidden');
                $("#navLogout").removeClass('hidden');
                if (response["permission"] == 2){
                    $("#navAdmin").removeClass('hidden');
                }
            } else {
                $("#navRegister").removeClass('hidden');
                $("#navLogin").removeClass('hidden');
            }
        }
    });

    $("#navLogout").click(function (e) {
        var r = confirm("確定登出?")
        if (r === true) {
            $.ajax({
                type: "POST",
                url: "/oriboard_class_dateRestruct/php/member.php",
                data: {
                    "action": "logout"
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response === true) {
                        window.location.href = "index.html";
                    }
                }
            });
        } else {
            return false;
        }
    })
})