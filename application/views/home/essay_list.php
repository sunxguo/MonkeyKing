<div class="mainright">
	<h1 class="maintitle"><?php echo $column->column_name;?></h1>
	<ul class="mainlist">
		<?php foreach($essays as $item): ?>
		<li>
			<span><?php echo date('Y-m-d',strtotime($item->essay_lastmodify_time));?></span>
			<a href="/home/essay?id=<?php echo $item->essay_id;?>" target="_self"><?php echo $item->essay_title;?></a>
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