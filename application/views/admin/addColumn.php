<div class="padding10 formList clearfix">
	<div class="titA tit-bot pb5" style="">
		<div style="float: right;margin-left:10px;">
			<a href="/admin/columnList" class="msg-btn">返回栏目列表</a>
		</div>
		<div class="clear">
		</div>
	</div>
	<div class="partContent baseInfo">
		<div class="title">
			栏目信息
		</div>
		<div>
			<div class="item" style="margin-top: 10px;">
				<span class="label" style="width:120px;">上一级栏目：</span>
				<select class="select" id="fatherlevel" style="width: 125px;">
					<option value="0">顶级栏目</option>
					<?php foreach($columns as $col):?>
					<option value="<?php echo $col->column_id;?>"><?php echo $col->column_name;?></option>
					<?php foreach($col->subColumns as $subCol):?>
					<option value="<?php echo $subCol->column_id;?>">&nbsp;&nbsp;&nbsp;--&nbsp;<?php echo $subCol->column_name;?></option>
					<?php endforeach;?>
					<?php endforeach;?>
				</select>
				<span style="color: red;">*</span>
			</div>
			<div class="item" style="margin-top: 10px;">
				<span class="label" style="width:120px;">类型：</span>
				<select class="select" id="type" style="width: 125px;">
					<option value="2">一篇文章</option>
					<option value="0" selected>文章列表</option>
					<option value="4">图片集</option>
					<option value="5">论坛</option>
				</select>
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">是否显示：</span>
				<input type="radio" name="display" value="1" checked>显示
				<input type="radio" name="display" value="2">隐藏
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">排序：</span>
				<input type="text" id="orderNum" class="inp-txt width50" value="50">（由低 -> 高）
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">名称：</span>
				<input type="text" id="name" class="inp-txt width200" maxlength="30" placeholder="1~10字">
				<span style="color: red;">*</span>
			</div>
		</div>
	</div>
	<div class="btn-center">
		<a onclick="column('add','请输入名称','恭喜，添加成功')" class="btnfa120">添加</a>
	</div>
</div>