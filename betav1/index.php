<?php
session_start();
if(!($_COOKIE['login_session'] == "islogin")){
    setcookie("login_session","islogout", time()+3600*24);
    header("Location: loginreq.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>物资管理系统</title>
  <link rel="stylesheet" href="../layuis/layui.css">
  <link rel="stylesheet" href="..\font\iconfont.css">
</head>
  <frameset frameborder="0" rows="60,*">
    <frame src="Top.html" noresize="noresize" scrolling="no" />
    <frameset frameborder="0" cols="200,*" style="background-color: aquamarine;">
      <frame src="Navigation.html" noresize="noresize" scrolling="no" />
      <frameset frameborder="0" rows="*,40">
        <frame src="" noresize="noresize" scrolling="yes" name="main"  />
        <frame src="Footer.html" noresize="noresize" scrolling="no" />
      </frameset>
    </frameset>
  </frameset>
</html>


