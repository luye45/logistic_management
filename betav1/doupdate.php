<?php 
include "conn.php";
$num=$_POST['txtnumber'];
$price=$_POST['txtprice']; 
$name=$_POST['txtname']; 
$gz=$_POST['txtspec']; 
$sccs=$_POST['txtproducer']; 
$id=$_GET['id']; 
$update=mysqli_query($conn,"update materials set name ='$name',spec='$gz',number='$num',price ='$price',producer='$sccs' where id=$id");
if($update){
  echo"<script>alert('修改成功！');window.location.href='index.php'</script>";
 }
else
{
  echo"<script>alert('修改失败！');window.location.href='index.php? </script>";
 }
?>