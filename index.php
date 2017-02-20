<?php
/**
 * 定义网站根目录
 */
define('ROOT_PATH', dirname(__FILE__));
define("APP_PATH",'./Application/');

require "./HelloWorld/base.php";

/**
 * 初始化日志handler
 */
/*$logHandler = new \CLogFileHandler("Log/".date('Y-m-d').'.log');
\Log::Init($logHandler, 15);*/


/**
 * 业务逻辑代码
 */
/*\Log::INFO("只是一个日志");*/



/*$config = array(
    'type'      =>  'mysql',
    'host'      =>  '127.0.0.1',
    'dbname'    =>  'test',
    'user'      =>  'root',
    'password'  =>  'freewl',
    'port'      =>  '3306',
    'charset'   =>  'utf8'
);
require_once "./HelloWorld/Lib/Class/MyPDO.class.php";
require_once "./HelloWorld/Lib/Class/Mysql.class.php";
$mysql = new Mysql($config);

try {
    $data = $mysql->query("select * from test");
    print_r($data);
}catch(Exception $e){
    print_r($e->getMessage());
}*/

