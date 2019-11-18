$(document).ready(function () {
    let account, permission;
    $.ajax({
        type: "POST",
        url: "/oriboard_class_dateRestruct/php/member.php",
        async: false,
        data: {
            "action": "navbar"
        },
        success: function (response) {
            response = JSON.parse(response);
            // if (response["account"] != "") {
            account = response["account"];
            // }
            permission = response["permission"];
        }
    });

    $.ajax({
        type: "POST",
        url: "/oriboard_class_dateRestruct/php/post.php",
        data: {
            "action": "index"
        },
        success: function (response) {
            response = JSON.parse(response);
            dataToWeb(response, permission, account);
        }
    });

    $("#dateSearch").click(function (e) {
        let regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
        if (regex.test($("#datepicker").val())){
            $.ajax({
                type: "POST",
                url: "/oriboard_class_dateRestruct/php/post.php",
                data: {
                    "action": "index",
                    "date": $("#datepicker").val()
                },
                success: function (response) {
                    response = JSON.parse(response);
                    dataToWeb(response, permission, account);
                }
            });
        } else {
            $("#datepicker").val("");
            alert("時間格式不符!");
        }
        
    });
})

$(document).on('click', '.modify', function (event) {
    let id = $(this).parent().attr('id');
    let url = "modify.html?id=" + id;
    window.location.href = url;
});

$(document).on('click', '.remove', function (event) {
    let id = $(this).parent().attr('id');
    if (confirm("真的要刪除嗎?")) {
        $.ajax({
            type: "POST",
            url: "/oriboard_class_dateRestruct/php/post.php",
            data: {
                "action": "remove",
                "id": id
            },
            success: function (response) {
                if (response === "success") {
                    $("#" + id).parent().remove();
                }
            }
        });
    } else {
        return false;
    }
});

$( function() {
    $( "#datepicker" ).datepicker();
} );

function dataToWeb(response, permission, account) {
    $("#list").empty();
    $.each(response, function (indexInArray, valueOfElement) {
        let newEl = document.createElement('div');
        newEl.textContent = valueOfElement["title"];
        let tmpTitle = newEl.innerHTML;
        // console.log(newEl.innerHTML, newEl.textContent);

        if (permission == 2) {
            if (valueOfElement["account"] === account) {
                $("#list").append('<li class="list-group-item"><small id="' + valueOfElement["id"] + '" class="pull-right text-muted"> \
                    <button class="glyphicon glyphicon-pencil modify"></button><button class="glyphicon glyphicon-remove remove"></button>'+
                    valueOfElement["post_time"] + '</small><div> \
                    <small class="list-group-item-heading text-muted text-primary">'+ valueOfElement["account"] + '</small> \
                    <p class="list-group-item-text"><pre>' + tmpTitle + '</pre></p></div></li>');
            } else {
                $("#list").append('<li class="list-group-item"><small id="' + valueOfElement["id"] + '" class="pull-right text-muted"> \
                    <button class="glyphicon glyphicon-remove remove"></button>'+
                    valueOfElement["post_time"] + '</small><div> \
                    <small class="list-group-item-heading text-muted text-primary">'+ valueOfElement["account"] + '</small> \
                    <p class="list-group-item-text"><pre>'+ tmpTitle + '</pre></p></div></li>');
            }
        } else {
            if (valueOfElement["account"] === account) {
                $("#list").append('<li class="list-group-item"><small id="' + valueOfElement["id"] + '" class="pull-right text-muted"> \
                    <button class="glyphicon glyphicon-pencil modify"></button><button class="glyphicon glyphicon-remove remove"></button>'+
                    valueOfElement["post_time"] + '</small><div> \
                    <small class="list-group-item-heading text-muted text-primary">'+ valueOfElement["account"] + '</small> \
                    <p class="list-group-item-text"><pre>' + tmpTitle + '</pre></p></div></li>');
            } else {
                $("#list").append('<li class="list-group-item"><small class="pull-right text-muted">' + valueOfElement["post_time"] + '</small><div> \
                    <small class="list-group-item-heading text-muted text-primary">'+ valueOfElement["account"] + '</small> \
                    <p class="list-group-item-text"><pre>'+ tmpTitle + '</pre></p></div></li>');
            }
        }
    });
}