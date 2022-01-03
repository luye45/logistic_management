<?php
header("content-type:application/x-www-form-urlencoded");
include"conn.php";
$sql = "select * from adusers";
$result = mysqli_query($conn,$sql);
$arrays = array();
$rows = mysqli_fetch_all($result);
        foreach($rows as $row){
                $row[8]=$row[8]==1?'正常':'禁用';
                array_push($arrays,array(
                'id'=>$row[0],
                'name'=>$row[1],
                'pwd'=>$row[2],
                'create_time'=>$row[3],
                'update_time'=>$row[4],
                'create_user_name'=>$row[5],
                'login_count'=>$row[6],
                'last_login_time'=>$row[7],
                'status'=>$row[8]));
        }       
echo json_encode($arrays);
?>