<?php

use function app\utils\ajax;

require_once "../utils/redefine.php";

if(!isset($_SESSION['username'])){
    exit(ajax(-2,false));
}else{
    ajax(array('username'=>$_SESSION['username']),true);
    //exit(ajax(0,false));
}