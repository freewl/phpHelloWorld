<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/2/20
 * Time: 22:31
 */
class TestController{
    public function index(){
        echo (C("host"));
        echo "test-index";
    }

    public function test(){
        $mysql = new Mysql(C(""));

        try {
            $data = $mysql->query("select * from test");
            print_r($data);
        }catch(Exception $e){
            print_r($e->getMessage());
        }
        echo "success get data from test DB";
    }
}