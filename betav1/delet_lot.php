<?php 
include"conn.php"; 
$id=implode(",",$_POST["delete"]); 
$delete=mysqli_query($conn,"delete from materials where id in(".$id.")");
if($delete){
    echo"<ѕсrірt>аlеrt('删除成功！');wіndоw.lосаtіоn.href=index.php'</script>";
}else {echo"<script>alert('删除失败！');window.location.href=index.php'</script>"; 
}
 ?>