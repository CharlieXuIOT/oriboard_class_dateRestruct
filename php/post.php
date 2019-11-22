<?php
require_once("classTest/mysql_connect.php");
require_once("classTest/Post.php");
$post = new Post($conn);

switch ($_POST["action"]) {
    case "index":
        if (isset($_POST["page"])){
            if (isset($_POST["date"])){
                echo $post->index($_POST["date"], $_POST["page"]);
            } else {
                echo $post->index("", $_POST["page"]);
            }
        } else {
            if (isset($_POST["date"])){
                echo $post->index($_POST["date"], "1");
            } else {
                echo $post->index("", "1");
            }
        }
        break;

    case "showModify":
        echo $post->showModify($_POST["id"]);
        break;

    case "modify":
        echo $post->modify($_POST["id"], $_POST["title"]);
        break;

    case "remove":
        echo $post->remove($_POST["id"]);
        break;

    case "new":
        echo $post->add($_POST["title"]);
        break;
};