<div class="mainright">
	<div class="sitepath">
		你现在的位置：
		<a href="/">主页</a>&gt;&gt;
		<a href="/home/<?php echo $columnType[$column->column_type];?>?id=<?php echo $column->column_id;?>"><?php echo $column->column_name;?></a>&gt;&gt;
		<span style="color:#434343;">正文内容</span>
	</div>
	<h1 class="maintitle"><?php echo $essay->essay_title;?></h1>
	<div class="maindate">发布时间：<?php echo date('Y-m-d',strtotime($essay->essay_lastmodify_time));?></div>
	<div class="maincontent"><?php echo $essay->essay_content;?></div>
</div>