<?php
 define('IN_SYS', TRUE);
session_start();

//ע����¼
if(isset($_GET['action'])){
    if($_GET['action'] == "logout"){
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['power']);
        echo 'ע����¼�ɹ�������˴� <a href="login.html">��¼</a>';
        exit;
    }
}

//��¼
if(!isset($_POST['submit'])){
	exit('�Ƿ�����!');
}
$username = htmlspecialchars($_POST['username']);
$pass= ($_POST['password']);
$password = MD5($_POST['password']);
include('../conn/checkip.php');
$currentIP = getip();
//echo $pass;
//�������ݿ������ļ�
include('../conn/conn.php');
//����û����������Ƿ���ȷ
$check_query = mysql_query("select userid,power from user where username='$username' and password='$password'and ip = '$currentIP' limit 1");
if (!$check_query) { // add this check.
    die('Invalid query2: ' . mysql_error());
}
if($result = mysql_fetch_array($check_query)){
	//��¼�ɹ�
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $result['userid'];
    $_SESSION['power'] = $result['power'];
	//echo $username,' ��ӭ�㣡���� <a href="my.php">�û�����</a><br />';
	//echo '����˴� <a href="login.php?action=logout">ע��</a> ��¼��<br />';
$url = '';
if($result['power'] == 1){
    $url = "../index.html";  //Ҫע����ת·��
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";  
    echo "</script>";
	exit;
    } 
elseif ($result['power'] == 2){
    $url = "../index.html";  //Ҫע����ת·��
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";  
    echo "</script>";
    exit;
    } 
}else {
    //echo $check_query;
    echo 'ip',$currentIP;
	exit('��¼ʧ�ܣ�����˴� <a href="javascript:history.back(-1);">����</a> ����');
}
?>