<?php
namespace app\service;

//require_once "../model/User.php";
require_once "../utils/redefine.php";

class UserService{
    function loginService($user){
        $user->setLoginfo($_REQUEST);
        $user->userLogin($user);
        $user->updateUserLoginInfo($user);
    }
    function showService($user){
        $user->showAllUserInfo();
    }
    function storeService($user){
        $user->setStoreUserInfo($_REQUEST);
        $user->storeUser($user->isExist());
    }
    function updateService($user){
        $user->setUpdateUserInfo($_REQUEST);
        $user->updateUser();
    }
    function destroyService($user){
        $user->setDestroyUserInfo($_REQUEST);
        $user->destroyUser();
    }
    function logoutService($user){
        $user->userLogout();
    }
}

?>