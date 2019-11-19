<?php


class Post
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
    }

    function __destruct()
    {
        ## TODO: Implement __destruct() method.
    }

    function index($date)
    {
        $regex = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
        if ($date === "" || preg_match($regex, $date) === 0) {
            $sql = "SELECT `post`.*,`member`.`account` FROM `post`,`member` 
            WHERE `post`.`member_id` = `member`.`id` 
            ORDER BY post_time DESC";
        } else {
            $date = date_create($date);
            $date = date_format($date, 'Y/m/d');
            $sql = "SELECT `post`.*,`member`.`account` FROM `post`,`member` 
            WHERE (`post`.`member_id` = `member`.`id`)
            AND (date(`post_time`) = date('$date'))
            ORDER BY post_time DESC";
        }
        $result = $this->conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        $this->conn->close();
        return json_encode($arr);
        // return $sql;
    }

    function add($title)
    {
        $account = $_SESSION["account"];
        $query = "INSERT INTO `post` (`member_id`, `title`) VALUES ((SELECT `id` FROM `member` WHERE `account` = ?), ?)";
        $stmt = $this->conn->prepare($query);

        ## 設置參數並執行
        $stmt->bind_param("ss", $account, $title);
        if($stmt->execute()){
            return 'success';
        } else {
            return 'fail';
        }
    }

    function showModify($id)
    {
        $sql = "SELECT * FROM `post` WHERE `id` = $id";
        $result = mysqli_query($this->conn, $sql);
        $arr[] = $result->fetch_assoc();
        return json_encode($arr);
    }

    function modify($id, $title)
    {
        ## 先確認提出要求的是否為原作者
        $sql = "SELECT `member`.`account` FROM `post`,`member` WHERE `post`.`member_id` = `member`.`id` AND `post`.`id` = ${id}";
        $account = mysqli_query($this->conn, $sql)->fetch_object()->account;
        if($account === $_SESSION["account"]){
            ## 預處理
            $query = "UPDATE `post` SET `title`= ? WHERE `id`= ?";
            $stmt = $this->conn->prepare($query);

            ## 設置參數並執行
            $stmt->bind_param("si", $title, $id);
            if($stmt->execute()){
                return 'success';
            } else {
                return 'fail';
            }
        } else {
            return 'hah?';
        }
    }

    function remove($id)
    {
        ## 先確認提出要求的是否為原作者
        $sql = "SELECT `member`.`account` FROM `post`,`member` WHERE `post`.`member_id` = `member`.`id` AND `post`.`id` = $id";
        $account = mysqli_query($this->conn, $sql)->fetch_object()->account;
        if($account === $_SESSION["account"] || $_SESSION["permission"] === 2) {
            ## 預處理
            $query = "DELETE FROM `post` WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            ## 設置參數並執行
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                return 'success';
            } else {
                return 'fail';
            }
        }
    }
}