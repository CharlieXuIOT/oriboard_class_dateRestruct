<?php
require_once("Session.php");

class Member extends Session
{
    private $conn;
    protected $ss_account, $ss_permission;
    ## 放圖片的路徑
    private $imgURL = "../uploads/";

    function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
        $arr = $this->verify();
        $this->ss_account = $arr["account"];
        $this->ss_permission = $arr["permission"];
    }

    function __destruct()
    {
        ## TODO: Implement __destruct() method.
    }

    /**
     * navbar顯示會員帳號
     */
    function navbar()
    {
        $arr = array();
        $arr["account"] = $this->ss_account;
        $arr["permission"] = $this->ss_permission;
        return json_encode($arr);
    }

    /**
     * 登入
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

            $verify = password_verify($keyin_password, $password);
            if ($verify) {
                $this->assign($keyin_account, $permission);
                $this->verify();
            }
            $this->conn->close();
            return json_encode($verify);
        } else {
            return json_encode(false);
        }
    }

    /**
     * 註冊
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
            ## echo("Error: ".mysqli_error($conn));
            return json_encode($stmt->execute());
            $this->conn->close();
        } else {
            return json_encode(false);
        }
    }

    /**
     * 登出
     */
    function logout()
    {
        session_unset();
        session_destroy();
        return json_encode(true);
    }


    function showUpload()
    {
        ## 預處理
        $stmt = $this->conn->prepare("SELECT image FROM `member` WHERE account = ?;");
        $stmt->bind_param("s", $this->ss_account);
        ## 設置參數並執行
        $stmt->execute();
        $stmt->bind_result($image);
        $stmt->fetch();
        $image = $this->imgURL.$image;

        return json_encode($image);
    }

    function upload($fileInfo, $allowExt = array('jpeg', 'jpg', 'gif', 'png'), $maxSize = 2097152, $flag = true, $uploadPath = '../uploads')
    {
        ## 存放錯誤訊息
        $mes = '';

        ## 取得上傳檔案的檔案格式
        $ext = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);

        ## 確保檔案名稱唯一，防止重覆名稱產生覆蓋
        ## microtime : 讀取伺服器當前的 Unix 時間戳以及微秒數
        ## uniqid : 以微秒计的当前时间，生成一个唯一的 ID
        ## md5 : 加密字符串
        $uniName = md5(uniqid(microtime(true), true)) . '.' . $ext;
        $destination = $uploadPath . '/' . $uniName;

        ## 判斷是否有錯誤
        if ($fileInfo['error'] > 0) {
            ## 匹配的錯誤代碼
            switch ($fileInfo['error']) {
                case 1:
                    $mes = '上傳的檔案超過了 php.ini 中 upload_max_filesize 允許上傳檔案容量的最大值';
                    break;
                case 2:
                    $mes = '上傳檔案的大小超過了 HTML 表單中 MAX_FILE_SIZE 選項指定的值';
                    break;
                case 3:
                    $mes = '檔案只有部分被上傳';
                    break;
                case 4:
                    $mes = '沒有檔案被上傳（沒有選擇上傳檔案就送出表單）';
                    break;
                case 6:
                    $mes = '找不到臨時目錄';
                    break;
                case 7:
                    $mes = '檔案寫入失敗';
                    break;
                case 8:
                    $mes = '上傳的文件被 PHP 擴展程式中斷';
                    break;
            }

            return ($mes);
        }

        ## 檢查檔案是否是通過 HTTP POST 上傳的
        if (!is_uploaded_file($fileInfo['tmp_name']))
            return ('檔案不是通過 HTTP POST 方式上傳的');

        ## 檢查上傳檔案是否為允許的檔案格式
        if (!is_array($allowExt))  ## 判斷參數是否為陣列
            return ('檔案類型型態必須為 array');
        else {
            if (!in_array($ext, $allowExt))  ## 檢查陣列中是否有允許的檔案格式
                return ('檔案規格不符');
        }

        ## 檢查上傳檔案的容量大小是否符合規範
        if ($fileInfo['size'] > $maxSize)
            return ('上傳檔案容量超過限制');

        ## 檢查是否為真實的圖片類型
        if ($flag && !@getimagesize($fileInfo['tmp_name']))
            return ('不是真正的圖片類型');

        ## 檢查指定目錄是否存在，不存在就建立目錄
        if (!file_exists($uploadPath))
            mkdir($uploadPath, 0777, true);  ## 建立目錄

        ## 將檔案從臨時目錄移至指定目錄
        if (!@move_uploaded_file($fileInfo['tmp_name'], $destination))  ## 如果移動檔案失敗
            return ('檔案移動失敗');

        require_once("mysql_connect.php");
        ## 預處理
        $query = "UPDATE `member` SET `image`= ? WHERE `id`= (SELECT `id` FROM `member` WHERE `account` = ?)";
        $stmt = $this->conn->prepare($query);

        ## 設置參數並執行
        $stmt->bind_param("ss", $uniName, $this->ss_account);
        return json_encode($stmt->execute());
    }
}