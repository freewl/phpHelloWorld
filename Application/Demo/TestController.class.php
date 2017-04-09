<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/20
 * Time: 22:31
 */
require_once VENDOR_PATH . "smarty-3.1.30/libs/Smarty.class.php";

class TestController{
    public function index(){
        echo (C("host"));
        echo "test-index";
    }

    public function test(){
        \Log::INFO("start run test method");
        $mysql = new Mysql(C(""));

        try {
            $data = $mysql->query("select * from test");
            \Log::INFO("查询test数据库 res = " . json_encode($data));
        }catch(Exception $e){
            \Log::INFO("查询test数据库失败 res = " . json_encode($e->getMessage()));
        }

        $smarty  = new Smarty();
        $smarty->setTemplateDir(APP_PATH.'View/');
        $smarty->setCompileDir(APP_PATH.'View/compile/');
        //$this->setConfigDir('/web/www.example.com/guestbook/configs/');
        $smarty->setCacheDir(APP_PATH.'View/cache/');
        $smarty->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $smarty->assign('who', 'Smarty');
        $smarty->display('index.html'); //对比thinkphp controller里的display方法。 $this-{
        \Log::INFO("end run test method");
    }
}