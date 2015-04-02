<div class="mainright">
	<h1 class="maintitle"><?php echo $column->column_name;?>
	<a href="/home/addForum?id=<?php echo $column->column_id;?>" class="btn120 post-forum fr">发帖</a>
	</h1>
	<ul class="forum-list">
		<?php foreach($forums as $item):?>
		<li>
			<div class="avatar fl"><img src="<?php echo $item->user_avatar;?>"></div>
			<div class="baseInfo fl">
				<div class="title">
					<!--
					<img src="http://bbs.360safe.com/static/image/common/pin_new_1.gif" alt="本版置顶">
					-->
					<a href="/home/forum?id=<?php echo $item->forum_id;?>"><?php echo $item->forum_title;?></a>
				</div>
				<div class="author">
					<a href="" target="_blank"><?php echo $item->user_username;?></a>
					<span>于 <?php echo $item->forum_create_time;?> 发表 |</span>
					<a href="" target="_blank">孙行者</a>
					<span>于 2015-03-06 06:11 最后回复</span>
				</div>
			</div>
			<div class="reply-num fr">
				<div title="浏览量"><?php echo $item->forum_visits;?></div>
				<div title="回复量">0</div>
			</div>
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