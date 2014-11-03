<?php
/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.18 16:25
 */
header("Content-type: text/html; charset=utf-8");
 date_default_timezone_set('PRC');
require_once './config/mysql_conn.php';
    $username='admin';
    $password='admin';//密码长度建议在6位以上
    $username_test = $_POST['username'];
    $password_test = $_POST['password'];
    if($_POST['action'])
    {
    if($username_test == $username && $password_test == $password)
    {
    $thetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
    $user_ip=base64_encode(htmlspecialchars(addslashes($_SERVER["REMOTE_ADDR"])));
    $password = md5(sha1(md5(base64_decode(md5($password_test)))));
    $cookie_username=$username;
    $cookie=substr(md5(sha1(md5(base64_decode(md5($username.$password.time()))))),0,30);
    session_start();
    $_SESSION['user_name']=$cookie_username;
    $_SESSION['user_login']=$cookie;
    $userinfo_query=mysql_query("SELECT * FROM `pxss_userinfo` WHERE `id`=1");
    $userinfo_res=mysql_fetch_array($userinfo_query);
    mysql_query("UPDATE `pxss_userinfo` SET `this_login_ip`='{$user_ip}',`this_login_time`='{$thetime}',`last_login_ip`='{$userinfo_res['this_login_ip']}',`last_login_time`='{$userinfo_res['this_login_time']}' WHERE `id`=1");
    header("location:Admin_control/index.php");
    
    }else
    {
        echo "<script>alert('用户名或密码错误,请检查大小写！');history.go(-1);</script>";
    }
    }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PXSS平台--By:Pony</title>
<link href="templates/templates/manage/css/common_green.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/script/jquery.js"></script>
<script type="text/javascript">
if (top.location != self.location) top.location = self.location;
function trim(str){
	return str.replace(/(^[\s\u3000]*)|([\s\u3000]*$)/g,"");
}
function check(){
	if(document.login.username.value.length < 1){
		alert('请输入正确的登录用户名。') ;
		document.login.username.focus();
		return false;		
	}
	if(document.login.password.value.length < 5){
		alert('请输入正确的登录密码。') ;
		document.login.password.focus();
		return false;		
	}
	}


</script>
<style type="text/css">
body{background:url(templates/templates/manage/images/login_gb.png) #000; padding:0; margin:0; color:#333;}
.framework{height:0px; width:0px; top:50%; left:50%; position:absolute; margin:-222px auto auto -204px;}
.framework .login{width:408px; height:444px; background:url(templates/templates/manage/images/login_bg.png) 0 0 no-repeat; overflow:hidden;}
.framework .login input{background:#FFF; border:0; height:23px; width:166px; line-height:23px; font-family:verdana,lucida,Arial,Helvetica,sans-serif;}
.framework .login .username{padding:80px 0 0 130px; *padding-top:78px;}
.framework .login .password{padding:24px 0 0 130px; *padding-top:22px;}
.framework .login .button_x{padding:20px 0 0 124px; width:108px;}
.framework .login .button_x input{width:78px; height:28px;}
.framework .login .captcha{padding:0 18px 0 0;}
.framework .login .captcha input{border:1px #CCC solid; height:25px; width:70px; padding:0 3px; text-transform:uppercase;}
#siimage{border:1px #DFDFDF solid;}
#siimage_div{display:none;}
#siimage_div img{position:absolute; margin:15px auto auto -107px;}
</style>
</head>
<body>
	<form name="login"  action="index.php" method="POST" onsubmit="return check()">
<div class="framework">

	<div class="login">
		<ol class="username"><input name="username" type="text" value="" maxlength="20" /></ol>
		<ol class="password"><input name="password" type="password" value="" maxlength="20" /></ol>
		<ol class="button_x" >
			<table cellpadding="0" cellspacing="0" border="0"><tr>
						<td><input type="image" src="templates/templates/manage/images/login_submit.png" /></td>
			</tr></table>
		</ol>
	</div>
	<input type="hidden" value="login" name="action" />

</div>
	</form>
</body>
</html>