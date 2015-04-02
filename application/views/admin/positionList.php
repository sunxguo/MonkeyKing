<div class="padding10 contentlist">
	<div id="appDiv" class="titA tit-bot pb5" style="">
		<div class="tabDiv" style="width:500px;">
			<div  onclick="location.href='/admin/webDesign?type=index'" class="left <?php echo $type=='index'?'active':'';?>" style="width:100px;">
				首页主体
			</div>
			<div  onclick="location.href='/admin/webDesign?type=topBar'" class="center <?php echo $type=='topBar'?'active':'';?>" style="width:100px;">
				顶部菜单栏
			</div>
			<div  onclick="location.href='/admin/webDesign?type=sliderImage'" class="center <?php echo $type=='sliderImage'?'active':'';?>" style="width:150px;">
				顶部滚动图片
			</div>
			<div  onclick="location.href='/admin/webDesign?type=sider'" class="right <?php echo $type=='sider'?'active':'';?>">
				侧边栏
			</div>
			<div class="clear">
			</div>
		</div>
		<div style="float: right;margin-left:10px;">
			<select class="select" id="column" style="width: 125px;">
				<option value="-1">--选择栏目--</option>
				<?php foreach($columns as $col):?>
				<option value="<?php echo $col->column_id;?>"><?php echo $col->column_name;?></option>
				<?php endforeach;?>
			</select>
			<a href="javascript:addPosition('<?php echo $type;?>','确认添加到<?php echo $type;?>？','已成功添加到<?php echo $type;?>！')" class="msg-btn">添加栏目到该位置</a>
		</div>
		<div class="clear">
		</div>
	</div>
	<table style="width: 100%;">
		<thead>
			<tr class="table-head">
				<th style="width:40%;">栏目</th>
				<th style="width:20%;">位置序号</th>
				<th style="width:40%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($positions as $posi):?>
			<tr>
				<td><a href="/admin/editColumn?column=<?php echo $posi->position_column;?>" target="_blank"><?php echo $posi->column_name;?></a></td>
				<td><?php echo $posi->position_ordernum;?></td>
				<td>
					<a href="/admin/editColumn?column=<?php echo $posi->position_column;?>" target="_blank">编辑该栏目</a>
					<a href="javascript:delPosition(<?php echo $posi->position_id;?>,'确定删除从此处移除？【<?php echo $posi->column_name;?>】','已成功移除【<?php echo $posi->column_name;?>】')">删除
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>