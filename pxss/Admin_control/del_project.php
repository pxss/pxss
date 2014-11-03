<?php

/**
 * @author: xiaoma
 * @blog  : www.i0day.com
 * @date  : 2014.10.12 10:31
 */

header("Content-type: text/html; charset=utf-8");
require_once '../config/mysql_conn.php';
require_once '../config/session.php';
$project_query = mysql_query("SELECT project_domain, count(distinct project_domain) FROM `pxss_project`  group by project_domain order by datetime desc")or die( "error: ".mysql_error());


?>
<script type="text/javascript">
 var oidStr="";
function testConfirmMsg(url,data){
    var id="id=";
	alertMsg.confirm("删除后将无法恢复，请选择确定或取消！", {
		okCall: function(a){
    	$.post(url,id+oidStr,function(data,status){
    	   if(status=='success'){
    	       
    	       if(data.indexOf("删除成功")>0){
    	           //alert(data);
                   document.write(data);
    	       }
    	       
    	   }
    	   
    	});

		}
	});
}

/*
function testConfirmMsg(url, data){
    var id="id=";
	alertMsg.confirm("删除后将无法恢复，请选择确定或取消！", {
		okCall: function(){
			$.post(url, id+oidStr, DWZ.ajaxDone, "json");
                   
		}
	});
}*/

function treeclick()  {  
    oidStr="";
  $("#t2 input:checked").each(function(i,a){  
   
    oidStr +=a.value+',';  
        $(":checked").hide();
  });  
  
 }  
 


</script> 

                    
<div class="pageContent" id="id">
	<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					
					<li><span>删除项目</span></li>
					
				</ul>
			</div>
		</div>
		<div class="tabsContent" style="height:515px;">
        
		<div class="pageContent sortDrag" selector="h1" layoutH="42">
     

<div id="t2"  >  
      <ul id="t1" class="tree treeFolder treeCheck expand" oncheck="treeclick">  

<?php
while ($pro_list_res = mysql_fetch_array($project_query)) {
    $domain=$pro_list_res['project_domain'];
    echo "<li><a tname=\"domain\">".base64_decode($pro_list_res['project_domain'])."</a>";
    $project_domain=mysql_query("SELECT * FROM `pxss_project` WHERE `project_domain`='{$domain}'  order by datetime desc");
    
    while($project_domain_res=mysql_fetch_array($project_domain)){
    echo "<ul> <li><a tname=\"ip\" tvalue=\"{$project_domain_res['pid']}\">".base64_decode($project_domain_res['project_ip'])."</a></li></ul>";
}

}
?>   <li>
		</ul>  
     </div>  
      
    </br> 
  
    <a class="button" href="javascript:;" onclick="testConfirmMsg('del_ok.php')"><span>确认删除（是/否）</span></a>
    
   

	</div>



		</div>
		<div class="tabsFooter">
			<div class="tabsFooterContent"></div>
		</div>
	</div>
		</div>
	<p>&nbsp;</p>
	
	
