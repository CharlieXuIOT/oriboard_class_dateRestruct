$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "/oriboard_class_dateRestruct/php/member.php",
        data: {
            "action": "showUpload"
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response != ""){
                $("#img").attr('src', response);
                // $("#img").text(response);
            } else {
                $("#img").attr('src', "../uploads/No-Image-Basic.png");                
            }
        }
    });

    $('#upload').click(function () { 
        let file_data = $('#blockimg').prop('files')[0];   //取得上傳檔案屬性
        let form_data = new FormData();  //建構new FormData()
        form_data.append('file', file_data);  //吧物件加到file後面
        form_data.append('action', "upload");  //另外要傳送的變數

        $.ajax({
            url: '/oriboard_class_dateRestruct/php/member.php',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,     //data只能指定單一物件                 
            type: 'post',
            success: function (response) {
                response = JSON.parse(response);
                if (response === true) {
                    alert("上傳成功!");
                    location.reload();
                } else {
                    alert(response);
                }
            }
        });
    });
});