<?php
if(!isset($_POST['submit'])){
	exit('�Ƿ�����!');
}
$username = $_POST['username'];
$password = $_POST['password'];
$comcode = $_POST['comcode'];
//ע����Ϣ�ж�
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('�����û��������Ϲ涨��<a href="javascript:history.back(-1);">����</a>');
}
if(strlen($password) < 6){
	exit('�������볤�Ȳ����Ϲ涨��<a href="javascript:history.back(-1);">����</a>');
}
if(strlen($comcode) <> 6){
	exit('���󣺹����������Ȳ����Ϲ涨��<a href="javascript:history.back(-1);">����</a>');
}
//if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $comcode)){
//	exit('���󣺵��������ʽ����<a href="javascript:history.back(-1);">����</a>');
//}
define('IN_SYS', TRUE);
//�������ݿ������ļ�
include('../conn.php');
//����û����Ƿ��Ѿ�����
$check_query = mysql_query("select userid from user where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
	echo '�����û��� ',$username,' �Ѵ��ڡ�<a href="javascript:history.back(-1);">����</a>';
	exit;
}
//д������
$password = MD5($password);
include('../checkip.php');
$IP = getip();
echo $IP;
$sql = "INSERT INTO user(username,password,comcode,ip)VALUES('$username','$password','$comcode','$IP')";
if(mysql_query($sql,$conn)){
//echo $sql, '<br />';
	exit('�û�ע��ɹ�������˴� <a href="login.html">��¼</a>');
} else {
	echo '��Ǹ���������ʧ�ܣ�',mysql_error(),'<br />';
    //echo $sql, '<br />';
	echo '����˴� <a href="javascript:history.back(-1);">����</a> ����';
}
?>
