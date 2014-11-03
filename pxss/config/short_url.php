<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.13 19:0
 */
header("Content-type: text/html; charset=utf-8");
class url
{
    public $url;
    function short_url($url)
    {
      return  $this->baidu($url).$this->so985($url).$this->xco($url);
    }
    public function baidu($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://dwz.cn/create.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = array('url' => $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $strRes = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($strRes, true);
        if ($arrResponse['status'] == 0) {
            /**错误处理*/
            echo iconv('UTF-8', 'GBK', $arrResponse['err_msg']) . "\n";
        }
        /** tinyurl */
        mysql_query("UPDATE `pxss_users` SET `short_baidu`='{$arrResponse['tinyurl']}' WHERE `username`='{$_SESSION["user_name"]}'");
        return $arrResponse['tinyurl'];

    }
    
    public function so985($url)
    {
        $url=urlencode($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://985.so/api.php?url=$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $strRes = curl_exec($ch);
        curl_close($ch);
        mysql_query("UPDATE `pxss_users` SET `short_so985`='{$strRes}' WHERE `username`='{$_SESSION["user_name"]}'");
        return $strRes;
    }
    
    public function xco($url)
    {
        $url=urlencode($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.x.co/Squeeze.svc/text/e8eb7e1ef213472c88a71bdf58f1da4d?url=$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $strRes = curl_exec($ch);
        curl_close($ch);
        mysql_query("UPDATE `pxss_users` SET `short_xco`='{$strRes}' WHERE `username`='{$_SESSION["user_name"]}'");
        return $strRes;
    }

}

?>