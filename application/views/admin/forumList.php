<div class="padding10 contentlist">
	<div id="appDiv" class="titA tit-bot pb5" style="">
		<div class="tabDiv">
			<div  onclick="location.href='/admin/contentList?type=essay'" class="left">
				文章
			</div>
			<div  onclick="location.href='/admin/contentList?type=image'" class="center">
				图片
			</div>
			<div  onclick="location.href='/admin/contentList?type=forum'" class="right active">
				帖子
			</div>
			<div class="clear">
			</div>
		</div>
		<div style="float: right;margin-left:10px;">
			<input type="text" id="keyword" class="inp-txt width200" value="<?php echo isset($_GET["search"])?$_GET["search"]:"";?>">
			<a href="javascript:selectEssay('<?php echo $selectPage;?>')" class="btn80">搜索</a>
		</div>
		<div style="float: right;">
			<span class="font12">状态：</span>
			<select id="state" onchange="selectEssay('<?php echo $selectPage;?>')" class="select w100">
                <option value="-1">所有</option>
                <option value="0" <?php echo isset($_GET["state"]) && $_GET["state"]=="0"?'selected = "selected"':'';?>>已发布</option>
                <option value="1" <?php echo isset($_GET["state"]) && $_GET["state"]=="1"?'selected = "selected"':'';?>>草稿</option>
				<option value="2" <?php echo isset($_GET["state"]) && $_GET["state"]=="2"?'selected = "selected"':'';?>>删除</option>
            </select>
		</div>
		<div style="float: right;margin-right:10px;">
			<span class="font12">栏目：</span>
			<select id="column" onchange="selectEssay('<?php echo $selectPage;?>')" class="select w100">
                <option value="0">所有</option>
				<?php foreach($columns as $col):?>
                <option value="<?php echo $col->column_id;?>" <?php echo isset($_GET["column"]) && $_GET["column"]==$col->column_id?'selected = "selected"':'';?>><?php echo $col->column_name;?></option>
				<?php endforeach;?>
            </select>
		</div>
		<div class="clear">
		</div>
	</div>
	<table style="width: 100%;">
		<thead>
			<tr class="table-head">
				<th style="width:10%;">栏目</th>
				<th style="width:25%;">标题</th>
				<th style="width:10%;">创建时间</th>
				<th style="width:10%;">最后修改时间</th>
				<th style="width:10%;">访问量</th>
				<th style="width:10%;">标记</th>
				<th style="width:15%;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($contents as $cont):?>
			<tr>
				<td>
					<a href="/admin/editColumn?column=<?php echo $cont->forum_column;?>" target="_blank">
						<?php echo $columns[$cont->forum_column]->column_name;?>
					</a>
				</td>
				<td><a href="/home/forum?id=<?php echo $cont->forum_id;?>"><?php echo $cont->forum_title;?></a></td>
				<td><?php echo $cont->forum_create_time;?></td>
				<td><?php echo $cont->forum_lastmodify_time;?></td>
				<td><?php echo $cont->forum_visits;?></td>
				<td><?php //echo $contentMark[$cont->forum_mark];?></td>
				<td>
					<a href="/home/forum?id=<?php echo $cont->forum_id;?>" target="_blank">查看</a>
					<a href="javascript:delForum('<?php echo $cont->forum_id;?>','确定删除该帖子【<?php echo $cont->forum_title;?>】？','成功删除帖子【<?php echo $cont->forum_title;?>】！正在刷新...');">删除</a>
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