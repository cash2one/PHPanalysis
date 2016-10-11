<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";    

include SYSDIR_ADMIN."/include/global.php";
include SYSDIR_ADMIN."/class/broadcast.class.php";
global $smarty;

$action = trim($_GET['action']);
$broadcastClass = new BroadcastClass($erlangWebAdminHost);
//$a =    $broadcastClass->$m_szErlangNode;
if ($action == 'list') {
	$result = $broadcastClass -> listBroadcast();
	$smarty->assign ( array ('dataResultSet' => $result ));
	$smarty->display ( "module/broadcast/broadcast_message_list.html" );

} else if ($action == 'add') {
	$broadcastVo = $broadcastClass -> addBroadcast();
	$smarty->assign('broadcastVo', $broadcastVo);
	$smarty->assign('action', $action);
	$smarty->display ( "module/broadcast/broadcast_message_edit.html" );

} else if ($action == 'edit') {
	$id = trim($_GET['id']);
	$result = $broadcastClass -> editBroadcast($id,"id");
	$resultCode = $result["ResultCode"];
	$resultDesc = $result["ResultDesc"];
	$broadcastVo = $result["ResultData"];
	$smarty->assign('broadcastVo', $broadcastVo);
	$smarty->assign('action', $action);
	$smarty->assign('ResultCode', $ResultCode);
	$smarty->assign('ResultDesc', $ResultDesc);
	$smarty->display ( "module/broadcast/broadcast_message_edit.html" );

} else if ($action == 'show') {
	$id = trim($_GET['id']);
	$result = $broadcastClass -> showBroadcast($id,"id");
	$resultCode = $result["ResultCode"];
	$resultDesc = $result["ResultDesc"];
	$broadcastVo = $result["ResultData"];
	$smarty->assign('broadcastVo', $broadcastVo);
	$smarty->assign('action', $action);
	$smarty->assign('ResultCode', $ResultCode);
	$smarty->assign('ResultDesc', $ResultDesc);
	$smarty->display ( "module/broadcast/broadcast_message_edit.html" );

} else if($action == 'del'){
	$ids = trim($_GET['ids']);
	$result = $broadcastClass -> delBroadcast($ids,"id");
	$resultCode = $result["ResultCode"];
	$resultDesc = $result["ResultDesc"];
	$resultData = $result["ResultData"];
	$smarty->assign (array('dataResultSet' => $resultData));
	$smarty->assign('ResultCode', $ResultCode);
	$smarty->assign('ResultDesc', $ResultDesc);
	$smarty->display ( "module/broadcast/broadcast_message_list.html" );

}else if($action == 'save'){
	$id = trim($_GET['id']);
	$foreign_id = trim($_GET['foreign_id']);
	$type = trim($_GET['type']);
	$send_strategy = trim($_GET['send_strategy']);
	$start_date = trim($_GET['start_date']);
	$end_date = trim($_GET['end_date']);
	$start_time = trim($_GET['start_time']);
	$end_time = trim($_GET['end_time']);
	$interval = trim($_GET['interval']);
	$content = urlencode(base64_encode(stripslashes(trim($_GET['content']))));
	
	$result = $broadcastClass -> saveBroadcast($id,$foreign_id,$type,$send_strategy,$start_date,$end_date,$start_time,$end_time,$interval,$content);
	$resultCode = $result["ResultCode"];
	$resultDesc = $result["ResultDesc"];
	$broadcastVo = $result["ResultData"];
	$loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_MSG_BROADCAST,'', '','', '', '');
	$smarty->assign('ResultCode', $ResultCode);
	$smarty->assign('ResultDesc', $ResultDesc);
	$smarty->assign('action', $action);
	$smarty->assign('broadcastVo', $broadcastVo);
	$smarty->display ( "module/broadcast/broadcast_message_edit.html" );
}
else{
	$result = $broadcastClass -> listBroadcast();
	$smarty->assign (array('dataResultSet' => $result));
	$smarty->display ( "module/broadcast/broadcast_message_list.html" );
}



