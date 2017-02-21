<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/19
 * Time: 23:15
 */
class App {
    static public function run(){
        Log::INFO("run: 只是一个日志");

        $m=$_REQUEST['m'];
        $c=$_REQUEST['c'];
        $a=$_REQUEST['a'];

        $ccc = $c."Controller";
        $newClass = new $ccc();
        /*$newClass = new TestController();*/
        $newClass -> $a();
    }
}