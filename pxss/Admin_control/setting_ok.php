<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.18 17:26
 */

header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
   if($_POST['newemail'] && $_POST['newemail']!='' ){
        $email=$_POST['newemail'];
        if($ereg=eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$email)){
            mysql_query("UPDATE `pxss_userinfo` SET `email` = '{$email}' WHERE `id` = 1");
        echo <<< EOD
{
	"statusCode":"200",
	"message":"\u66F4\u65B0\u6210\u529F!",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;

        }else{
        echo <<< EOD
{
	"statusCode":"300",
	"message":"\u90AE\u7BB1\u683C\u5F0F\u4E0D\u6B63\u786E",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
   
}
        
    }else{
        echo <<< EOD
{
	"statusCode":"300",
	"message":"\u90AE\u7BB1\u4E0D\u80FD\u4E3A\u7A7A",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}
EOD;
}

?>