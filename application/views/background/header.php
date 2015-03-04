<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=$title?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/bk.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/admin.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
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
				<a href="/kmadmin/admin/message" title="消息" id="js-openmsg">
                <img src="/assets/images/cms/ico_mail.png" width="24" height="24"></a>
				<span id="unreadMesNumber"></span>
			</li>
			<li class="logout">
				<a href="/kmadmin/admin/logout" title="退出">退出</a>
			</li>
        </ul>
    </div>
	<div class="main-bk">
	<?php 
		if(isset($showSlider) && $showSlider && $_SESSION['usertype']=="admin"){
			require("slider.php");
		}
	?>