<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/1/22
 * Time: 23:01
 */
namespace PHWDemo;


class MyPDO{
    public static $_instance =null;
    private $con;



    public function __construct($dbms,$host,$dbname,$user,$pass){
        $dsn = $dbms.":host=".$host.";dbname=".$dbname;
        try {
            $this->con = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        }catch (\PDOException $e){
            die("出错啦:".$e->getMessage());
        }
    }

    public static function getInstance($dbms,$host,$dbname,$user,$pass){
        if(empty(self::$_instance)){
            self::$_instance = new self($dbms,$host,$dbname,$user,$pass);
        }
        return self::$_instance;
    }

    /**
     * destruct 关闭数据库连接
     */
    public function destruct()
    {
        $this->con = null;
    }
}