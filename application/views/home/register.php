<div class="mainright">
	<div class="maintitle">注册</div>
	<div class="classlist">
		<ul class="form-list">
			<li>
				<span>用户名：</span>
				<input type="text" placeholder="用户名" id="username" name="username" class="inp-txt width150">
			</li>
			<li>
				<span>密码：</span>
				<input type="password" placeholder="密码" id="pwd" name="pwd" class="inp-txt width150">
			</li>
			<li>
				<span>性别：</span>
				<input type="radio" name="gender" value="0" checked>
				<label>男</label>
				<input type="radio" name="gender" value="1">
				<label>女</label>
			</li>
			<li>
				<input onclick="register('add','请填写用户名！','请填写密码','密码长度为6~22！','恭喜注册成功！');" type="button" value="注册" class="confirm_bt" style="height:28px;line-height:28px;font-size:12px;top: 2px;position: relative;margin:0 auto;display: block;">
			</li>
		</ul>
	</div>
</div>