<?php
require_once("classTest/mysql_connect.php");
require_once("classTest/Post.php");
$post = new Post($conn);

switch ($_POST["action"]) {
    case "index":
        ## index();
        if (isset($_POST["date"])){
            echo $post->index($_POST["date"]);
        } else {
            echo $post->index("");
        }
        
        break;

    case "showModify":
        ## showModify($_POST["id"]);
        echo $post->showModify($_POST["id"]);
        break;

    case "modify":
        ## modify($_POST["id"], $_POST["title"]);
        echo $post->modify($_POST["id"], $_POST["title"]);
        break;

    case "remove":
        ## remove($_POST["id"]);
        echo $post->remove($_POST["id"]);
        break;

    case "new":
        ## add($_POST["title"]);
        echo $post->add($_POST["title"]);
        break;
}