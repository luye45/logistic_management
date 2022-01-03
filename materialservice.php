<?php
header("content-type:application/x-www-form-urlencoded");
include"conn.php";
$sql = "select * from materials m left join material_type mt on m.type_id = mt.id";
$result = mysqli_query($conn,$sql);
$arrays = array();
$rows = mysqli_fetch_all($result);
foreach($rows as $row){
        $row[10]=$row[10]==1?'正常':'删除';
        array_push($arrays,array(
        'id'=>$row[0],
        'name'=>$row[1],
        'spec'=>$row[2],
        'number'=>$row[3],
        'price'=>$row[4],
        'type'=>$row[12],
        'producer'=>$row[6],
        'create_time'=>$row[7],
        'update_time'=>$row[8],
        'create_user_name'=>$row[9],
        'status'=>$row[10]));
}       
echo json_encode($arrays);
?>