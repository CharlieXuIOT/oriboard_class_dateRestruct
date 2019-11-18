<?php
require_once("classTest/mysql_connect.php");
require_once("classTest/Member.php");
$member = new Member($conn);

switch ($_POST["action"]) {
    case "navbar":
        ## navbar();
        echo $member->navbar();
        break;

    case "login":
        ## login($_POST["account"], $_POST["password"]);
        echo $member->login($_POST["account"], $_POST["password"]);
        break;

    case "register":
        ## register($_POST["account"], $_POST["password"]);
        echo $member->register($_POST["account"], $_POST["password"]);
        break;

    case "logout":
        ## logout();
        echo $member->logout();
        break;

    case "showUpload":
        ## showModify($_POST["id"]);
        echo $member->showUpload();
        break;

    case "upload":
        echo $member->upload($_FILES["file"]);
        break;
}