<?php
const WORLD_VERSION = '1.0.0beta';
const EXT = '.class.php';

define('PHP_HELLO_WORLD', true);

defined('HELLO_WORLD_PATH') or define('HELLO_WORLD_PATH',__DIR__.'/');// HelloWorld·��
defined('WORLD_PATH') or define('WORLD_PATH', HELLO_WORLD_PATH.'World/');// HelloWorld/World·��
defined('LIB_PATH') or define('LIB_PATH', HELLO_WORLD_PATH.'Lib/');// HelloWorld/Lib·��
defined('COMMON_PATH') or define('COMMON_PATH', HELLO_WORLD_PATH.'Common/');// HelloWorld/Lib·��

defined('CONF_EXT')     or define('CONF_EXT','.php'); //�����ļ���׺

// ���غ�����
require WORLD_PATH.'World'.EXT;

// Ӧ�ó�ʼ��
World::start();



/*
require_once ROOT_PATH.'/HelloWorld/Lib/Class/Log.class.php';
require_once ROOT_PATH.'/HelloWorld/Lib/Class/MyPDO.class.php';
require_once ROOT_PATH.'/HelloWorld/Lib/Class/Mysql.class.php';
*/


