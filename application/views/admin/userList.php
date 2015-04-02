<div class="padding10 contentlist">
	<div id="appDiv" class="titA tit-bot pb5" style="">
		<div style="float: right;margin-left:10px;">
			<input type="text" id="keyword" class="inp-txt width200" value="<?php echo isset($_GET["search"])?$_GET["search"]:"";?>">
			<a href="javascript:selectUser('<?php echo $selectPage;?>')" class="btn80">搜索</a>
		</div>
		<div style="float: right;">
			<span class="font12">状态：</span>
			<select id="state" onchange="selectUser('<?php echo $selectPage;?>')" class="select w100">
                <option value="0">全部</option>
                <option value="normal" <?php echo isset($_GET["state"]) && $_GET["state"]=="normal"?'selected = "selected"':'';?>>正常</option>
                <option value="freeze" <?php echo isset($_GET["state"]) && $_GET["state"]=="freeze"?'selected = "selected"':'';?>>冻结</option>
            </select>
		</div>
		<div style="float: right;margin-right:10px;">
			<span class="font12">性别：</span>
			<select id="gender" onchange="selectUser('<?php echo $selectPage;?>')" class="select w100">
                <option value="0">全部</option>
                <option value="male" <?php echo isset($_GET["gender"]) && $_GET["gender"]=="male"?'selected = "selected"':'';?>>男</option>
                <option value="female" <?php echo isset($_GET["gender"]) && $_GET["gender"]=="female"?'selected = "selected"':'';?>>女</option>
                <option value="unknown" <?php echo isset($_GET["gender"]) && $_GET["gender"]=="unknown"?'selected = "selected"':'';?>>未知</option>
            </select>
		</div>
		<div class="clear">
		</div>
	</div>
	<table style="width: 100%;">
		<thead>
			<tr class="table-head">
				<th style="width:15%;">用户名</th>
				<th style="width:10%;">性别</th>
				<th style="width:15%;">最后登录时间</th>
				<th style="width:15%;">注册时间</th>
				<th style="width:10%;">状态</th>
				<th style="width:15%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user):?>
			<tr>
				<td><?php echo $user->user_username;?></td>
				<td><?php echo $user->user_gender==0?'男':'女';?></td>
				<td><?php echo $user->user_lastlogin_time;?></td>
				<td><?php echo $user->user_reg_time;?></td>
				<td><?php echo $user->user_state==0?'正常':'冻结';?></td>
				<td>
					<a href="javascript:delUser('<?php echo $user->user_id;?>','确定删除该用户【<?php echo $user->user_username;?>】？','成功删除用户【<?php echo $user->user_username;?>】！正在刷新...');">删除
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<div class="page-div">
		<span class="">总共<?php echo $amount;?>条</span>
		<span onclick="location.href='<?php echo $firstPage=="no"?"#":$firstPage;?>'" class="page-bt first <?php echo $firstPage=="no"?"last-disabled":"";?>" title="首页">首页</span>
		<span onclick="location.href='<?php echo $prevPage=="no"?"#":$prevPage;?>'" class="page-bt prev <?php echo $prevPage=="no"?"prev-disabled":"";?>" title="上一页">上一页</span>
		<span class="showpagenum"><?php echo $currentPage;?>/<?php echo $pageAmount;?></span>
		<span onclick="location.href='<?php echo $nextPage=="no"?"#":$nextPage;?>'" class="page-bt next <?php echo $nextPage=="no"?"next-disabled":"";?>" title="下一页">下一页</span>
		<span onclick="location.href='<?php echo $lastPage=="no"?"#":$lastPage;?>'" class="page-bt last <?php echo $lastPage=="no"?"last-disabled":"";?>" title="最后一页">最后一页</span>
		<span class="jump">
			跳转到第
			<input id="page_num" type="text" class="jumpinput">
			页
		</span>
		<button class="jumpbt" onclick="jumpPage('<?php echo $jumpPage;?>')">跳转</button>
	</div>
</div>