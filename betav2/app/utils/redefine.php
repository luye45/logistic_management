<?php
namespace app\utils;
session_start();

define('RESPONSE_STATUS',array(true=>"1",false=>"-1"));//成功1，失败-1
function statusResponse($query){
    ajax(RESPONSE_STATUS[!!$query],true);
}
function arrayToString($arrs){
    foreach($arrs as &$arr){
        $arr = "'$arr'";
    }
    $str = implode(',',$arrs);
    return $str;
}
function objectHandler($object,$func){
    $func($object);
}
function ajax($Json,$isArray){
    echo $isArray?json_encode($Json):json_encode(array($Json));
}
function checkObject($object){
    return !!$object;
}
function statusReplace(&$oldArr,$repArr){
    foreach($oldArr as &$arr){
        $arr['status'] = $repArr[$arr['status']];
    }
}
function checkLogin(){
    if(isset($_REQUEST['action'])){
        if($_REQUEST['action']!='User:Login'){
            if(!isset($_SESSION['username'])){
                exit(ajax(-2,false));
            }   
        }
    }
}