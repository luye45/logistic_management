<?php
header("content-type:application/x-www-form-urlencoded");
include"conn.php";
$ids = $_REQUEST['ids'];
$ids = implode(',',$ids);
$sql = "delete from adusers where id in(".$ids.")";
$result = mysqli_query($conn,$sql);
if($result){
    echo json_encode(array("status"=>1));
}else{
    echo json_encode(array("status"=>-1));
    }
?>