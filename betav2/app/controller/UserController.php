<?php
namespace app\controller;

use app\model\User;
use app\service\UserService;

use function app\utils\objectHandler;

require_once "../model/User.php";
require_once "../service/UserService.php";
require_once "../utils/redefine.php";

objectHandler(new UserService(),function($userService){
    switch($_REQUEST['action']){
        case 'User:Login': $userService->loginService(new User());break;
        case 'User:Show' : $userService->showService(new User());break;
        case 'User:Store': $userService->storeService(new User());break;
        case 'User:Update': $userService->updateService(new User());break;
        case 'User:Destroy': $userService->destroyService(new User());break;
        case 'User:Logout': $userService->logoutService(new User());break;
    }
});