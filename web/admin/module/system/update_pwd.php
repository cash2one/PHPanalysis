<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db, $auth;

$dopost = $_POST['dopost'];
if(empty($dopost)) $dopost='';
if($dopost == 'update')
{
	$username = $_SESSION['admin_user_name'];
	$password = trim($_POST['password']);
    $pass_word = strtolower(md5($password));
    $pwd = trim($_POST['pwd']);
    $pwd1 = trim($_POST['pwd1']);
    $query_st="select * from `t_admin_user_test` where `username`='$username'";
    $result=mysql_query($query_st);
    $rs = mysql_fetch_array($result);
    $passwd=strtolower($rs['passwd']);
    $uid=$rs['uid'];
	
    if($pass_word!=$passwd)
    {
    	errorExit("原密码不正确,请重新输入！");
    }
    else
    {
    	if($pwd!=$pwd1)
    	{
    		errorExit("两次输入新密码不一致，请重新输入！");
    	}
    	else
    	{
    		$pwd= md5($pwd);
	        $updateSql = 'UPDATE  `'.$dbConfig['dbname']."`.`t_admin_user_test` SET passwd = '".$pwd ."' where uid=".$uid;
            $row2 = $db->query($updateSql);
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_SYS_SET_PASSWORD,'', '','', $uid, $username);
            echo '<script language="javascript">window.alert("修改密码成功！");</script>';
            echo "<meta http-equiv=refresh content='1; url=update_pwd.php'>";
            exit();
    	}
    }
}
$smarty->assign("pass_word",$pass_word);
$smarty->assign("username",$username);
$smarty->assign("passwd",$passwd);
$smarty->display('module/system/update_pwd.html');

