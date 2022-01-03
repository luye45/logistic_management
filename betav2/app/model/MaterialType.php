<?php
namespace app\model;

use app\database\MySqlDb;
use function app\utils\ajax;

require_once "../utils/redefine.php";
require_once "../database/MysqlDb.php";
require_once "../../conf/config.php";
define('Config',$config);

class MaterialType{
    private $id;
    private $name;
    
        /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    function showAllTypeName(){
        $dbh = new MySqlDb(Config);
        $sql = "select name from material_type";
        ajax($dbh->getAll($sql),true);
    }

    function queryTypeId($name){
        $dbh = new MySqlDb(Config);
        $sql = "select id from material_type where name = '$name'";
        $query = $dbh->getOne($sql);
        return $query['id'];
    }

    function countDistinctTypeNameAs(){
        $dbh = new MySqlDb(Config);
        $sql = "select distinct name from material_type";
        $query = $dbh->getAll($sql);
        return $query;
    }
}