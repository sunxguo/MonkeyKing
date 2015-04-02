<div class="modify_main password-div">
	<div class="tabs-box">
		<div class="tabs-top">
			<a href="/admin/setting">备份数据库</a>
			<a href="/admin/email" class="current">邮箱配置</a>
		</div>
	</div>
	<div class="titA" style="margin-left:20px;">紧急联系邮箱</div>
	<div class="form-modify">
		<div class="tips-error w230" style="margin-left: 160px; width: 200px;" id="errorInfo"></div>
		<div class="item">
			<input class="inp-txt width200" type="text" name="email" id="email" placeholder="邮箱" value="<?php echo $email;?>"/>
			<span style="color:red;">*</span>
		</div>
		<div class="btn-center bor-top" style="width:212px;">
			<a href="javascript:saveEmail('保存成功！')" class="btn120">保存</a>
		</div>
	</div>
</div>