<?php
header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
$id = $_REQUEST['id'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$status = $_REQUEST['status'];
$status = $status=='正常'?1:-1;
$update_time = 'current_timestamp()';
$sql = "update adusers set name = '$username',pwd = '$password',update_time = current_timestamp(),status = '$status' where id = '$id'";
$result = mysqli_query($conn,$sql);
if($result){
    echo json_encode(array("status"=>1));
}else{
    echo json_encode(array("status"=>-1));
}
?>