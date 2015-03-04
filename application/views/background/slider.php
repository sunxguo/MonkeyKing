<div class="slider">
<h3>
	<a href="/kmadmin/admin" id="menu_portal">
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
<h3 <?php echo isset($market) && $market?'class="current"':'';?>>
	<a href="/kmadmin/admin/market_home">
		<span class="ico ico-jbgl"></span>
		应用市场管理
	</a>
</h3>
<ul style="display: block;">
	<li><a href="/kmadmin/admin/market_home" <?php echo isset($home) && $home?'class="current"':'';?>>首页维护</a></li>
	<li><a href="/kmadmin/admin/market_union" <?php echo isset($union) && $union?'class="current"':'';?>>专题管理</a></li>
	<li><a href="/kmadmin/admin/market_recommend" <?php echo isset($recommend) && $recommend?'class="current"':'';?>>推荐管理</a></li>
</ul>
<h3 <?php echo isset($app) && $app?'class="current"':'';?>>
	<a href="/kmadmin/admin/app" id="menu_manageApp">
		<span class="ico ico-yygl"></span>
		应用管理
	</a>
</h3>
<h3 <?php echo isset($merchant) && $merchant?'class="current"':'';?>>
	<a href="/kmadmin/admin/merchant" id="menu_portal">
		<span class="ico ico-shgl"></span>
		商户管理
	</a>
</h3>
<h3 <?php echo isset($ad) && $ad?'class="current"':'';?>>
	<a href="/kmadmin/admin/ad" id="menu_portal">
		<span class="ico ico-gggl"></span>
		广告管理
	</a>
</h3>
<h3 <?php echo isset($message) && $message?'class="current"':'';?>>
	<a href="/kmadmin/admin/message" id="menu_portal">
		<span class="ico ico-tsxx"></span>
		推送消息
	</a>
</h3>
<h3 <?php echo isset($account) && $account?'class="current"':'';?>>
	<a href="/kmadmin/admin/account" id="menu_accountInfo">
		<span class="ico ico-zhxx"></span>
		账户信息
	</a>
</h3>
</div>