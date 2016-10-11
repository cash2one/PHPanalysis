<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;



$whichpage = $_GET['whichpage'];
if(!$whichpage)
{
$notepage=1;
}
else
{
$notepage=$whichpage;
}
$pagesize=15;
$noterecs=($notepage-1)*$pagesize;

$query_st="select *  from  ".T_ADMIN_USER." ORDER BY uid asc";
$result=mysql_query($query_st);
$rsnum=mysql_num_rows($result);
$pagecount=ceil($rsnum/$pagesize);
mysql_data_seek($result,($notepage-1)*15);

$query_st="select * from ".T_ADMIN_USER." limit $noterecs,$pagesize";
$result=mysql_query($query_st);

while($rs = mysql_fetch_array($result)){
	$user_power = $rs['user_power'];
	$oneUser = AuthClass::getAuthority($user_power);
	$AllPurviews = '';
	if(is_array($oneUser))
    {
        foreach($oneUser as $value)
        {
            $AllPurviews .= $value['desc'].' ';
        }
        $AllPurviews = trim($AllPurviews);
    }
    $rs['desc'] = $AllPurviews;
    
    $agent_name = $AGENT_NAME;
    $agent_auth_array = explode(' ', $rs['agent_id']);
    $agent_auth = '';
    if(is_array($agent_auth_array))
    {
    	foreach($agent_auth_array as $v)
    	{
    		$agent_auth .= $agent_name[$v]. ' ';
    	}
    }
    $rs['agent_auth'] = $agent_auth;
    
   	$data[] = $rs;
}




$noterecs=$noterecs+1;


  $fisrt=1;
	$prev=$whichpage-1;
	$next=$whichpage+1;
	$last=$pagecount;

	 $start = "<a href='admin_list.php?whichpage=".$fisrt."'>首页</a></font>&nbsp;&nbsp";

if($whichpage>1)
	{
	 $start.= "<a href='admin_list.php?whichpage=".$prev."'>上一页</a> ";
  }

for($counter=1;$counter<=$pagecount;$counter++)
{
 $start.= ("<font size=+1 color=red><a href='admin_list.php?whichpage=$counter'>".$pad.$counter."</a></font>&nbsp;&nbsp;");
}

if($whichpage < $pagecount)
{
$start.= "<a href='admin_list.php?whichpage=".$next."'>下一页</a> ";
}
$start.= "<a href='admin_list.php?whichpage=".$pagecount."'>尾页</a> ";
$start.= "总页数（".$pagecount."）";
$start.= "共".$rsnum."条记录";

$smarty->assign("page",$start);
$smarty->assign("data",$data);
$smarty->display('module/backstat/admin_list.html');