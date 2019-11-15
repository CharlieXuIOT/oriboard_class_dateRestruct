<?php
// require_once ("mysql_connect.php");
// require_once ("Member.php");
// require_once ("Post.php");

// $member = new Member($conn);
// // $member->result();
// $member->login($_GET["ac"], $_GET["pw"]);
// echo $result."<br>".$_SESSION["account"]."<br>";
// $result = $member->logout();
// echo  $result."<br>";
// var_dump(isset($_SESSION["account"]));
// $post = new Post($conn);

// // 顯示大廳留言
// $result = $post->index();
// print_r($result);

// 新增留言
// echo $post->add($_GET["title"]);
// $member->logout();

// 修改留言介面
// print_r($post->showModify("25"));

// 修改留言
// echo $post->modify($_GET["id"], $_GET["title"]);
// session_start();
// echo $_SESSION["account"];

// 刪除留言
// echo $post->remove($_GET["id"]);

echo $_POST["date"]."<br>";
$date = date_create($_POST["date"]);
echo date_format($date, 'Y/m/d')."<br>";

$arr["1"] = 1;
$arr["2"] = 2;

switch ($arr["1"]) {
    case 1:
        if ($arr["2"] == 2){
            echo "1>1 2>2";
        } else {
            echo "1>1 2?2";
        }        
    break;

    case 2:
        echo "1>2";
    break;
}