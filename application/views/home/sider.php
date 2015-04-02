<div class="mainleft">
	<?php foreach($sider as $item):?>
	<?php if(sizeof($item->subColumns)>0):?>
	<h2><?php echo $item->column_name?></h2>
	<ul>
		<?php foreach($item->subColumns as $subItem):?>
		<li><a href="/home/<?php echo $columnType[$subItem->column_type];?>?id=<?php echo $subItem->column_id;?>"><?php echo $subItem->column_name;?></a></li>
		<?php endforeach;?>
	</ul>
	<?php else:?>
	<h2><a href="/home/<?php echo $columnType[$item->column_type];?>?id=<?php echo $item->column_id;?>"><?php echo $item->column_name?></a></h2>
	<?php endif;?>
	<?php endforeach;?>
	<p><a href="mailto:sunxguo@163.com">联系邮箱</a></p>
</div>