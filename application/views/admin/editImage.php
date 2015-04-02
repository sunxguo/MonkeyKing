<div class="padding10 formList clearfix">
	<div id="appDiv" class="titA tit-bot pb5" style="">
		<div style="float: right;margin-left:10px;">
			<a href="javascript:history.go(-1);" class="msg-btn">返回</a>
		</div>
		<div class="clear">
		</div>
	</div>
	<div class="partContent baseInfoLeft">
		<div class="title">
			编辑图片
		</div>
		<div id="Div1">
			<div class="item itemLeft" style="margin-top: 10px;">
				<span class="label">栏目：</span>
				<select class="select" id="column" style="width: 125px;">
					<option value="-1">--选择栏目--</option>
					<?php foreach($columns as $col):?>
					<option value="<?php echo $col->column_id;?>" <?php echo $col->column_id==$content->image_column?'selected':'';?>><?php echo $col->column_name;?></option>
					<?php foreach($col->subColumns as $subCol):?>
					<option value="<?php echo $subCol->column_id;?>" <?php echo $subCol->column_id==$content->image_column?'selected':'';?>>&nbsp;&nbsp;&nbsp;--&nbsp;<?php echo $subCol->column_name;?></option>
					<?php endforeach;?>
					<?php endforeach;?>
				</select>
				<span style="color: red;">*</span>
					<a href="/admin/columnList" class="underline" target="_blank">栏目管理</a>
					<?php if(sizeof($columns)==0):?>
					<span style="color: red;">--还没有图片类型的栏目，请添加--</span>
					<?php endif;?>
				<br>
			</div>
			<div class="item itemLeft">
				<span class="label">标题：</span>
				<input type="text" id="title" class="inp-txt width400" maxlength="30" placeholder="1~30字" value="<?php echo $content->image_title;?>">
				<span style="color: red;">*</span>
			</div>
			<div class="item itemLeft" style="margin-bottom: 20px;">
				<span class="label">摘要：</span>
				<input class="inp-txt width400" id="summary" maxlength="30"  placeholder="1~30字" value="<?php echo $content->image_summary;?>">
			</div>
		</div>
	</div>
	<div class="partContent listImgs" id="ListImgs" style="margin-bottom: 23px">
		<div class="title" style="position: relative">
			<span style="float: left;">上传图片</span>
		</div>
		<div class="lists" id="Div6">
			<span class="example">
				<a href="javascript:void(0)" style="color: Red;display:none">示例</a>
			</span>
			<ul id="imgListDivs">
				<li class="img-item imagelist" onmouseover="imgover(this)" onmouseout="imgout(this)">
					<img class="thumb-src" width="77" height="77" src="<?php echo $content->image_src;?>">
					<img onclick="delclick(this)" class="del-bt" title="删除此缩略图" src="/assets/images/cms/delete.png">
				</li>
				<li id="addImgList" class="img-item" style='display:none;'>
					<div onclick="addImage()" style="cursor:pointer;">
						<img width="77" height="77" src="/assets/images/cms/appbg_ad.png">
					</div>
					<form id="upload_image_form" method="post" action="/cms/index/upload_img" enctype="multipart/form-data">
						<input onchange="return uploadContentImage()" name="image" type="file" id="file" style="display:none;" accept="image/*">
					</form>
				</li>
			</ul>
		</div>
	</div>
	<input type="hidden" value="<?php echo $content->image_id;?>" id="imageId">
	<div class="btn-center">
		<a href="javascript:imageHandler(0,'发布成功！正在刷新...',false)" class="btnfa120">发布</a>
		<a href="javascript:imageHandler(1,'成功保存草稿！正在刷新...',false)" class="btn120">存草稿</a>
	</div>
</div>
<link rel="stylesheet" href="/assets/kindEditor/themes/custom/custom.css" />
<script charset="utf-8" src="/assets/kindEditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/assets/kindEditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>