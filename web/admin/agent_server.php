<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ADMIN."/include/global.php";

$server_stat = array(
	1 => '',
	2 => '',
	3 => '',
	4 => '(未开)',
);

$bigid = $_GET["agentname"]; 
if(isset($bigid)){
	$server_list=$ALL_SERVER_LIST[$bigid];
	foreach($server_list as $key => $value)
	{
		$select[] = array("id"=>$value['url'], "title"=>$value['desc'].$server_stat[$value['stat']].$value['join']);
	}
    echo json_encode($select);
    die(); 
}

$sPlatName = $_REQUEST['sPlatName'];
if(isset($sPlatName))
{
	$allPlatServer = $ALL_SERVER_LIST[$sPlatName];
	if(!empty($allPlatServer))
	{
		$htmlStr = "";
		$htmlStr .= "<input name='sServerName' id='sServerName' value='allServer' checked='checked' onclick='Search();' type='radio'/>所有";
		foreach($allPlatServer as $k => $v)
		{
			$serStr = "S".$k;
			if($v['stat'] == 4)//未开
			{
				continue;
			}
			else if($v['stat'] == 2)//合服
			{
				$serStr .= "(合)";
			}
			else if($v['stat'] == 3)//关服
			{
				$serStr .= "(关)";
			}
			else if($v['stat'] == 5)//排期待开
			{
				$serStr .= $v['join'];
			}
			
			$serStr2 = "";
			if($v['stat'] == 1)  //已开，绿色标记，粗体
			{
				$serStr2 = "<b><font color='green'>{$serStr}</font></b>";
			}
			else
			{
				$serStr2 = $serStr;
			}
			
			$htmlStr .= "<input name='sServerName' id='sServerName' value='{$k}' onclick='Search();' type='radio'/>{$serStr2}";
		}
	}
	echo $htmlStr;
	die();
}
















