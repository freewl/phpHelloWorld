<?php
const WORLD_VERSION = '1.0.0beta';
const EXT = '.class.php';

define('PHP_HELLO_WORLD', true);

defined('HELLO_WORLD_PATH') or define('HELLO_WORLD_PATH',__DIR__.'/');// HelloWorld路径
defined('WORLD_PATH') or define('WORLD_PATH', HELLO_WORLD_PATH.'World/');// HelloWorld/World路径
defined('LIB_PATH') or define('LIB_PATH', HELLO_WORLD_PATH.'Lib/');// HelloWorld/Lib路径
defined('COMMON_PATH') or define('COMMON_PATH', HELLO_WORLD_PATH.'Common/');// HelloWorld/Lib路径

defined('CONF_EXT')     or define('CONF_EXT','.php'); //公共文件后缀

// 加载核心类
require WORLD_PATH.'World'.EXT;

// 应用初始化
World::start();



/*
require_once ROOT_PATH.'/HelloWorld/Lib/Class/Log.class.php';
require_once ROOT_PATH.'/HelloWorld/Lib/Class/MyPDO.class.php';
require_once ROOT_PATH.'/HelloWorld/Lib/Class/Mysql.class.php';
*/


