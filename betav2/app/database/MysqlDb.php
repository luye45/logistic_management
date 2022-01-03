<?php
/*
说明 : 这里是数据库操作的公共类
*/
namespace app\database;

use Exception;

class MySqlDb
{
    private $link;
    private $config;
    private static $instance = null;

   public function __construct($config)
    {
        /**
         * 初始化数据库
         */
        $this->config = $config;
        $this->connect();
    }
    public function connect(){
        try {
            $this->link= mysqli_connect($this->config['host'].':'.$this->config['port'], $this->config['username'], $this->config['password'],$this->config['dbname']);
            mysqli_set_charset($this->link,$this->config['charset']);
            mysqli_query($this->link,"set time_zone='".$this->config['timezone']."'");
         }catch(Exception $e){
           echo '数据库连接失败,详情: ' . $e->getMessage () . ' 请在配置文件中数据库连接信息';
           exit ();
         }
    }
    /**
     * 所有的数据库方法
     */
    private function query($sql)
    {
        $res = mysqli_query($this->link,$sql);
        if ($res === false) {
            echo "<p>sql语句执行失败：<br>错误信息：" . mysqli_error($this->link);
            die();
        }
        return $res;
    }

    public function getOne($sql)
    {
        $res = $this->query($sql);
        $re = mysqli_fetch_assoc($res);
       
        return $re;
    }

    public function getAll($sql)
    {

        $res = $this->query($sql);
        $arr = array();
        while ($re = mysqli_fetch_assoc($res)) {
            $arr[] = $re;
        }
        return $arr;
    }

    public function exec($sql)
    {   
        $res = $this->query($sql);
        return $res;
    }


}


?>