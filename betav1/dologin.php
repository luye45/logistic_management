<?php
session_start();
//header("content-type:application/x-www-form-urlencoded");
include"conn.php";
$_SESSION['username'] = $_POST['uname'];;
$name = $_POST['uname'];
$pwd = $_POST['pwd'];
$vcode = $_POST['vcode'];
$arrays = array(array('userinfo'=>'unameOrPwdError','captcha'=>'vcodeError','status'=>'-1'));
$result = mysqli_query($conn,"select * from adusers where name = '$name' and pwd = '$pwd'");
$row = mysqli_fetch_row($result);
$total = mysqli_num_rows($result);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
if($vcode != $_SESSION['vcode']){
    echo json_encode($arrays[0]['captcha']);//验证码不正确返回vcodeError
}else if($total == 0){
    echo json_encode($arrays[0]['userinfo']);//用户名或密码不正确返回unameOrPwdError
}else if($row[8] == -1){
    echo json_encode($arrays[0]['status']);
}else{
    $update_sql = "select login_count from adusers where name = '$name' and pwd = '$pwd'";
    $result = mysqli_query($conn,$update_sql);
    $row = mysqli_fetch_row($result);
    $login_count = $row[0];
    $login_count++;
    $update_sql = "update adusers set login_count = '$login_count',last_login_time = current_timestamp() where name = '$name' and pwd = '$pwd'";
    mysqli_query($conn,$update_sql);
    setcookie("login_session","islogin", time()+3600*24);//一天过期的cookie
    echo json_encode(array(array('success'=>'success')));
}
?>