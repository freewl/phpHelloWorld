<?php

/**
 * ����log���ļ�
 */
require_once './include/log.php';

/**
 * ��ʼ����־handler
 */
$logHandler = new CLogFileHandler("log/".date('Y-m-d').'.log');
Log::Init($logHandler, 15);


/**
 * ҵ���߼�����
 */
Log::INFO("ֻ��һ����־");

?>
