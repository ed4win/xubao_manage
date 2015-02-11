<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
	//header("Location:login.html");
	exit();
}
define('IN_SYS', TRUE);
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
	//mysql_query("SET NAMES utf-8");
	include ('../conn/conn.php');
	//mysql_real_escape_string() 防止依赖注入,但是要考虑连接的当前字符集
	$stdate1 = isset($_POST['stdate']) ? $_POST['stdate'] : '1990-02-08';
	$eddate1 = isset($_POST['eddate']) ? $_POST['eddate'] : '1990-02-11';

	/*
	$com_query = mysql_query("select comcode from user where userid=$userid limit 1");
	$com = mysql_fetch_row($com_query);
	//echo 'bug1',$com[0];
	$user_com = $com[0];
	*/
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	

	

	$rs = $dbh->prepare("CALL operateInfo(?,?)");
	$rs-> bindParam(1,$stdate1,PDO::PARAM_INPUT_OUTPUT,4000);
	$rs-> bindParam(2,$eddate1,PDO::PARAM_INPUT_OUTPUT,4000);
	$rs->execute();
	
	//$row = $rs->fetch(PDO::FETCH_NUM); //返回第一条记录
	$rowcount = $rs->rowCount();
	
	$result["total"] = $rowcount;
	
	//$rs = mysql_query("select * from xubaomain where " . $where . $tbflag . " limit $offset,$rows");
	//$rs = $dbh->query("select * from xubaomain where " . $where . $tbflag . " limit $offset,$rows");
	$items = array();
	//while($row = mysql_fetch_object($rs)){
	while($rowcount>0){
	$row = $rs->fetchobject();
		array_push($items, $row);
		$rowcount --;
	}
$result["rows"] = $items;
	$dbh=null;
	echo json_encode($result);
?>