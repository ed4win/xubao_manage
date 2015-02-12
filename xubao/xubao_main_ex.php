<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
	//header("Location:login.html");
	exit();
}
define('IN_SYS', TRUE);
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	//mysql_query("SET NAMES utf-8");
	include ('../conn/conn.php');
	//mysql_real_escape_string() 防止依赖注入,但是要考虑连接的当前字符集
	$engineno = isset($_POST['engineno']) ? mysql_real_escape_string($_POST['engineno']) : '123abcefg456';
	$licenseno = isset($_POST['licenseno']) ? mysql_real_escape_string($_POST['licenseno']) : '123abc456efg';
	if($engineno == null && $licenseno == null){
		exit();
	}
	if($engineno == '' && $licenseno == ''){
		exit();
	}
	$str_licen = strlen($licenseno);
	$str_eng = strlen($engineno);
	if($str_licen==12 && $str_eng==12){
		exit();
	}
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$usercode = $_SESSION['usercode'];
	$user_com = $_SESSION['comcode'];
	$searchtime = date('Y-m-d H:i:s');
	$keyword = '';

	/*
	$com_query = mysql_query("select comcode from user where userid=$userid limit 1");
	$com = mysql_fetch_row($com_query);
	//echo 'bug1',$com[0];
	$user_com = $com[0];
	*/
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	$where = '';
	$tbflag ='and tbflag = "1" and  xbflag = "0" ' ;

	/*
	//判断查询关键字,优先保存车牌号,放弃
	if($str_licen==0){
		$keyword .=  $engineno;
	}
	else if($str_eng==0){
		$keyword .= $licenseno;
	}else//(strlen($licenseno) >0 &&　strlen($engineno)>0)
	{
		$keyword .= $licenseno;
	}
	*/

	//$engineno_utf = iconv('gb2312', 'utf-8',$engineno);
	//$licenseno_utf = iconv('gb2312', 'utf-8',$licenseno);
    if($user_com <>'441800')
   {
	if($str_licen==0){
		$where .=  "engineno = '$engineno' and     substr(comcode,1,6) = '$user_com'";
	}
	else if($str_eng==0){
		$where .= " licenseno = '$licenseno'   and     substr(comcode,1,6) = '$user_com' ";
	}else//(strlen($licenseno) >0 &&　strlen($engineno)>0)
	{
		$where .= "engineno = '$engineno' and licenseno = '$licenseno'   and     substr(comcode,1,6) = '$user_com' ";
	}
}else{

    if($str_licen==0){
		$where .=  "engineno = '$engineno'  ";
	}
	else if($str_eng==0){
		$where .= " licenseno = '$licenseno'    ";
	}else//(strlen($licenseno) >0 &&　strlen($engineno)>0)
	{
		$where .= "engineno = '$engineno' and licenseno = '$licenseno'    ";
	}
}
	//echo 'BUGBANG!',$where,'STR:',$str_eng,'--STR2:',$str_licen;
	  
	//$rs = mysql_query("select count(1) from xubaomain_ex where " . $where . $tbflag)
	//or die("无效查询: " . mysql_error());
	$rs = $dbh->query("select count(1) from xubaomain_ex where " . $where . $tbflag)
	or die("无效查询: " . $rs->errorInfo());
	//echo 'select ',$rs;
	//$row = mysql_fetch_row($rs);
	$row = $rs->fetch(PDO::FETCH_NUM);
	if($row[0] >= 1)//仅记录有效查询,主要原因系统加载时时会会插入一条无效的记录.
		{
			$searchSQL = "INSERT INTO operatesearchhistory(usercode,username,usercomcode,engineno,licenseno,searchtime) VALUES ('$usercode','$username','$user_com','$engineno','$licenseno','$searchtime') ";
			//mysql_query($searchSQL,$conn);
			$dbh->exec($searchSQL);
		}
	$result["total"] = $row[0];
	
	//$rs = mysql_query("select * from xubaomain_ex where " . $where . $tbflag . " limit $offset,$rows");
	$rs = $dbh->query("select * from xubaomain_ex where " . $where . $tbflag . " limit $offset,$rows");
	$items = array();
	//while($row = mysql_fetch_object($rs)){
	while($row = $rs->fetchobject()){
		array_push($items, $row);
	}
$result["rows"] = $items;
	$dbh=null;
	echo json_encode($result);
?>