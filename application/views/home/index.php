<div class="mainright">
	<div class="maintitle"></div>
	<div class="classlist">
		<?php foreach($column as $key=>$item):
		if($item->column_display==1):?>
		<a href="/home/<?php echo sizeof($item->subColumns)>0?'columnList?id='.$item->column_id:$columnType[$item->column_type].'?id='.$item->column_id;?>" title="<?php echo $item->column_name;?>" class="class-list0<?php echo $key;?>">
			<?php echo $item->column_name;?>
			<p>Click to view details</p>
		</a>
		<?php endif;endforeach;?>
	</div>
</div>