<?php
header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$create_user_name = $_SESSION['username'];
$sql = "select name from adusers where name = '$username'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
if($row[0] == $username){
    echo json_encode(array("status"=>0));
}else{
    $sql = "insert into adusers(name,pwd,create_user_name) 
        values('$username','$password','$create_user_name')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo json_encode(array("status"=>1));
    }else{
        echo json_encode(array("status"=>-1));
    }
}
?>