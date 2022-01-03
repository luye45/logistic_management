<?php
header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
$name = $_REQUEST['name'];
$spec = $_REQUEST['spec'];
$number = $_REQUEST['number'];
$price = $_REQUEST['price'];
$type = $_REQUEST['type'];
$producer = $_REQUEST['producer'];
$create_user_name = $_SESSION['username'];
$sql = "select name from materials where name = '$name'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
if($row[0] == $name){
    echo json_encode(array("status"=>0));
}else{
    $sql_typeQuery = "select id from material_type where name = '$type'";
    $type_id_result = mysqli_query($conn,$sql_typeQuery);
    $type_id_row = mysqli_fetch_row($type_id_result);
    $type_id = $type_id_row[0];
    $sql = "insert into materials(name,spec,number,price,producer,create_user_name,type_id) 
        values('$name','$spec','$number','$price','$producer','$create_user_name','$type_id')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo json_encode(array("status"=>1));
    }else{
        echo json_encode(array("status"=>-1));
    }
}
?>