<?php
/**
 * Created by IntelliJ IDEA.
 * User: want
 * Date: 2017/1/22
 * Time: 23:01
 */
namespace PHWDemo;
use PDO;

abstract class MyPDO{
    // PDO操作实例
    protected $PDOStatement;
    // 错误信息
    protected $error;
    // 当前SQL指令
    protected $queryStr = '';
    // 当前连接
    protected $link = null;
    // 数据库连接参数配置
    protected $config = array(
        'type'      =>  '',
        'host'      =>  '127.0.0.1',
        'dbname'    =>  '',
        'user'      =>  '',
        'password'      =>  '',
        'port'      =>  '',
        'charset'   =>  "utf8"
    );
    // PDO连接参数
    protected $options = array(
        PDO::ATTR_CASE              =>  PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE           =>  PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS      =>  PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES =>  false,
    );
    // 查询表达式
    protected $selectSql  = 'SELECT %FIELD% FROM %TABLE% %WHERE% %ORDER% %LIMIT%';

    /**
     * 构造函数
     * @param string $config
     */
    public function __construct($config=''){
        if(!empty($config)){
            $this->config = array_merge($this->config,$config);
        }
    }

    public function connect($config=''){
        if(!isset($this->link)){
            if(empty($config)) $config=$this->config;
            try{
                if(empty($config['dsn'])) {
                    $config['dsn']  =   $this->parseDsn($config);
                }
                if(version_compare(PHP_VERSION,'5.3.6','<=')){
                    // 禁用模拟预处理语句
                    $this->options[PDO::ATTR_EMULATE_PREPARES]  =   false;
                }
                $this->link = new PDO( $config['dsn'], $config['user'], $config['password'],$this->options);
            }catch (\PDOException $e){
                throw new \Exception($e->getMessage());
            }
        }

        return $this->link;
    }

    /**
     * 执行查询 返回数据集
     * @param $str
     * @param bool|false $fetchSql
     * @return array|bool|string
     * @throws \Exception
     */
    public function query($str,$fetchSql=false) {
        $this->connect($this->config);
        if ( !$this->link ){
            return false;
        }

        $this->queryStr=$str;
        if($fetchSql){
            return $this->queryStr;
        }

        //释放前次的查询结果
        if ( !empty($this->PDOStatement) ){
            $this->free();
        }
        $this->PDOStatement = $this->link->prepare($str);
        if(false === $this->PDOStatement){
            throw new \Exception($this->error());
        }

        $result = $this->PDOStatement->execute();
        if ( false === $result ) {
            $this->error();
            return false;
        } else {
            return $this->getResult();
        }
    }

    /**
     * select 查询
     *
     * @param array $options
     * @return mixed
     */
    public function select($options=array()){
        $sql=$this->buildSelectSql($options);
        $result   = $this->query($sql,!empty($options['fetch_sql']) ? true : false);
        return $result;
    }

    /**
     * 生成查询SQL
     * @access public
     * @param array $options 表达式
     * @return string
     */
    public function buildSelectSql($options=array()) {
        $sql  =   $this->parseSql($this->selectSql,$options);
        return $sql;
    }

    /**
     * 替换SQL语句中表达式
     * @access public
     * @param array $options 表达式
     * @return string
     */
    public function parseSql($sql,$options=array()){
        $sql   = str_replace(
            array('%TABLE%','%FIELD%','%WHERE%','%GROUP%','%ORDER%','%LIMIT%'),
            array(
                $this->parseTable($options['table']),
                $this->parseField(!empty($options['field'])?$options['field']:'*'),
                $this->parseWhere(!empty($options['where'])?$options['where']:''),
                $this->parseGroup(!empty($options['group'])?$options['group']:''),
                $this->parseOrder(!empty($options['order'])?$options['order']:''),
                $this->parseLimit(!empty($options['limit'])?$options['limit']:'')
            ),$sql);
        return $sql;
    }

    public function parseTable($optons=array()){

    }
    public function parseField($optons=array()){

    }
    public function parseWhere($optons=array()){

    }
    public function parseGroup($optons=array()){

    }
    public function parseOrder($optons=array()){

    }
    public function parseLimit($optons=array()){

    }

    /**
     * 获得所有的查询数据
     * @access private
     * @return array
     */
    private function getResult() {
        //返回数据集
        $result = $this->PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 数据库错误信息
     * 并显示当前的SQL语句
     * @access public
     * @return string
     */
    public function error() {
        if($this->PDOStatement) {
            $error = $this->PDOStatement->errorInfo();
            $this->error = $error[1].':'.$error[2];
        }else{
            $this->error = '';
        }
        if('' != $this->queryStr){
            $this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
        }
        return $this->error;
    }

    /**
     * 释放查询结果
     * @access public
     */
    public function free() {
        $this->PDOStatement = null;
    }

    /**
     * 解析数据库连接字段dsn
     * @param $config
     */
    protected function parseDsn($config){}

    /**
     * __clone 防克隆
     */
    public function __clone(){}

    /**
     * destruct 关闭数据库连接
     */
    public function __destruct(){
        $this->link = null;
    }
}