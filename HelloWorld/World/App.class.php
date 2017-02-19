<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:15
 */
class App {

    static public function run(){
        $logHandler = new CLogFileHandler(ROOT_PATH . "/Log/" . date('Y-m-d') . '.log');
        Log::Init($logHandler, 15);

        echo "run";
        \Log::INFO("run: 只是一个日志");
    }
}