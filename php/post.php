<?php
require_once("classTest/mysql_connect.php");
require_once("classTest/Post.php");
$post = new Post($conn);
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "modify":
            echo $post->modify($_POST["id"], $_POST["msg"]);
            break;

        case "remove":
            echo $post->remove($_POST["id"]);
            break;

        case "new":
            echo $post->add($_POST["title"]);
            break;
    }
} else {
    if (isset($_GET["page"])) {
        echo $post->index("", $_GET["page"]);
    } elseif (isset($_GET["id"])) {
        echo $post->showModify($_GET["id"]);
    } else {
        echo $post->index("", "1");
    }
};