<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $gid = $_POST['gid'];
    $name = trim($_POST['name']);
    $remark = trim($_POST['remark']);
    $power = isset($_POST['power'])?$_POST['power']:array();
    $group_power = implode(' ',$power);
    $sql_check = 'select * from t_group where name="'.$name.'"';
    if($action != 'new')
        $sql_check .= 'and gid!='.$gid;
    $loger = new AdminLogClass();
    if(count($db->fetchAll($sql_check))>0)
        echo '<script language="javascript">window.alert("群组名重复，请重新填写");</script>';
    else {
        if($action == 'new'){
            $sql = 'insert into t_group (name,power,remark) value("' .$name. '","' .$group_power. '","'. $remark .'")';
            $type = AdminLogClass::TYPE_SYS_CREATE_ADMIN_GROUP;
        } else {
            $sql = 'update t_group set name="' .$name. '",power="'.$group_power.'",remark=" '.$remark.'"  where gid='.$gid;
            $type = AdminLogClass::TYPE_SYS_MODIFY_ADMIN_GROUP;
        }
        $db->query($sql);
        $loger->Log($type ,'', '','', $gid, $name);
        echo "<meta http-equiv=refresh content='1; url=group_list.php'>";
        exit();
    }
}

if(isset ($_GET['gid'])){
    $sql_group = 'select gid,name,power,remark from t_group where gid='.$_GET['gid'];
    $group = $db->fetchOne($sql_group);
    $name = $group['name'];
    $remark = $group['remark'];
    $gid = $group['gid'];
    $power = $group['power'];
    $power = AuthClass::getAuthority($power);
} else {
    $power = array();
}
$group_power = $auth->getAuthorityList($buf_lang);

foreach ($power as $key => $row)
{
	$id = $row['man_id'];
	$group_power[$id]['check_flag'] = '1';
}
foreach ($group_power as $row)
{
	if($row["man_type"] == "LOST_RATE")	$lost_rate[] = $row;
	if($row["man_type"] == "CONSUME_LOG") $consume_log[] = $row;
}

$smarty->assign("group_power", $group_power);
$smarty->assign("lost_rate", $lost_rate);
$smarty->assign("consume_log", $consume_log);
$smarty->assign('action',$_GET['action']);
$smarty->assign('gid',$_GET['gid']);
$smarty->assign('name',$name);
$smarty->assign('remark',$remark);
$smarty->display('module/backstat/group_manage.html');


