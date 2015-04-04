<div class="mainright">
	<div class="maintitle">用户中心</div>
	<ul class="form-list">
		<li class="avatar-div">
			<img id="avatar" src="<?php echo isset($user->user_avatar) && $user->user_avatar!=''?$user->user_avatar:'/assets/images/cms/defaulthead.png';?>" onclick="addImage();">
			<div onclick="addImage();">点击更换头像</div>
		</li>
		<li>
			<span>用户名：</span>
			<input type="text" placeholder="用户名" id="username" name="username" class="inp-txt width150" value="<?php echo $user->user_username;?>">
		</li>
		<li>
			<span>旧密码：</span>
			<input type="password" placeholder="如果设置新密码则此项必填！" id="oldPwd" name="oldPwd" class="inp-txt width150">
		</li>
		<li>
			<span>新密码：</span>
			<input type="password" placeholder="设置新密码" id="newPwd" name="newPwd" class="inp-txt width150">
		</li>
		<li>
			<span>性别：</span>
			<input type="radio" name="gender" value="0" <?php echo $user->user_gender==0?'checked':'';?>>
			<label>男</label>
			<input type="radio" name="gender" value="1" <?php echo $user->user_gender==1?'checked':'';?>>
			<label>女</label>
		</li>
		<li>
			<span>邮箱：</span>
			<input type="text" placeholder="邮箱" id="email" name="email" class="inp-txt width150" value="<?php echo $user->user_email;?>">
		</li>
		<li>
			<span>手机：</span>
			<input type="text" placeholder="手机" id="phone" name="phone" class="inp-txt width150" value="<?php echo $user->user_phone;?>">
		</li>
		<li>
			<input onclick="saveUser('请填写用户名！','密码长度为6~22！','请填写旧密码','恭喜保存成功！');" type="button" value="保存" class="confirm_bt" style="height:28px;line-height:28px;font-size:12px;top: 2px;position: relative;margin:0 auto;display: block;">
		</li>
	</ul>
	<form id="upload_image_form" method="post" action="/cms/index/upload_img" enctype="multipart/form-data">
		<input onchange="return uploadAvatar()" name="image" type="file" id="file" style="display:none;" accept="image/*">
	</form>
</div>
<script src="/assets/js/common.js" type="text/javascript"></script>
<script charset="utf-8" src="/assets/js/jquery.form.js"></script>