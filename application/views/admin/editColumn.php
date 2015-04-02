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
				<input type="hidden" id="column_id" value="<?php echo $currentColumn->column_id;?>">
				<span class="label" style="width:120px;">上一级栏目：</span>
				<select class="select" id="fatherlevel" style="width: 125px;">
					<option value="0" <?php if($currentColumn->column_fid=="0") echo "selected";?>>顶级栏目</option>
					<?php foreach($columns as $col):?>
					<?php if($currentColumn->column_id!=$col->column_id):?>
					<option value="<?php echo $col->column_id;?>" <?php if($currentColumn->column_fid==$col->column_id) echo "selected";?>><?php echo $col->column_name;?></option>
					<?php foreach($col->subColumns as $subCol):?>
					<option value="<?php echo $subCol->column_id;?>">&nbsp;&nbsp;&nbsp;--&nbsp;<?php echo $subCol->column_name;?></option>
					<?php endforeach;?>
					<?php endif;?>
					<?php endforeach;?>
				</select>
				<span style="color: red;">*</span>
			</div>
			<div class="item" style="margin-top: 10px;">
				<span class="label" style="width:120px;">类型：</span>
				<select class="select" id="type" style="width: 125px;">
					<option value="2" <?php if($currentColumn->column_type=="2") echo "selected";?>>一篇文章</option>
					<option value="0" <?php if($currentColumn->column_type=="0") echo "selected";?>>文章列表</option>
					<option value="4" <?php if($currentColumn->column_type=="4") echo "selected";?>>图片集</option>
					<option value="5" <?php if($currentColumn->column_type=="5") echo "selected";?>>论坛</option>
				</select>
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">是否显示：</span>
				<input type="radio" name="display" value="1" <?php if($currentColumn->column_display=="1") echo "checked";?>>显示
				<input type="radio" name="display" value="2" <?php if($currentColumn->column_display=="2") echo "checked";?>>隐藏
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">排序：</span>
				<input type="text" id="orderNum" class="inp-txt width50" value="<?php echo $currentColumn->column_ordernum;?>">（由低 -> 高）
				<span style="color: red;">*</span>
			</div>
			<div class="item">
				<span class="label" style="width:120px;">名称：</span>
				<input type="text" id="name" class="inp-txt width200" maxlength="30" placeholder="1~10字" value="<?php echo $currentColumn->column_name;?>">
				<span style="color: red;">*</span>
			</div>
		</div>
	</div>
	<div class="btn-center">
		<a onclick="column('modify','请输入名称','恭喜，保存成功')" class="btnfa120">保存</a>
	</div>
</div>