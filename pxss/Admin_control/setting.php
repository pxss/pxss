<?php
/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.18 16:25
 */
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
//require_once '../config/session.php';
$info_query=mysql_query("SELECT * FROM `pxss_userinfo` WHERE `id`=1");
$info_res= mysql_fetch_array($info_query);
?>
<div class="pageContent">
	
	<form method="post" action="setting_ok.php" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="58">
			<div class="unit">
				<label>当前邮箱：</label>
				<a><?=$info_res['email']?></a>
			</div>
			<div class="unit">
				<label>设置邮箱：</label>
				<input type="text" id="newemail" name="newemail" size="30" />
			</div></p>
			<div class="unit">
				<label>上次登录IP：</label>
				<a><?=base64_decode($info_res['last_login_ip'])?></a>
			</div>
			<div class="unit">
				<label>上次登录时间：</label>
				<a><?=$info_res['last_login_time']?></a>
			</div>
			<div class="unit">
				<label>本次登录IP：</label>
				<a><?=base64_decode($info_res['this_login_ip'])?></a>
			</div>
			<div class="unit">
				<label>本次登录时间：</label>
				<a><?=$info_res['this_login_time']?></a>
			</div>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>
