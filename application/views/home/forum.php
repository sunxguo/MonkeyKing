<div class="mainright forum">
	<div class="sitepath">
		你现在的位置：
		<a href="/">主页</a>&gt;&gt;
		<a href="/home/forumList?id=<?php echo $column->column_id;?>"><?php echo $column->column_name;?></a>&gt;&gt;
		<span style="color:#434343;">帖子内容</span>
	</div>
	<?php if($currentPage==1):?>
	<div class="author-info fl">
		<a href="">
			<img src="<?php echo $forum->user_avatar;?>">
			<span><?php echo $forum->user_username;?></span>
		</a>
	</div>
	<h1 class="maintitle fl"><?php echo $forum->forum_title;?></h1>
	<div class="maindate">发布时间：<?php echo $forum->forum_create_time;?></div>
	<div class="main-content">
		<?php echo $forum->forum_content;?>
	</div>
	<div class="main-time">
		<a href="javascript:reply('1','<?php echo $forum->forum_id;?>');">回复</a>
	</div>
	<?php endif;?>
	<ul>
		<?php foreach($comments as $item):?>
		<li class="clearfix">
			<div class="avatar fl">
				<a href="">
					<img src="<?php echo $item->user_avatar;?>">
					<p><?php echo $item->user_username;?></p>
				</a>
			</div>
			<div class="comment fl">
				<div class="content">
					<?php echo $item->comment_content;?>
				</div>
				<div class="time">
					<span><?php echo $item->comment_time;?></span>
					<a href="javascript:reply('2','<?php echo $item->comment_id;?>');">回复</a>
				</div>
			</div>
			<?php foreach($item->subComments as $subC):?>
			<div class="sub-comment" style="clear:both;">
			<a><?php echo $subC->user_username;?></a>于<?php echo $subC->comment_time;?>: <?php echo $subC->comment_content;?>
			</div>
			<?php endforeach;?>
		</li>
		<?php endforeach;?>
	</ul>
	<div class="page" class="admin_pages">
		总记录：<span><?php echo $amount;?></span> 条 &nbsp;
		<span><?php echo $currentPage;?></span> / <span><?php echo $pageAmount;?></span> 页&nbsp;&nbsp;
		
		<a href="<?php echo $firstPage=='no'?'#':$firstPage;?>" title="首页">首页</a>
		<a href="<?php echo $prevPage=='no'?'#':$prevPage;?>" title="上一页">上一页</a>
		<a href="<?php echo $nextPage=='no'?'#':$nextPage;?>" title="下一页">下一页</a>
		<a href="<?php echo $lastPage=='no'?'#':$lastPage;?>" title="尾页">尾页</a>
	</div>
</div>
<div class="comment-dialog" id="dialog">
	<div class="comment-header">回复<span class="close" onclick="removeDiv('#dialog');">X</span></div>
	<ul>
		<li class="comment-content-title">内容：</li>
		<li>
			<textarea id="comment_content"></textarea>
		</li>
		<li>
			<input type="button" value="回复" onclick="comment('回复成功！');" class="confirm_bt" style="height:28px;line-height:28px;font-size:12px;top: 2px;position: relative;">
		</li>
	</ul>
</div>