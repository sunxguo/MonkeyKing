<div class="padding10 contentlist">
	<div id="appDiv" class="titA tit-bot pb5" style="">
		<div class="tabDiv">
			<div  onclick="location.href='/admin/contentList?type=essay'" class="left">
				文章
			</div>
			<div  onclick="location.href='/admin/contentList?type=image'" class="center">
				图片
			</div>
			<div  onclick="location.href='/admin/contentList?type=forum'" class="center">
				帖子
			</div>
			<div class="right active">
				评论
			</div>
			<div class="clear">
			</div>
		</div>
		<div style="float: right;margin-left:10px;">
			<input type="hidden" id="forum" value="<?php echo isset($contents[0])?$contents[0]->forum_id:'';?>">
			<input type="text" id="keyword" class="inp-txt width200" value="<?php echo isset($_GET["search"])?$_GET["search"]:"";?>">
			<a href="javascript:selectComment('<?php echo $selectPage;?>')" class="btn80">搜索</a>
		</div>
		<div class="clear">
		</div>
	</div>
	<table style="width: 100%;">
		<thead>
			<tr class="table-head">
				<th style="width:10%;">帖子</th>
				<th style="width:25%;">内容</th>
				<th style="width:10%;">创建时间</th>
				<th style="width:10%;">评论人</th>
				<th style="width:15%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($contents as $cont):?>
			<tr>
				<td>
					<a href="/home/forum?id=<?php echo $cont->forum_id;?>" target="_blank">
						<?php echo $cont->forum_title;?>
					</a>
				</td>
				<td><a href="/home/forum?id=<?php echo $cont->forum_id;?>" target="_blank"><?php echo $cont->comment_content;?></a></td>
				<td><?php echo $cont->comment_time;?></td>
				<td><?php echo $cont->user_username;?></td>
				<td>
					<a href="/home/forum?id=<?php echo $cont->forum_id;?>" target="_blank">查看</a>
					<a href="javascript:delComment('<?php echo $cont->comment_id;?>','确定删除该评论？','成功删除评论！正在刷新...');">删除</a>
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