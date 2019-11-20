$(document).ready(function () {
    $("#sendNew").click(function (e) {
        let title = $("#title").val();
        if (title === "") {
            alert("請輸入留言!");
        } else {
            $.ajax({
                type: "POST",
                url: "/oriboard_class_dateRestruct/php/post.php",
                data: {
                    "action": "new",
                    "title": title
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response === true) {                        
                        alert("新增成功!");
                        window.location.href = "index.html";
                    }
                }
            });
        }
    });
});