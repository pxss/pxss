<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.14 21:45
 */
error_reporting(0);
header("Content-type: text/html; charset=utf-8");
$db_HOST = 'localhost';
$db_USERNAME = 'xss';
$db_PASSWORD = 'xss';
$db_NAME = 'newxss';
$mysql_conn = mysql_connect($db_HOST, $db_USERNAME, $db_PASSWORD) or die('Mysql connect error!');
mysql_select_db($db_NAME, $mysql_conn) or die('Database connect error!');
mysql_query("SET NAMES UTF8");

?>