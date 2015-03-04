<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <title><?=$title?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/admin.css" type="text/css"/>
    <script src="/assets/js/jquery.js" type="text/javascript"></script>
    <script src="/assets/js/menu.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.backgroundpos.js" type="text/javascript"></script>
</head>

<body class="bk">
	<div class="login_main">
		<form class="form-login" action="/kmadmin/admin/login_handler" method="post" enctype="multipart/form-data">
			<input type="text" name="username" placeholder="用户名"/><br/>
			<i class="icon icon-user"></i>
			<input type="password" name="pwd" placeholder="密码"/><br/>
			<i class="icon icon-lock"></i>
			<input type="submit" value="登录"  class="btn btn-blue form-control"/>
		</form>
	</div>
</body>
</html>