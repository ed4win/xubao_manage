<?php
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
$username = $_POST['username'];
$password = $_POST['password'];
$comcode = $_POST['comcode'];
//注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 6){
	exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($comcode) <> 6){
	exit('错误：归属机构长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
//if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $comcode)){
//	exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
//}
define('IN_SYS', TRUE);
//包含数据库连接文件
include('../conn.php');
//检测用户名是否已经存在
$check_query = mysql_query("select userid from user where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
	echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
	exit;
}
//写入数据
$password = MD5($password);
include('../checkip.php');
$IP = getip();
echo $IP;
$sql = "INSERT INTO user(username,password,comcode,ip)VALUES('$username','$password','$comcode','$IP')";
if(mysql_query($sql,$conn)){
//echo $sql, '<br />';
	exit('用户注册成功！点击此处 <a href="login.html">登录</a>');
} else {
	echo '抱歉！添加数据失败：',mysql_error(),'<br />';
    //echo $sql, '<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>
