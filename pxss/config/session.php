<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.14 0:43
 */
 error_reporting(0);
 session_start();
 if (!isset($_SESSION["user_login"]) && $_SESSION["user_login"] !== true &&!isset($_SESSION["user_name"]) && $_SESSION["user_name"] !== true) {
    die(header("location:../index.php"));
    
    }
?>