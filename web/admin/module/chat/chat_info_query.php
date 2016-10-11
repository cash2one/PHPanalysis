<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-11
 * 聊天记录查询
 */


define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$datetime = date("Y.n.j"); //十位数不带0
$date= date("Y.m.d");

if(isset($_REQUEST['datetime']))
{
	$datetime = strtotime(trim(SS($_REQUEST['datetime'])));
	$date = $datetime;
	$datetime = date("Y.n.j",$datetime);
}

$channel = trim(SS($_REQUEST['channel']));
if (empty($channel))
{
	$channel = "channel_world";
}

$per_page_record = LIST_PER_PAGE_RECORDS;
$pageno = getUrlParam('page');
$startno = ($pageno-1)*$per_page_record;
$endno = $startno+$per_page_record;

$filedir = "/data/logs/chat.server/logs/channel/".$datetime."/";

$chatlist = array();
$j = 0;

$count_result = 0;
for($i=0;$i<24;$i++)
{
	$filename = "";
	$filename .= $i.".1";

	if( !file_exists($filedir.$filename) )
	{
		continue;
	}

	$file_handle = fopen( $filedir.$filename, "r");
	while (!feof($file_handle))
	{
  		$line = fgets($file_handle);
  		if( strstr( $line,$channel ) )
  		{
  			$count_result++;
  			if( $count_result> $startno && $count_result <= $endno )
  			{
  				$line = strstr( $line,"rolename' => '" );
	  			$line = substr( $line,14 ); //rolename' => ' 共14个字节
	  			$rolename = substr( $line,0,strpos($line,"'" ) );
	  			//echo $rolename;
	  			$line = strstr( $line,"time' => '");
	  			$line = substr( $line,10 );
	  			$time = substr( $line,0,strpos($line,"'" ) );
	  			//echo $time;
	  			$line = strstr( $line,"msg' => '");
	  			$line = substr( $line,9 );
	  			$msg = substr( $line,0,strpos($line,"'" ) );
	  			//echo $msg;
	  			$chatlist[$j]['time'] = $time;
	  			$chatlist[$j]['rolename'] = $rolename;
	  			$chatlist[$j]['msg'] = $msg;
	  			$j++;
  			}

  		}
	}
	fclose($file_handle);
}

$pagelist = getPages($pageno, $count_result, $per_page_record );
$channeltype = getChannelType();

$smarty->assign("date", $date);
$smarty->assign("channelchoose", $channel);
$smarty->assign("channeltype", $channeltype);
$smarty->assign("chatlist", $chatlist);
$smarty->assign("record_count", $count_result);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/chat/chat_info_query.tpl");

function getChannelType()
{
	return array(
		"channel_world"  => '世界',
		"channel_family" => '帮会',
		"channel_team"  => '队伍',
		);
}



