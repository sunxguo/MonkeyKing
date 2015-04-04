<div class="mainright add-forum">
	<div class="sitepath">
		你现在的位置：
		<a href="/">主页</a>&gt;&gt;
		<a href="/home/forumList?id=<?php echo $column->column_id;?>"><?php echo $column->column_name;?></a>&gt;&gt;
		<span style="color:#434343;">发帖</span>
	</div>
	<div class="form-data">
		<input type="hidden" id="column_id" value="<?php echo $column->column_id;?>">
		<div class="title">标题：<input type="text" id="title" class="inp-txt width400"></div>
		<div>
			内容：
			<textarea id="textEditor" name="description"></textarea>
		</div>
		<div class="btn-center">
			<a href="javascript:addForum('请填写标题！','发表成功！')" class="btnfa120">发表</a>
		</div>
	</div>
</div>
<link rel="stylesheet" href="/assets/kindEditor/themes/default/default.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>
<script src="/assets/js/common.js" type="text/javascript"></script>