<div class="mainright">
	<h1 class="maintitle"><?php echo $column->column_name;?></h1>
	<div id="thumbs">
		<?php foreach($images as $item):?>
		<a href="<?php echo $item->image_src?>" style="background-image:url(<?php echo $item->image_src?>)" title="<?php echo $item->image_title?>"></a>
		<?php endforeach;?>
	</div>
	<div class="page" class="admin_pages">
		总记录：<span><?php echo $amount;?></span> 条 &nbsp;
		<span><?php echo $currentPage;?></span> / <span><?php echo $pageAmount;?></span> 页&nbsp;&nbsp;
		
		<a href="<?php echo $firstPage=='no'?'#':$firstPage;?>" title="首页">首页</a>
		<a href="<?php echo $prevPage=='no'?'#':$prevPage;?>" title="上一页">上一页</a>
		<a href="<?php echo $nextPage=='no'?'#':$nextPage;?>" title="下一页">下一页</a>
		<a href="<?php echo $lastPage=='no'?'#':$lastPage;?>" title="尾页">尾页</a>
	</div>
</div>

<link rel="stylesheet" href="/assets/css/touchTouch.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/styles.css" type="text/css"/>
<script src="/assets/js/touchTouch.jquery.js" type="text/javascript"></script>
<script>
$(function(){
	// Initialize the gallery
	$('#thumbs a').touchTouch();
});
</script>