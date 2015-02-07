<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<td>机构名称</td>
			<td><input name="comcode" class="easyui-validatebox"  readonly></input></td>
			<td>使用性质</td>
			<td><input name="carkindcode" class="easyui-validatebox" ></input></td>
			<td>车型</td>
			<td><input name="brandname" class="easyui-validatebox"  readonly></input></td>
		</tr>
		<tr>
			<td>客户代码</td>
			<td><input name="tbinsuredcode" class="easyui-validatebox"  readonly></input></td>
			<td>发动机号码</td>
			<td><input name="engineno" class="easyui-validatebox" ></input></td>
			<td>车架号</td>
			<td><input name="vinno" class="easyui-validatebox"  readonly></input></td>
		</tr>
		<tr>
			<td>身份证号码</td>
			<td><input name="tbidnumber" class="easyui-validatebox"  readonly></input></td>
			<td>终保日期</td>
			<td><input name="enddate" class="easyui-validatebox"  readonly></input></td>
			<td>有效号码</td>
			<td><select name="phoneflag" class="easyui-validatebox">
  			<option value="0">初始</option>
  			<option value="1">CIF有效</option>
  			<option value="2">理赔</option>
  			<option value="3">匹配电话1</option>
  			<option value="4">全无效</option>
			</select></td>
		</tr>
		<!-- 
		<tr>
			<td rowspan=3>跟进状态</td>
		<td>
			初始状态:<input type="radio"  name="Sex" value="male" class="easyui-validatebox" />
			首次跟踪:<input type="radio"  name="Sex" value="male" class="easyui-validatebox" />
		</td>
		<td rowspan=3>备注</td>
		<td rowspan=3 colspan=3><input name="tbidnumber" class="easyui-validatebox"  readonly></input></td>
		</tr>
		<tr>
		<td>
			二次跟踪:<input type="radio"  name="Sex" value="male" class="easyui-validatebox"/>
			三次成功:<input type="radio"  name="Sex" value="male" class="easyui-validatebox"/>
		</td>	
		</tr>
		<td>
			跟踪成功:<input type="radio"  name="Sex" value="male" class="easyui-validatebox"/>
			跟踪失败:<input type="radio" name="Sex" value="female" class="easyui-validatebox"/>
		</td>
		-->	
		<tr>
			<td>跟进状态</td>
			<td>
				<input class="easyui-combobox" name='jinduflag' data-options="
		valueField: 'value',
		textField: 'label',
		data: [{
			label: '首次跟踪',
			value: 'f'
		},{
			label: '二次跟踪',
			value: 's'
		},{
			label: '三次跟踪',
			value: 't'
		},{
			label: '续保成功',
			value: 'S'
		},{
			label: '跟踪失败',
			value: 'F'
		}]" />
			</td>
			<td>备注</td>
		<td colspan=3><input name="remark" style = "width: 95%;" ></input></td>
	</tr>
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>

