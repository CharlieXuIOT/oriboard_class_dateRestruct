<?php
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_dbname = "oriboard";
 
## 创建连接
$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_dbname);
## Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}