<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/home.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
	<script src="/assets/js/home.js" type="text/javascript"></script>
	<script src="/assets/js/common.js" type="text/javascript"></script>
	<script src="/assets/js/unslider.js" type="text/javascript"></script>
</head>
<body>
    <div class="header">
		<div class="headbox" style="margin:0 auto;">
			<div class="pic">
				<div class="banner">
					<ul>
						<?php foreach($sliderImage as $image):?>
						<li><a href="/home/image?id=<?php echo $image->image_id;?>" target="_blank"><img src="<?php echo $image->image_src;?>"></a></li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
			<p>
				<a href="" style="display:inline-block;height:16px;">   </a>
			</p>
			<div class="nav">
				<a href="/">首页</a>  |
				<?php $amount=sizeof($topBar);
				for($i=0;$i<$amount;$i++):
				if($topBar[$i]->column_display==1):?>
				<a href="/home/<?php echo sizeof($topBar[$i]->subColumns)>0?'columnList?id='.$topBar[$i]->column_id:$columnType[$topBar[$i]->column_type];?>?id=<?php echo $topBar[$i]->column_id;?>"><?php echo $topBar[$i]->column_name;?></a><?php echo $i!=($amount-1)?'  |':'';?>
				<?php endif;endfor;?>
			</div>
		</div>
    </div>
    </div>
	<div class="main">
	<?php
		if(isset($showSider) && $showSider){
			require("sider.php");
		}
	?>