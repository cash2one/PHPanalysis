<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db, $auth;

$dopost = $_POST['dopost'];
if(empty($dopost)) $dopost='';
if($dopost == 'add')
{
	$user_name = trim($_POST['username']);
	$pass_word = trim($_POST['passwd']);

	if (empty($user_name))
	{
		errorExit("用户名不能为空！");
	}
	if (empty($pass_word))
	{
		errorExit("密码不能为空！");
	}

	if(preg_match("#[^0-9a-zA-Z_@!\.-]#", $pass_word) || preg_match("#[^0-9a-zA-Z_@!\.-]#", $username))
    {
        errorExit("密码或用户名不合法，<br />请使用[0-9a-zA-Z_@!.-]内的字符！");
    }

    $sql = 'SELECT `username` FROM `t_admin_user`'
         . ' WHERE `username` = \''.$user_name.'\'';
    $row = $db->fetchAll($sql);
    if (count($row) > 0)
    {
    	errorExit("用户已存在！");
    }

    $AllPurviews = '';
    $purviews = $_POST['checkbox'];
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
    //echo $admin_desc;die();

	$insertSql = 'INSERT INTO `'.$dbConfig['dbname'].'`.`t_admin_user` (`uid`, `username`, `passwd`, `user_power`, `last_login_time`, `agent_id`, `admin_desc`) VALUES (NULL, \'' .
			$user_name .
			'\', \'' .
			$pass_word .
			'\', \'' .
			$AllPurviews .
			'\', \'\', \'' .
			$all_agent_auth .
			'\', \'' .
			$admin_desc .
			'\');';
//	echo $insertSql;die();
    @$row2 = $db->fetchAll($insertSql);
    $loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_SYS_CREATE_ADMIN,'', '','', '', $user_name);
    echo '<script language="javascript">window.alert("添加用户成功！");</script>';
    echo "<meta http-equiv=refresh content='1; url=admin_list.php'>";
    exit();
}

$user_power = $auth->getAuthorityList($buf_lang);
//print_r($AGENT_NAME);
//die();

$smarty->assign("user_power", $user_power);
$smarty->assign("agent_name", $AGENT_NAME);
$smarty->display('module/backstat/authority.html');
