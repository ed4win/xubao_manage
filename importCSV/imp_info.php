<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])||($_SESSION['power']<>2)){
	//header("Location:user_reg/login.html");
	//exit();
	echo  '$("#userinfo").append("<span><input id = \"hidden\" type = \"hidden\"  value=\"0\"></input></span>.");';
}
else{
define('IN_SYS', TRUE);
//包含数据库连接文件
include('../conn.php');
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$user_query = mysql_query("select * from user where userid=$userid limit 1");
$row = mysql_fetch_array($user_query);
include('../checkip.php');
$IP = getip();
//echo 'document.write("用户信息:';
//echo '用户ID:',$userid,'");';
//echo '用户名：',$username,',';
//关键结尾:'");'
//echo '邮箱：',$row['comcode'],'<span/>';
//echo '注册日期：',date("Y-m-d", $row['regdate']),'<span/>';
//echo '<a href=\"user_reg/login.php?action=logout\">注销</a> 登录<span/>','");' ;
//$login = '0';
//if(!isset($_SESSION['userid'])){ $login = '1';}
//echo '<input id = "hidden" type = ""  value="',$login,'" />';

//jquery 输出
echo  '$("#userinfo").append(" <span>欢迎你,&nbsp;',$username,'&nbsp;你的归属机构:&nbsp;',$row['comcode'];
echo  '&nbsp,你目前的IP地址:',$IP;
echo   '&nbsp;,<a href=\"user_reg/login.php?action=logout\">注销</a> 登录<span/><span><input id = \"hidden\" type = \"hidden\"  value=\"1\"></input></span>.");';
}
?>