<?php


class Member
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

    /* 
    ** navbar顯示會員帳號
    */
    function navbar()
    {
        if (isset($_SESSION["account"]) === false) {
            ## 第一次訪問網站的遊客
            $_SESSION["account"] = "";
            $_SESSION["permission"] = 0;
        } elseif ($_SESSION["account"] === "") {
            $_SESSION["permission"] = 0;
        }
        $arr["account"] = $_SESSION["account"];
        $arr["permission"] = $_SESSION["permission"];
        return json_encode($arr);
    }

    /*
    ** 登入
    */
    function login($keyin_account, $keyin_password)
    {
        $regex = "/^[A-Za-z0-9]{3,}$/";
        $accFlag = preg_match($regex, $keyin_account);
        $pwFlag = preg_match($regex, $keyin_password);
        if ($accFlag === 1 && $pwFlag === 1) {
            ## 預處理
            $stmt = $this->conn->prepare("SELECT password, permission FROM `member` WHERE account = ?;");
            $stmt->bind_param("s", $keyin_account);

            ## 設置參數並執行
            $stmt->execute();
            $stmt->bind_result($password, $permission);
            $stmt->fetch();

            if(password_verify($keyin_password, $password)){
                $_SESSION["account"] = $keyin_account;
                $_SESSION["permission"] = $permission;
                $this->conn->close();
                return "success";
            } else {
                $this->conn->close();
                return "fail";
            }
        } else {
            return "formError";
        }
    }

    /*
    ** 註冊
    */
    function register($account, $password)
    {
        $regex = "/^[A-Za-z0-9]{3,}$/";
        $accFlag = preg_match($regex, $account);
        $pwFlag = preg_match($regex, $password);

        if ($accFlag === 1 && $pwFlag === 1) {
            $query = 'INSERT INTO `member` (`account`,`password`,`permission`) VALUES (?,?,?)';
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $account, $password, $permission);

            ## 設置參數並執行
            $password = password_hash($password, PASSWORD_DEFAULT);
            $permission = 1;
            if($stmt->execute()){
                $this->conn->close();
                return "success";
            } else {
                ## echo("Error: ".mysqli_error($conn));
                $this->conn->close();
                return "repeat";
            };
        } else {
            return "formError";
        }
    }

    /*
    ** 登出
    */
    function logout()
    {
        session_unset();
        session_destroy();
        return "success";
    }
}