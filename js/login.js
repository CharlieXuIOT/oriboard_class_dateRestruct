$(document).ready(function () {
    $("#Login").click(function (e) {
        $account = $("#account").val();
        $password = $("#password").val();
        $.ajax({
            type: "POST",
            // url: "php/login.php",
            url: "/oriboard_class_dateRestruct/php/member.php",
            data: {
                "action": "login",
                "account": $account,
                "password": $password
            },
            success: function (response) {
                if (response === "success") {
                    alert("登入成功!");
                    window.location.href = "index.html";
                } else if (response === "fail") {
                    alert("請確認帳號或是密碼!");
                }
            }
        });
    });
});