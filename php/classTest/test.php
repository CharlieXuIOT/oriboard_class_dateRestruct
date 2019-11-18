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

// // 時間格式
// echo $_POST["date"]."<br>";
// $date = date_create($_POST["date"]);
// echo date_format($date, 'Y/m/d')."<br>";

// // switch裡面的if是否正常運作
// $arr["1"] = 1;
// $arr["2"] = 2;

// switch ($arr["1"]) {
//     case 1:
//         if ($arr["2"] == 2){
//             echo "1>1 2>2";
//         } else {
//             echo "1>1 2?2";
//         }        
//     break;

//     case 2:
//         echo "1>2";
//     break;
// }
?>
<!-- 檔案上傳系統 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
</head>
<body>
    <form action="upload-manager.php" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB.</p>
    </form>
</body>
</html>

<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload/" . $_FILES["photo"]["name"])){
                echo $_FILES["photo"]["name"] . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
?>