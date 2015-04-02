<div class="modify_main password-div">
	<div class="tabs-box">
		<div class="tabs-top">
			<a href="/admin/setting" class="current">备份数据库</a>
			<a href="/admin/email">邮箱配置</a>
		</div>
	</div>
	<div class="titA" style="margin-left:20px;">备份数据库</div>
	<div class="form-modify">
		<div class="tips-error w230" style="margin-left: 160px; width: 200px;" id="errorInfo"></div>
		<div class="item">
			上次备份时间:<?php echo $lastBackTime;?>
		</div>
		<div class="item">
			<input class="inp-txt width200" type="text" name="filename" id="filename" placeholder="保存文件名" value="zb.sql"/>
			<span style="color:red;">*</span>
		</div>
		<div class="btn-center bor-top" style="width:212px;">
			<a href="javascript:backUp()" class="btn120">开始备份</a>
		</div>
	</div>
</div>