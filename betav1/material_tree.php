<?php
//header("content-type:application/x-www-form-urlencoded");
session_start();
include"conn.php";
//父级
$sql = "select distinct name from material_type";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_all($result);
$type_array = array();
$i = 0;
foreach($rows as $row){
    array_push($type_array,array(
        "type_id"=>++$i,
        "type"=>$row[0],
        "isMenu"=>0,
        "parentId"=>-1
    ));
}
$sql = "select * from materials m left join material_type mt on m.type_id = mt.id order by mt.name and mt.id";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_all($result);
$arrays = array();
$parentid = -1;
//echo json_encode($type_array);
foreach($rows as $row){
    $row[10]=$row[10]==1?'正常':'删除';
    foreach($type_array as $type){
        if(array_search($row[1],$type)){
            $parentid = $row[11];
        }  
    }
    array_push($arrays,array(
    'type_id'=>++$i,
    'type'=>'',
    'name'=>$row[1],
    'spec'=>$row[2],
    'number'=>$row[3],
    'price'=>$row[4],
    'status'=>$row[10],
    'isMenu'=>1,
    'parentId'=>$parentid));
}
echo json_encode(array_merge($type_array,$arrays));
?>