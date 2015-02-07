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
	include ('../conn.php');
	//mysql_real_escape_string() 防止依赖注入,但是要考虑连接的当前字符集
	$engineno = isset($_POST['engineno']) ? mysql_real_escape_string($_POST['engineno']) : 'adc3949ba59abbe56';
	$licenseno = isset($_POST['licenseno']) ? mysql_real_escape_string($_POST['licenseno']) : 'adc3949ba59abbe56';
	//echo "tb-2333",$_POST['engineno'],"</br>";
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$com_query = mysql_query("select comcode from user where userid=$userid limit 1");
	$com = mysql_fetch_row($com_query);
	//echo 'bug1',$com[0];
	$user_com = $com[0];


	$offset = ($page-1)*$rows;
	
	$result = array();
	$where = '';
	$tbflag ='and dmflag = "1" and  xbflag = "0" ' ;
	$str_licen = strlen($licenseno);
	$str_tb = strlen($engineno);
	//$engineno_utf = iconv('gb2312', 'utf-8',$engineno);
	//$licenseno_utf = iconv('gb2312', 'utf-8',$licenseno);
    if($user_com <>'441885')
   {
	if($str_licen==0){
		$where .=  "engineno = '$engineno' and     substr(comcode,1,6) = '$user_com'";
	}
	else if($str_tb==0){
		$where .= " licenseno = '$licenseno'   and     substr(comcode,1,6) = '$user_com' ";
	}else//(strlen($licenseno) >0 &&　strlen($engineno)>0)
	{
		$where .= "engineno = '$engineno' and licenseno = '$licenseno'   and     substr(comcode,1,6) = '$user_com' ";
	}
}else{
    if($str_licen==0){
		$where .=  "engineno = '$engineno'  ";
	}
	else if($str_tb==0){
		$where .= " licenseno = '$licenseno'    ";
	}else//(strlen($licenseno) >0 &&　strlen($engineno)>0)
	{
		$where .= "engineno = '$engineno' and licenseno = '$licenseno'    ";
	}
}
	//echo 'BUGBANG!',$where,'STR:',$str_tb,'--STR2:',$str_licen;
	  
	$rs = mysql_query("select count(*) from xubaomain where " . $where . $tbflag)
	or die("无效查询: " . mysql_error());
	//echo 'select ',$rs;
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select * from xubaomain where " . $where . $tbflag . " limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>