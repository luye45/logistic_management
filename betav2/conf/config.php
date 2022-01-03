<?php 
namespace conf;
/*
说明 : 本文件是全局的配置文件,全局的配置可以在这里使用

*/
$config=array(
	// 是否关闭报错
	"error"			   =>		true,		 // false 为不关闭 , true为关闭 注意:不支持语法等致命错误 : Fatal error

	// 网站根目录
	"res"			   =>		"views",		 //资源文件夹名字

	// 数据库的配置
	"host"             =>       "127.0.0.1", //数据库地址
	"dbname"           =>       "materials",		 //数据库名称
	"username"             =>   "root",	 	 //用户名
	"password"         =>       "123456",		 //密码
	"charset"          =>       "utf8",		 //数据库编码
	"port"     		   =>       "3306",		 //连接端口

	//设置时区
	"timezone"		   =>		"+8:00", 
)
?>