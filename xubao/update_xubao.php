<?php
session_start();
//$id = intval($_REQUEST['id']);
$proposalno = $_REQUEST['proposalno'];
$phoneflag = $_REQUEST['phoneflag'];
$jinduflag = $_REQUEST['jinduflag'];
$remark = $_REQUEST['remark'];
//$carkind = $_REQUEST['carkind'];
//echo $phoneflag;
//$listprice = $_REQUEST['listprice'];
//$unitcost = $_REQUEST['unitcost'];
//$attr1 = $_REQUEST['attr1'];
//$status = $_REQUEST['status'];


$username = $_SESSION['username'];
$usercode = $_SESSION['usercode'];
$user_com = $_SESSION['comcode'];
$updatetime = date('Y-m-d H:i:s');

define('IN_SYS', TRUE);
include ('../conn/conn.php');

$sql = "UPDATE xubaomain set phoneflag ='$phoneflag',jinduflag = '$jinduflag' ,remark = '$remark' ,updatetime  = now() where proposalno='$proposalno'";
$updatesql = "INSERT INTO operateUpdatehistory(usercode,username,usercomcode,update_proposalno,updatetime) values ('$usercode','$username','$user_com','$proposalno','$updatetime')";
//$updatesql = "INSERT INTO operateUpdatehistory(usercode)VALUES('1111')";
//echo $updatesql;
//@mysql_query($sql);
$dbh->exec($sql);
//mysql_query($updatesql,$conn);
$dbh->exec($updatesql);
$dbh = null;
//if (!$check_query) { // add this check.
//    die('Invalid query: ' . mysql_error());
//}
echo json_encode(array(
	//'itemid' => $itemid,
	//'productid' => $productid,
	//'listprice' => $listprice,
	//'unitcost' => $unitcost,
	//'attr1' => $attr1,
    //'status' => $status
	//回写phoneflag 标志
    'phoneflag' => $phoneflag,
    'jinduflag' => $jinduflag,
    'remark' => $remark
));
?>