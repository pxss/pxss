<?php
header("Content-Type:text/html;charset=utf-8");  
function getIP() { 
if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) 
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
else if (@$_SERVER["HTTP_CLIENT_IP"]) 
$ip = $_SERVER["HTTP_CLIENT_IP"]; 
else if (@$_SERVER["REMOTE_ADDR"]) 
$ip = $_SERVER["REMOTE_ADDR"]; 
else if (@getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if (@getenv("HTTP_CLIENT_IP")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if (@getenv("REMOTE_ADDR")) 
$ip = getenv("REMOTE_ADDR"); 
else 
$ip = "Unknown"; 
return $ip; 
}
 function lang()
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
        if (preg_match("/zh-c/i", $lang))
            $yy = "chinese";
        else
            if (preg_match("/zh/i", $lang))
                $yy = "traditional chinese";
            else
                if (preg_match("/en/i", $lang))
                    $yy = "English";
                else
                    if (preg_match("/fr/i", $lang))
                        $yy = "French";
                    else
                        if (preg_match("/de/i", $lang))
                            $yy = "German";
                        else
                            if (preg_match("/jp/i", $lang))
                                $yy = "Japanese";
                            else
                                if (preg_match("/ko/i", $lang))
                                    $yy = "Korean";
                                else
                                    if (preg_match("/es/i", $lang))
                                        $yy = "Spanish";
                                    else
                                        if (preg_match("/sv/i", $lang))
                                            $yy = "Swedish";
                                        else
                                            $yy = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
        return $yy;
    }
?>






