<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo $title;?></title>
	<link rel="stylesheet" href="/assets/css/base.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/css/admin.css" type="text/css"/>
</head>

<body class="bk">
	<div class="login_main">
		<form class="form-login" action="/admin/login_handler" method="post" enctype="multipart/form-data">
			<input type="text" name="username" placeholder="用户名"/><br/>
			<i class="icon icon-user"></i>
			<input type="password" name="pwd" placeholder="密码"/><br/>
			<i class="icon icon-lock"></i>
			<input type="submit" value="登录"  class="btn btn-blue form-control"/>
		</form>
	</div>
</body>
</html>