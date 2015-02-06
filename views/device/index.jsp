<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<!--
    <link rel="stylesheet" href="/easyui-dms/easyui/themes/default/easyui.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/easyui-dms/easyui/themes/icon.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/easyui-dms/css/main.css" type="text/css" media="screen" />
    <script src="/easyui-dms/easyui/jquery-1.3.2.min.js"></script>
    <script src="/easyui-dms/easyui/jquery.easyui.min.js"></script>
-->

<link rel="stylesheet" type="text/css" media="screen" href="http://127.0.0.1/xubao_manage/jeasyui/themes/default/easyui.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/xubao_manage/jeasyui/themes/icon.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/xubao_manage/jeasyui/themes/demo.css" media="screen" />
	<script type="text/javascript" src="http://127.0.0.1/xubao_manage/jeasyui/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="http://127.0.0.1/xubao_manage/jeasyui/js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://127.0.0.1/xubao_manage/jeasyui/js/datagrid-detailview.js"></script>
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/xubao_manage/css/main.css">
	<script>
		$(function(){
			$('#tt').datagrid({
				url:'/easyui-dms/device/getDevices',
				pagination:true,
				toolbar:[{
					text:'新增',
					iconCls:'icon-add'
				},'-',{
					text:'修改'
				},'-',{
					text:'删除',
					iconCls:'icon-remove'
				},'-',{
					text:'查询',
					iconCls:'icon-search'
				}]
			});
		});
		function areaName(value,record){
			return '<i>'+record.area.name+'</i>';
		}
	</script>
</head>
<body class="easyui-layout">
<div region="center" style="padding:5px;" border="false">
	<table id="tt" fit="true">
		<thead>
			<tr>
				<th field="code" width="60">编号</th>
				<th field="name" width="100">名称</th>
				<th field="style" width="100">型号规格</th>
				<th field="area.name" width="80" formatter="areaName">区域</th>
				<th field="manufacturer" width="100">生产厂家</th>
				<th field="factoryCode" width="100">出厂编号</th>
				<th field="country" width="60">生产国别</th>
				<th field="productionDate" width="80">生产日期</th>
				<th field="purchaseDate" width="80">购买日期</th>
			</tr>
		</thead>
	</table>
</div>
</body>
</html>