<?php
namespace app\model;

use app\database\MySqlDb;

use function app\utils\ajax;
use function app\utils\arrayToString;
use function app\utils\checkLogin;
use function app\utils\objectHandler;
use function app\utils\statusReplace;
use function app\utils\statusResponse;

require_once "../utils/redefine.php";
require_once "../database/MysqlDb.php";
require_once "../model/MaterialType.php";
require_once "../../conf/config.php";
//define('Config',$config);

class Material{
    private $id;
    private $name;
    private $spec;
    private $number;
    private $price;
    private $producer;
    private $createTime;
    private $updatetime;
    private $typeId;
    private $status;

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

    /**
     * Get the value of spec
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * Set the value of spec
     *
     * @return  self
     */
    public function setSpec($spec)
    {
        $this->spec = $spec;

        return $this;
    }

    /**
     * Get the value of number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of producer
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set the value of producer
     *
     * @return  self
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get the value of createTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set the value of createTime
     *
     * @return  self
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get the value of updatetime
     */
    public function getUpdatetime()
    {
        return $this->updatetime;
    }

    /**
     * Set the value of updatetime
     *
     * @return  self
     */
    public function setUpdatetime($updatetime)
    {
        $this->updatetime = $updatetime;

        return $this;
    }

    /**
     * Get the value of typeId
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set the value of typeId
     *
     * @return  self
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    function setStoreMaterialInfo($request){
        $this->setName($request['name']);
        $this->setSpec($request['spec']);
        $this->setNumber($request['number']);
        $this->setPrice($request['price']);
        objectHandler(new MaterialType(),function($mt)use($request){
            $this->setTypeId($mt->queryTypeId($request['type']));
        });
        $this->setProducer($request['producer']);
    }

    function setUpdateMaterialInfo($request){
        $this->setId(($request['id']));
        $this->setName($request['name']);
        $this->setSpec($request['spec']);
        $this->setNumber($request['number']);
        $this->setPrice($request['price']);
        objectHandler(new MaterialType(),function($mt)use($request){
            $this->setTypeId($mt->queryTypeId($request['type']));
        });
        $this->setProducer($request['producer']);
        $this->setStatus($request['status']=='正常'?"1":"-1");
    }

    function setDestroyMaterialInfo($request){
        $this->setId($request['ids']);
    }

    function isExist(){
        $dbh = new MySqlDb(Config);
        $name = $this->getName();
        $typeId = $this->getTypeId();
        $sql = "select name from materials where name = '$name' and type_id = '$typeId'";
        return $dbh->getOne($sql);
    }
    //展示
    function showAllMaterialInfo(){
        $dbh = new MySqlDb(Config);
        $sql = "select m.id,m.name,m.spec,m.number,m.producer,m.price,m.create_time,m.update_time,m.status,mt.name as type from materials m left join material_type mt on m.type_id = mt.id";
        objectHandler($dbh->getAll($sql),function($query){
            statusReplace($query,["1"=>"正常","-1"=>"删除"]);
            ajax($query,true);
        });
    }

    //新增
    function storeMaterial($isExist){
        !!$isExist?exit(ajax(0,false)):objectHandler([$this->getName(),$this->getSpec(),$this->getNumber(),$this->getPrice(),$this->getProducer(),$_SESSION['username'],$this->getTypeId()],function($storeInfo){
            $dbh = new MySqlDb(Config);
            $sql = "insert into materials(name,spec,number,price,producer,create_user_name,type_id) values(".arrayToString($storeInfo).")";
            //echo $sql;
            statusResponse($dbh->exec($sql));
        });
        
    }

    //修改
    function updateMaterial(){
        objectHandler([$this->getName(),$this->getSpec(),$this->getNumber(),$this->getPrice(),$this->getProducer(),$this->getTypeId(),$this->getStatus(),$this->getId()],function($updateInfo){
            $dbh = new MySqlDb(Config);
            $sql = "update materials set name = '$updateInfo[0]',spec= '$updateInfo[1]',number = '$updateInfo[2]',price='$updateInfo[3]',producer = '$updateInfo[4]',type_id = '$updateInfo[5]',update_time = current_timestamp(),status = '$updateInfo[6]' where id = '$updateInfo[7]'";
            statusResponse($dbh->exec($sql));
        });     
    }

    //删除
    function destroyMaterial(){
        objectHandler(implode(",",$this->getId()),function($deleteInfo){
            $dbh = new MySqlDb(Config);
            $sql = "delete from materials where id in(".$deleteInfo.")";
            statusResponse($dbh->exec($sql));
        });
    }
    
    function checkDate($date){
        return date('Y-m-d H:i:s',strtotime($date))==$date;
    }
    // function isDateAvaliable($request){
    //     $begindate = $_REQUEST['begindate'];
    //     $enddate = $_REQUEST['enddate'];
    //     if($begindate)
    //     (((!$begindate) && !!$enddate) || ((!$enddate) && !!$begindate))?ajax(exit(-2),false):((!$begindate) && (!$enddate))?ajax(exit(0),false):$request;
    // }
    //搜索
    function searchMaterial($request){
        $begindate = $_REQUEST['begindate'];
        // $this->checkDate($begindate);
        $enddate = $_REQUEST['enddate'];
        // $this->checkDate($enddate);
        (!$this->checkDate($begindate) || !$this->checkDate($enddate))?exit(ajax(-3,false)):(((!$begindate) && $enddate) || ((!$enddate) && $begindate))?exit(ajax(-2,false)):((!$begindate) && (!$enddate))?exit(ajax(0,false)):
        objectHandler([$begindate,$enddate],function($searchInfo){
            $dbh = new MySqlDb(Config);
            $sql = "select * from materials m left join material_type mt on m.type_id = mt.id where create_time between '$searchInfo[0]' and '$searchInfo[1]'";
            //echo $sql;
            ajax($dbh->getAll($sql),true);
        });
    }

    function showTree(){
        $dbh = new MySqlDb(Config);
        $sql = "select distinct name as type,row_number() over(order by type)as type_id,-1 as parentId ,0 as isMenu from material_type;";
        objectHandler($dbh->getAll($sql),function($parent)use($dbh){
            $sql = "select m.id,m.name,m.spec,m.number,m.producer,m.price,m.create_time,m.update_time,m.status,mt.name as type ,row_number() over(order by type) as type_id ,1 as isMenu ,(select types_id from (select distinct name as types,row_number() over(order by types) as types_id from material_type) as parent where type=parent.types) as parentId from materials m left join material_type mt on m.type_id = mt.id";
            $children = $dbh->getAll($sql);
            statusReplace($children,[1=>'正常',-1=>'删除']);
            ajax(array_merge($parent,$children),true);
        });

    }
}