<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.14 11:2
 */

session_start();
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
//require_once '../config/session.php';
require_once '../config/user_control.php';
$pro_res=new user_control();
$del_res=$pro_res->project_del();
?>