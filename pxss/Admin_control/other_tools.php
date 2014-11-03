<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.19 21:37
 */
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
require_once '../config/user_control.php';
$pro_res=new user_control();
$pro_list=$pro_res->other_tools();

?>
