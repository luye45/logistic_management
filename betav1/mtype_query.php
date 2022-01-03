<?php
header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
$sql = "select name from material_type";
$result = mysqli_query($conn,$sql);
$arrays = array();
$rows = mysqli_fetch_all($result);
foreach($rows as $row){
    array_push($arrays,$row[0]);
}
$arrays = array("list"=>$arrays);
echo json_encode($arrays);
?>
