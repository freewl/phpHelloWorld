<?php

/**
 * 引入log库文件
 */
require_once './include/log.php';

/**
 * 初始化日志handler
 */
$logHandler = new CLogFileHandler("log/".date('Y-m-d').'.log');
Log::Init($logHandler, 15);


/**
 * 业务逻辑代码
 */
Log::INFO("只是一个日志");

?>
