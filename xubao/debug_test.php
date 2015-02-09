<?php
define('IN_SYS', TRUE);
session_start();
include('../conn/checkip.php');
$currentIP = getip();
$logintime = date('Y-m-d H:i:s');
//echo $pass;
//包含数据库连接文件
include('../conn/conn.php');
//检测用户名及密码是否正确
//$check_query = mysql_query("select userid,power,usercname,comcode from user where username='$username' and password='$password'and ip = '$currentIP' limit 1");
$check_query = $dbh->query("select userid,power,usercname,comcode from user where username='picc4418' and password='picc4418' limit 1");
if (!$check_query) { // add this check.
    //die('Invalid query: ' . mysql_error());
    die('Invalid query: '. $dbh->errorCode());
}
echo 'startDebug';
//if($result = mysql_fetch_array($check_query)){
if($result = $check_query->fetch()){
    $result = var_dump($result);
	echo 'result',$result;
	//登录成功
	$_SESSION['username'] = $result['usercname'];
    $_SESSION['usercode'] = $username;
    $_SESSION['comcode'] = $result['comcode'];
	$_SESSION['userid'] = $result['userid'];
    $_SESSION['power'] = $result['power'];
/*
记录登录信息
*/
    $sql = "INSERT INTO loginHistory(username,logintime,loginstatus,ip)VALUES('$username','$logintime','1','$currentIP')";
    $dbh->exec($sql);
    $dbh = null;
}
?>