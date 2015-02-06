<?php
if(!defined('IN_SYS')) { 
exit("禁止访问2333333"); 
} 
$conn = @mysql_connect('localhost','root','root');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('test', $conn);
//mysql_query("set character set 'UTF8'");//读库 
mysql_query("set names 'UTF8'");//写库 
?>