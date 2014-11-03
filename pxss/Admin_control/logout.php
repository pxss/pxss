<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.18 17:50
 */
 error_reporting(0);
session_start();
header("Content-type: text/html; charset=utf-8");
require_once '../config/session.php';
session_destroy();
die(header("location:../index.php"));
?>