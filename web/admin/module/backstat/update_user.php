<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db, $auth;

$uid=trim($_GET['uid']);
$query_st="select * from ".T_ADMIN_USER." where uid='$uid'";
$result=mysql_query($query_st);
$rs = mysql_fetch_array($result);
$username=$rs['username'];
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
$data=$rs['desc'];

$agent_auth_array = explode(' ', $rs['agent_id']);
print_r($agent_auth_array);
$agent_name = $AGENT_NAME;
print_r($agent_name);
$agent_name_2 = array();
foreach($agent_name as $k => $v)
{
	$agent_name_2[$k]['id'] = $k;
	$agent_name_2[$k]['desc'] = $v;
	$agent_name_2[$k]['check_flag'] = 0;
}

foreach($agent_auth_array as $aid)
{
	$agent_name_2[$aid]['check_flag'] = 1;
}
//print_r($agent_name_2);

$dopost = $_POST['dopost'];
if(empty($dopost)) $dopost='';
if($dopost == 'add')
{
    $AllPurviews = '';
    $purviews = $_POST['checkbox'];
    print_r($purviews);
    if(is_array($purviews))
    {
        foreach($purviews as $pur)
        {
            $AllPurviews .= $pur.' ';
        }
        $AllPurviews = trim($AllPurviews);
    }

    $pass_word = md5($pass_word);
    
    $all_agent_auth = '';
    $agent_auth = $_POST['agent_check_box'];
    if(is_array($agent_auth))
    {
        foreach($agent_auth as $auth_num)
        {
            $all_agent_auth .= $auth_num.' ';
        }
        $all_agent_auth = trim($all_agent_auth);
    }
    
    $admin_desc = trim($_POST['admin_desc']);
    
//    echo $all_agent_auth."<br>";
//        echo $admin_desc."<br>";
//        die();
        
    $updateSql = 'UPDATE `'.$dbConfig['dbname'].'`.`'.T_ADMIN_USER.'` SET `user_power` = \'' .
    		$AllPurviews .
    		'\', `agent_id` = \'' .
    		$all_agent_auth .
    		'\', `admin_desc` = \'' .
    		$admin_desc .
    		'\' WHERE `'.T_ADMIN_USER.'`.`uid` ='.$uid.'';

//	$updateSql = 'UPDATE  `'.$dbConfig['dbname'].'`.`t_admin_user` SET user_power =  \'' .
//			$AllPurviews .
//			'\' where uid='.$uid.'';
    @$row2 = $db->fetchAll($updateSql);
    
   $sql1 = 'SELECT * FROM `'.T_ADMIN_USER.'` '
        . ' where uid = ' .$uid;
   $row = GFetchRowOne($sql1); 
   
    $loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_SYS_MODIFY_ADMIN,'', '','', $uid, $row['username']);
    echo '<script language="javascript">window.alert("修改用户信息成功！");</script>';
    echo "<meta http-equiv=refresh content='1; url=admin_list.php'>";
    exit();
}

$all_user_power = $auth->getAuthorityList($buf_lang);
foreach ($oneUser as $key => $row)
{
	$id = $row['man_id'];
	$all_user_power[$id]['check_flag'] = '1';
}


$smarty->assign("user_power", $all_user_power);

$smarty->assign("data",$data);
$smarty->assign("username",$username);
$smarty->assign("agent_name", $agent_name_2);
$smarty->assign("admin_desc", $rs['admin_desc']);
$smarty->display('module/backstat/update_user.html');


