<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/bk.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/admin.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
	<script src="/assets/js/common.js" type="text/javascript"></script>
	<script src="/assets/js/admin.js" type="text/javascript"></script>
</head>
<body>
    <div class="header-cms">
		<a  class="km-logo" href="">
            <img title="<?php echo $websiteName;?>" class="logo-cms" src="/assets/images/cms/logo-cms.png" alt="网站logo" />
		</a>
        <ul class="menu-cms">
            <li class="name">
                <img id="userPhoto" src="/assets/images/cms/defaulthead.png" width="35" height="35">
				<span id="userShowName"><?php echo $_SESSION['username'];?></span>
			</li>
			<li class="message">
				<a href="/admin/message" title="消息" id="js-openmsg">
                <img src="/assets/images/cms/ico_mail.png" width="24" height="24"></a>
				<span id="unreadMesNumber"></span>
			</li>
			<li class="logout">
				<a href="/admin/logout" title="退出">退出</a>
			</li>
        </ul>
    </div>
	<div class="main-bk">
	<?php 
		if(isset($showSlider) && $showSlider && $_SESSION['usertype']=="admin"){
			require("slider.php");
		}
	?>
	<div id="msgBox" class="msg-box">
		<a href="javascript:closeMsg()" class="close" title="关闭">关闭</a>
		<div class="msg-in">
			<ul>
				<li>
					<a href="#" id="newMsg">关于今晚凌晨（2.8）进行平台调试的通知</a>
					<span class="messagetime" id="msgTime">2015-2-13 19:00</span>
				</li>
			</ul>
		</div>
	</div>