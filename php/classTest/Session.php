<?php


class Session
{
    protected $ss_account, $ss_permission;

    function verify()
    {
        if (isset($_SESSION["account"]) === false) {
            ## 第一次訪問網站的遊客
            $_SESSION["account"] = "";
            $_SESSION["permission"] = 0;
        } elseif ($_SESSION["account"] === "") {
            $_SESSION["permission"] = 0;
        }
        $this->ss_account = $_SESSION["account"];
        $this->ss_permission = $_SESSION["permission"];
    }
}