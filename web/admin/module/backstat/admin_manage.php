<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $uid = $_POST['uid'];
    $username = trim($_POST['username']);
    $passwd = trim($_POST['passwd']);
    $gid = $_POST['gid'];
    if (empty($username)){
	errorExit("用户名不能为空！");
    }
    if (empty($passwd) && $action=='new'){
	errorExit("密码不能为空！");
    }

    if(preg_match("#[^0-9a-zA-Z]#", $passwd) || preg_match("#[^0-9a-zA-Z]#", $username))
    {
        errorExit("密码或用户名不合法，<br />请使用[0-9a-zA-Z]内的字符！");
    }
    if($passwd !=''){
        $passwd = md5($passwd);
        $sql_password = ",passwd='$passwd' ";
    } else
        $sql_password = '   ';
    $admin_desc = trim($_POST['admin_desc']);
    $agent = isset($_POST['agent'])?$_POST['agent']:array();
    $agent_id = implode(' ',$agent);    
    $sql_check = 'select * from '.T_ADMIN_USER.' where username="'.$username.'"';
    if($action != 'new')
        $sql_check .= 'and uid!='.$uid;
    $loger = new AdminLogClass();
    
    if(count($db->fetchAll($sql_check))>0)
        echo '<script language="javascript">window.alert("登陆名重复，请重新填写");</script>';
    else {
        if($action == 'new'){
            $sql_save = 'insert into '.T_ADMIN_USER.' ( `username`, `passwd`,`last_login_time`,`gid`, `agent_id`, `admin_desc`) value("' .$username. '","' .$passwd. '",0 ,"'.$gid. '","'.$agent_id. '","'. $admin_desc .'")';
            $loger->Log( AdminLogClass::TYPE_SYS_CREATE_ADMIN,'', 0,'', 0, $username);
        } else {

            $sql_save = 'update  '.T_ADMIN_USER."  set admin_desc='$admin_desc' ,gid=$gid,agent_id= '$agent_id'  $sql_password where uid=$uid";
            //echo $sql_save;exit;
            $loger->Log( AdminLogClass::TYPE_SYS_MODIFY_ADMIN,'',0,'', $uid, $username);
        }

        $db->query($sql_save);
        echo "<meta http-equiv=refresh content='1; url=admin_list2.php'>";
        exit();
    }
}

if($_GET['action']=='update'){
    $sql_admin = 'select uid,username, gid,agent_id,admin_desc from t_admin_user_test where uid='.$_GET['uid'];
    $admin = $db->fetchOne($sql_admin);
    $agent = explode(' ', $admin['agent_id']);
} else {
    $agent=array();
}
$agent_name = $AGENT_NAME;
$agent_name_2 = array();
foreach($agent_name as $k => $v)
{
	$agent_name_2[$k]['id'] = $k;
	$agent_name_2[$k]['desc'] = $v;
	$agent_name_2[$k]['check_flag'] = 0;
}

foreach($agent as $aid)
{
	$agent_name_2[$aid]['check_flag'] = 1;
}

$sql_group = 'select gid,name from t_group where 1';
$group = $db->fetchAll($sql_group);

$smarty->assign('action',$_GET['action']);
$smarty->assign('group',$group);
$smarty->assign('admin',$admin);
$smarty->assign("agent_name", $agent_name_2);
$smarty->display('module/backstat/admin_manage.html');
