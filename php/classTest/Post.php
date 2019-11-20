<?php
require_once("Session.php");

class Post extends Session
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
        $this->verify();
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
        if ($result->num_rows === 0) {
            return $result->num_rows;
        }
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        $this->conn->close();
        return json_encode($arr);
    }

    function add($title)
    {
        if ($title === "") {
            return "empty message";
        } else {
            // $account = $_SESSION["account"];
            $account = $this->ss_account;
            $query = "INSERT INTO `post` (`member_id`, `title`) VALUES ((SELECT `id` FROM `member` WHERE `account` = ?), ?)";
            $stmt = $this->conn->prepare($query);

            ## 設置參數並執行
            $stmt->bind_param("ss", $account, $title);
            return (json_encode($stmt->execute()));
        }
    }

    function showModify($id)
    {
        $sql = "SELECT * FROM `post` WHERE `id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_assoc();
        return json_encode($arr);
    }

    function modify($id, $title)
    {
        if ($title === "") {
            return "empty message";
        } else {
            ## 先確認提出要求的是否為原作者
            $sql = "SELECT `member`.`account` FROM `post`,`member` WHERE `post`.`member_id` = `member`.`id` AND `post`.`id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($account);
            $stmt->fetch();
            ## $stmt-> free_result()释放与结果集相关的内存,而$stmt-> close()释放与准备语句相关的内存
            $stmt->close();
            // if ($account === $_SESSION["account"]) {
            if ($account === $this->ss_account) {
                ## 預處理
                $query = "UPDATE `post` SET `title`= ? WHERE `id`= ?";
                $stmt = $this->conn->prepare($query);

                ## 設置參數並執行
                $stmt->bind_param("si", $title, $id);
                return (json_encode($stmt->execute()));
            } else {
                return 'not original author';
            }
        }
    }

    function remove($id)
    {
        $query = "SELECT member_id FROM post WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($member_id);
        $stmt->fetch();
        $stmt->close();
        if ($member_id == "") {
            return "empty";
        } else {
            ## 先確認提出要求的是否為原作者
            $sql = "SELECT `member`.`account` FROM `post`,`member` WHERE `post`.`member_id` = `member`.`id` AND `post`.`id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($account);
            $stmt->fetch();
            ## $stmt-> free_result()释放与结果集相关的内存,而$stmt-> close()释放与准备语句相关的内存
            $stmt->close();
            // if ($account === $_SESSION["account"] || $_SESSION["permission"] === 2) {
            if ($account === $this->ss_account || $this->ss_permission === 2) {
                ## 預處理
                $query = "DELETE FROM `post` WHERE id = ?";
                $stmt = $this->conn->prepare($query);

                ## 設置參數並執行
                $stmt->bind_param("i", $id);
                return (json_encode($stmt->execute()));
            }
        }
    }

    function test()
    {
        echo $this->ss_permission;
    }
}