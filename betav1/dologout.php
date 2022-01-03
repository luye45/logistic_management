<?php
$status = $_POST['status'];
if($status == -1){
    setcookie("login_session","islogout", time()+3600*24);
    echo json_encode(array(array('status'=>'logout')));
}
?>