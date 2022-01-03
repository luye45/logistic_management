<?php
$conn = mysqli_connect("mysql.ftqq.com","root","itworks1343");
//$conn = mysqli_connect("127.0.0.1","root","root");
mysqli_select_db($conn,"materials5120195590");
mysqli_query($conn,"set names utf8");
mysqli_query($conn,"set time_zone='+8:00'");//设置时区
?>