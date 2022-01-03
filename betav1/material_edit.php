<?php
header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$spec = $_REQUEST['spec'];
$number = $_REQUEST['number'];
$price = $_REQUEST['price'];
$type = $_REQUEST['type'];
$sql_typeQuery = "select id from material_type where name = '$type'";
$type_id_result = mysqli_query($conn,$sql_typeQuery);
$type_id_row = mysqli_fetch_row($type_id_result);
$type_id = $type_id_row[0];
$producer = $_REQUEST['producer'];
$status = $_REQUEST['status'];
$status = $status=='正常'?1:-1;
$sql = "update materials set name = '$name',spec= '$spec',number = '$number',price='$price',type_id = '$type_id',update_time = current_timestamp(),status = '$status' where id = '$id'";
$result = mysqli_query($conn,$sql);
if($result){
    echo json_encode(array("status"=>1));
}else{
    echo json_encode(array("status"=>-1));
}
?>