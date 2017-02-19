<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/1/22
 * Time: 23:01
 */
namespace PHWDemo;

class Mysql extends MyPDO{
    /**
     * 解析数据库连接字段dsn
     *
     * @param $config
     * @return string
     */
    protected function parseDsn($config){
        $dsn  =   'mysql:dbname='.$this->config['dbname'].';host='.$this->config['host'];

        if(!empty($this->config['port'])) {
            $dsn  .= ';port='.$this->config['port'];
        }elseif(!empty($config['socket'])){
            $dsn  .= ';unix_socket='.$this->config['socket'];
        }

        return $dsn;
    }
}