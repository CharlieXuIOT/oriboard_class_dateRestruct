$(document).ready(function () {
    // 帳號密碼的正則flag
    let accFlag = 0;
    let pwFlag = 0;
    // 密碼確認是否相符
    let pw2Flag = 0;

    $("#account").focusout(function (e) {
        var regex = /^[A-Za-z0-9]{3,}$/;

        if (!regex.test($("#account").val())) {
            $("#accEr").text("帳號格式不符");
            accFlag = 0;
        } else {
            $("#accEr").text("");
            accFlag = 1;
        }
    });

    $("#password").focusout(function (e) {
        var regex = /^[A-Za-z0-9]{3,}$/;

        if (!regex.test($("#password").val())) {
            $("#pwEr").text("密碼格式不符");
            pwFlag = 0;
        } else {
            $("#pwEr").text("");
            pwFlag = 1;
        }
    });

    $("#password2").focusout(function (e) {
        if ($("#password").val() != $("#password2").val()) {
            $("#pw2Er").text("與密碼不符");
            pw2Flag = 0;
        } else {
            $("#pw2Er").text("");
            pw2Flag = 1;
        }

    });

    $("#Register").click(function (e) {
        if ((accFlag === 1) && (pwFlag === 1) && (pw2Flag === 1)) {
            $account = $("#account").val();
            $password = $("#password").val();
            $.ajax({
                type: "POST",
                // url: "php/register.php",
                url: "/oriboard_class_dateRestruct/php/member.php",
                data: {
                    "action": "register",
                    "account": $account,
                    "password": $password
                },
                success: function (response) {
                    if (response === "success") {
                        alert("註冊成功!");
                        window.location.href = "login.html";
                    } else if (response === "repeat") {
                        alert("帳號重複!");
                    }
                }
            });
        } else {
            alert("請檢查帳號密碼錯誤訊息!");
        }
    });
});