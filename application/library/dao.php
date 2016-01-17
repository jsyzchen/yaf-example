<?php
/**
 * 基于PDO的DAO层，数据库操作基类
 * Date: 15/11/30
 * Time: 11:33
 * @author : chenchenjsyz@163.com
 */
class dao
{
    private $_pdo;

    //单例效果
    private static $_instance;
    /**
     * 构造方法
     *
     * @params $options array
     */
    private function __construct($options=array()) {
        $dsn = $options['driver'].':dbname='.$options['database'].';host='.$options['host'];
        $user = $options['username'];
        $password = $options['password'];
        $charset = isset($options['charset']) ? $options['charset'] : 'utf8';
        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->exec("SET NAMES '" . $charset . "'");
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $this->_pdo = $dbh;
    }

    /**
     * 禁止克隆
     */
    private function __clone() {

    }

    /**
     * 获得单例对象的公共方法
     */
    public static function getInstance($options=array()) {
        $options = !empty($options) ? $options : get_config('database');
        //判断是否没有实例化对象
        if(!static::$_instance instanceof static) {
            static::$_instance = new static($options);
        }
        return static::$_instance;
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     * @param $sql
     */
    public function query($sql) {
        $stmt = $this->_pdo->query($sql);
        return $stmt;
    }

    /**
     * 执行一条 SQL 语句，并返回受影响的行数
     * @param $sql
     * @return mixed
     */
    public function exec($sql){
        $stmt = $this->_pdo->exec($sql);
        return $stmt;
    }

    /**
     * 获取所有数据
     * @param $sql
     * @return mixed
     */
    public function fetchAll($sql) {
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 获取一行数据
     * @param $sql
     * @return mixed
     */
    public function fetchRow($sql) {
        $stmt = $this->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 获取一个结果
     * @param $sql
     * @param $field
     * @return mixed
     */
    public function fetchOne($sql,$field) {
        $res = $this->fetchRow();
        return $res[$field];
    }

    /**
     * sql预处理
     * @param $sql
     * @param array $driver_options
     * @return PDOStatement
     */
    public function prepare($sql, $driver_options = array()){
        $sth = $this->_pdo->prepare($sql, $driver_options);
        return $sth;
    }

    /**
     * 执行一条预处理语句
     * @param $obj
     * @param $arr
     */
    public function execute($obj,$arr){
        $obj->execute($arr);
    }

    /**
     * 获取数据库错误信息
     * @return string 错误信息
     */
    public function getErrorInfo(){
        return $this->_pdo->errorCode . ':' . $this->_pdo->errorInfo;
    }

    /**
     * 获取最后插入的id
     * @return int insertid
     */
    public function lastInsertId(){
        return $this->_pdo->lastInsertId;
    }

    /**
     * 开启事务
     */
    public function beginTransaction(){
        $this->_pdo->beginTransaction();
    }

    /**
     * 提交事务
     */
    public function commit(){
        $this->_pdo->commit();
    }

    /**
     * 回滚一个事务
     */
    public function rollBack(){
        $this->_pdo->rollBack();
    }

    /**
     * 返回添加引号的字符串
     * @param $string
     * @return string
     */
    public function quote($string){
        return $this->_pdo->quote($string);
    }
}
?>