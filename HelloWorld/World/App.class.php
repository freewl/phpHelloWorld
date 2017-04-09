<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:15
 * Thinkphp有一个调度类dispatch => 完成URL解析、路由和调度
 */
class App {
    static public function run(){
        Log::INFO("start run app");

        $m=$_REQUEST['m'];
        $c=$_REQUEST['c'];
        $a=$_REQUEST['a'];

        $ccc = $c."Controller";
        $newClass = new $ccc();
        /*$newClass = new TestController();*/
        $newClass -> $a();
    }
}