<div class="slider">
<h3 <?php echo isset($index) && $index?'class="current"':'';?>>
	<a href="/admin">
		<span class="ico ico-sy"></span>
		主页
	</a>
</h3>
<!--
<h3>
	<a href="" id="menu_promotionManage">
		<span class="ico ico-tggl"></span>
		推广管理
	</a>
</h3>
-->
<h3 <?php echo isset($webDesign) && $webDesign?'class="current"':'';?>>
	<a href="/admin/webDesign">
		<span class="ico ico-wzsj"></span>
		网站设计
	</a>
</h3>
<h3 <?php echo isset($columnList) && $columnList?'class="current"':'';?>>
	<a href="/admin/columnList">
		<span class="ico ico-jbgl"></span>
		栏目管理
	</a>
</h3>
<h3 <?php echo isset($userList) && $userList?'class="current"':'';?>>
	<a href="/admin/userList">
		<span class="ico ico-shgl"></span>
		用户管理
	</a>
</h3>
<h3 <?php echo isset($content) && $content?'class="current"':'';?>>
	<a href="/admin/contentList">
		<span class="ico ico-tsxx"></span>
		内容管理
	</a>
</h3>
<ul style="display: block;">
	<li><a href="/admin/addContent" <?php echo isset($addContent) && $addContent?'class="current"':'';?>>发布新内容</a></li>
	<li><a href="/admin/contentList" <?php echo isset($contentList) && $contentList?'class="current"':'';?>>内容查询</a></li>
</ul>
<h3 <?php echo isset($setting) && $setting?'class="current"':'';?>>
	<a href="/admin/setting">
		<span class="ico ico-yygl"></span>
		系统设置
	</a>
</h3>
<h3 <?php echo isset($account) && $account?'class="current"':'';?>>
	<a href="/admin/password">
		<span class="ico ico-zhxx"></span>
		账户信息
	</a>
</h3>
</div>