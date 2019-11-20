$(document).ready(function () {
    let url = new URL(window.location.href);
    let id = url.searchParams.get('id');
    $.ajax({
        type: "POST",
        url: "/oriboard_class_dateRestruct/php/post.php",
        data: {
            "action": "showModify",
            "id": id
        },
        success: function (response) {
            response = JSON.parse(response);
            let title = response["title"];
            $("#title").val(title);
        }
    });

    $("#sendModify").click(function (e) {
        let title = $("#title").val();
        if (title === "") {
            alert("請輸入留言!");
        } else {
            $.ajax({
                type: "POST",
                url: "/oriboard_class_dateRestruct/php/post.php",
                data: {
                    "action": "modify",
                    "id": id,
                    "title": title
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response === true) {
                        alert("修改成功");
                        window.location.href = "index.html";
                    }
                }
            });
        }
    });
});