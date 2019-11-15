$(document).ready(function () {
    $("#sendNew").click(function (e) {
        let title = $("#title").val();
        $.ajax({
            type: "POST",
            url: "/oriboard_class_dateRestruct/php/post.php",
            data: {
                "action": "new",
                "title": title
            },
            success: function (response) {
                if (response === 'success') {
                    alert("新增成功!");
                    window.location.href = "index.html";
                }
            }
        });
    });
});