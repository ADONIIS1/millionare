<?php

require_once("config/db.class.php");
class User{

    public $ID;
    public $userName;
    public $password;
    public function __construct($u_name, $u_pass)
    {
        $this->userName = $u_name;
        $this->password = $u_pass;

    }
    public static function checkLogin($username, $password){
        $db = new Db();
        $sql = "SELECT * FROM users where UserName = '$username'AND Password = '$password'";
        $result = $db->query_execute($sql);
        return $result;
    }
}