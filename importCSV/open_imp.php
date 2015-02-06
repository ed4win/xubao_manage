<?php

/**
 * @
 * @Description:
 * @Copyright (C) 2011 helloweba.com,All Rights Reserved.
 * -----------------------------------------------------------------------------
 * @author: Liurenfei (lrfbeyond@163.com)
 * @Create: 2012-5-1
 * @Modify:
*/
define('IN_SYS', TRUE);
include_once ("../conn/conn.php");

$action = $_GET['action'];
if ($action == 'import') { //导入CSV
	$filename = $_FILES['file']['tmp_name'];
	if (empty ($filename)) {
		echo '请选择要导入的CSV文件！';
		exit;
	}
	$handle = fopen($filename, 'r');
	$result = input_csv($handle); //解析csv
	$len_result = count($result);
	if($len_result==0){
		echo '没有任何数据！';
		exit;
	}
    $data_values = "";//定义$data_values
	for ($i = 1; $i < $len_result; $i++) { //循环获取各字段值
		$proposalno = iconv('gb2312', 'utf-8', $result[$i][0]); //中文转码
		$insertdatetime = date('Y-m-d H:i:s');
		$data_values .= "('$proposalno','$insertdatetime'),";//累积，拼接字符串
	}
	$data_values = substr($data_values,0,-1); //去掉最后一个逗号
	fclose($handle); //关闭指针
	$query = mysql_query("replace into openImp (proposalno,insertdatetime) values $data_values");//批量插入数据表中
	if($query){
		echo '导入成功！';
		echo '<a href="javascript:history.back(-1);">返回</a>'; 
	}else{
		echo '导入失败！';
		printf($data_values);
	}
} elseif ($action=='export') { //导出CSV
    $result = mysql_query("select * from student");
    $str = "姓名,性别,年龄\n";
    $str = iconv('utf-8','gb2312',$str);
    while($row=mysql_fetch_array($result)){
        $name = iconv('utf-8','gb2312',$row['name']);
        $sex = iconv('utf-8','gb2312',$row['sex']);
    	$str .= $name.",".$sex.",".$row['age']."\n";
    }
    $filename = date('Ymd').'.csv';
    export_csv($filename,$str);
}
function input_csv($handle) {
	$out = array ();
	$n = 0;
	while ($data = fgetcsv($handle, 10000)) {
		$num = count($data);
		for ($i = 0; $i < $num; $i++) {
			$out[$n][$i] = $data[$i];
		}
		$n++;
	}
	return $out;
}

function export_csv($filename,$data) {
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}
?>
