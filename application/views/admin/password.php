<div class="modify_main password-div">
	<div class="tabs-box">
		<div class="tabs-top">
			<a href="#" class="current">修改密码</a>
		</div>
	</div>
	<div class="titA" style="margin-left:20px;">修改密码</div>
	<div class="form-modify">
		<div class="tips-error w230" style="margin-left: 160px; width: 200px;" id="errorInfo"></div>
		<div class="item">
			<input class="inp-txt width200" type="text" name="username" id="username" placeholder="用户名" value="<?php echo $_SESSION['username'];?>"/>
			<span style="color:red;">*</span>
		</div>
		<div class="item">
			<input class="inp-txt width200" type="password" name="oldpwd" id="oldpwd" placeholder="旧密码"/>
			<span style="color:red;">*</span>
		</div>
		<div class="item">
			<input class="inp-txt width200" type="password" name="newpwd" id="newpwd" placeholder="新密码"/>
			<span style="color:red;">*</span>
		</div>
		<div class="item">
			<input class="inp-txt width200" type="password" name="renewpwd" id="renewpwd" placeholder="重复新密码"/>
			<span style="color:red;">*</span>
		</div>
		<div class="btn-center bor-top" style="width:212px;">
			<a href="javascript:modifyAdmin('保存成功！')" class="btn120">保存</a>
		</div>
	</div>
</div>