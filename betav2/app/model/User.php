<?php
namespace app\model;

use app\database\MySqlDb;

use function app\utils\ajax;
use function app\utils\arrayToString;
use function app\utils\objectHandler;
use function app\utils\statusReplace;
use function app\utils\statusResponse;

require_once "../utils/redefine.php";
require_once "../database/MysqlDb.php";
require_once "../../conf/config.php";
define('Config',$config);
//$dbh = new MySqlDb(Config);
Class User{
    private $id;
    private $username;
    private $password;
    private $createTime;
    private $updateTime;
    private $createUserName;
    private $loginCount;
    private $lastLoginTime;
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
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Get the value of updateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set the value of updateTime
     *
     * @return  self
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get the value of createUserName
     */
    public function getCreateUserName()
    {
        return $this->createUserName;
    }

    /**
     * Set the value of createUserName
     *
     * @return  self
     */
    public function setCreateUserName($createUserName)
    {
        $this->createUserName = $createUserName;

        return $this;
    }

    /**
     * Get the value of loginCount
     */
    public function getLoginCount()
    {
        return $this->loginCount;
    }

    /**
     * Set the value of loginCount
     *
     * @return  self
     */
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;

        return $this;
    }

    /**
     * Get the value of lastLoginTime
     */
    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
    }

    /**
     * Set the value of lastLoginTime
     *
     * @return  self
     */
    public function setLastLoginTime($lastLoginTime)
    {
        $this->lastLoginTime = $lastLoginTime;

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

    function setLogUserInfo($request){
        $this->setUsername($request['username']);
        $this->setPassword($request['password']);
    }

    function setStoreUserInfo($request){
        $this->setUsername($request['username']);
        $this->setPassword($request['password']);
    }

    function setUpdateUserInfo($request){
        $this->setId($request['id']);
        $this->setUsername($request['username']);
        $this->setPassword($request['password']);
        $this->setStatus($request['status']=='正常'?"1":"-1");
    }

    function setDestroyUserInfo($request){
        $this->setId($request['ids']);
    }

    function setLoginfo($request){
        if($request['vcode'] != $_SESSION['vcode']){
            ajax('vcodeError',false);
            exit;
        }else{
            $this->setLogUserInfo($request);
        }

    }

    
    //用户登录
    function userLogin($user){
        $dbh = new MySqlDb(Config);
        $sql = "select * from adusers where name = '".$user->getUsername()."' and pwd = '".$user->getPassword()."'";
        objectHandler($dbh->getOne($sql),function($query){
            objectHandler(!!$query?$query['status']:exit(ajax(0,false)),function($status)use($query){
                $this->setLoginCount($query['login_count']);
                $this->setId($query['id']);
                //$this->setLastLoginTime($query[0]['last_login_time']);
                $this->setStatus($status);
                $_SESSION['username'] = $this->getUsername();
                ajax($this->getStatus(),false);
            });
        });
    }

    //更新用户登录信息
    function updateUserLoginInfo($user){
        //$loginCount = $user->getLoginCount();
        objectHandler([$user->getLoginCount(),$user->getId()],function($loginInfo){
            $dbh = new MysqlDb(Config);
            $sql = "update adusers set login_count = '".++$loginInfo[0]."',last_login_time = current_timestamp() where status = 1 and id = '".$loginInfo[1]."'";
            $dbh->exec($sql);
        });
    }

    //展示所有用户信息
    function showAllUserInfo(){
        $dbh = new MySqlDb(Config);
        $sql = "select * from adusers";
        objectHandler($dbh->getAll($sql),function($query){
            statusReplace($query,["1"=>"正常","-1"=>"禁用"]);
            ajax($query,true);
        });
    }


    //检查用户名是否存在
    function isExist(){
        $dbh = new MySqlDb(Config);
        $username = $this->getUsername();
        $sql = "select name from adusers where name = '$username'";
        return $dbh->getOne($sql);
    }

    //新增用户
    function storeUser($isExist){
        !!$isExist?exit(ajax(0,false)):objectHandler([$this->getUsername(),$this->getPassword(),isset($_SESSION['username'])?$_SESSION['username']:exit(ajax(-2,false))],function($userinfo){
            $dbh = new MySqlDb(Config);
            $sql = "insert into adusers(name,pwd,create_user_name) values(".arrayToString($userinfo).")";
            statusResponse($dbh->exec($sql));
        });
    }

    //修改用户信息
    function updateUser(){
        objectHandler([$this->getUsername(),$this->getPassword(),$this->getStatus(),$this->getId()],function($updateInfo){
            $dbh = new MySqlDb(Config);
            $sql = "update adusers set name = '$updateInfo[0]',pwd = '$updateInfo[1]',update_time = current_timestamp(),status = '$updateInfo[2]' where id = '$updateInfo[3]'";
            statusResponse($dbh->exec($sql));
        });     
    }

    //删除用户
    function destroyUser(){
        objectHandler(implode(",",$this->getId()),function($deleteinfo){
            $dbh = new MySqlDb(Config);
            $sql = "delete from adusers where id in(".$deleteinfo.")";
            statusResponse($dbh->exec($sql));
        });
    }

    function userLogout(){
        if(isset($_SESSION['username'])){
            unset($_SESSION['username']);
            exit(ajax(0,false));
        }else{
            exit(ajax(-1,false));
        }
    }
}