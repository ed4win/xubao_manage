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


/*
PDO 连接方式
*/
$dbms='mysql';     //数据库类型
$host='localhost'; //数据库主机名
$dbName='test';    //使用的数据库
$user='root';      //数据库连接用户名
$pass='root';          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";


try {
    $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
    $dbh->query("set names utf8");
    //echo "连接成功<br/>";
    /*你还可以进行一次搜索操作
    foreach ($dbh->query('SELECT * from FOO') as $row) {
        print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
    }
    */
    //$dbh = null;
} catch (PDOException $e) {
    die ("Connection failed : " . $e->getMessage() . "<br/>");
}

?>