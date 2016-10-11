<?php
define ( 'IN_DATANG_SYSTEM', true );
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN . "/include/global.php";
global $smarty, $db;


$id=$_GET['id'];
$query_st="select * from ".T_GM_COMPLAINT." where id='$id'";
$result=mysql_query($query_st);
$rs = mysql_fetch_array($result);
$roleid=$rs['roleid'];
$role_name=$rs['role_name'];


$action = trim ( $_GET ['action'] );
if ($action == 'do') {
	$role_id = trim ($_POST ['role_id']);
	$role_name = trim ( $_POST ['role_name']);

	if ($role_id == '' && $role_name == '') {
		errorExit ( "角色id和角色名不能同时为空" );
	}

	//清除空格
	$role_id = preg_replace('/\s/', '', $role_id);
	#$role_name = preg_replace('/\s/', '', $role_name);
	//将中文逗号替换成英文逗号
	$role_id = str_replace("，", ",", $role_id);
	#$role_name = str_replace("，", ",", $role_name);
	
	$role_name_log = $role_name;
	
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);

	$content = trim ( $_POST ['content'] );
	//$content = preg_replace('/\s/', '', $content);
	
	if ($content == '') {
		errorExit ( "信件内容不能为空" );
	}
	$content_log = $content;
	$content = str_replace("\\'", "'", $content); // 还原 '
    $content = str_replace("\\\"", "\"", $content);  // 还原 "
    $content = str_replace("\\\\", "\\", $content);  // 还原 \
    $content = urlencode($content);


	//发送信件
	$result = getJson ( $erlangWebAdminHost."email/send_email/" .
		"?role_id={$role_id}&role_name={$role_name}&content={$content}" );
	if ($result ['result'] == 'ok') {
		$loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_SEND_EMAIL,$content_log, '','', $role_id, $role_name_log);
		infoExit ( "信件发送成功" );
	} else {
		infoExit ( "信件发送失败" );
	}
}else if ($action == 'do2'){
	$low_level = trim($_POST['low_level']);
	$high_level = trim($_POST['high_level']);

	if ($low_level == ''){
		errorExit("最低等级不能为空");
	}
	if ($high_level == ''){
		errorExit("最高等级不能为空");
	}

	$low_level = intval($low_level);
	$high_level = intval($high_level);
    $str_role = $low_level.'级~'.$high_level.'级';
    
	$sql = 'SELECT `role_id` FROM `db_role_attr_p`'
         . ' WHERE `level` >= '.$low_level.' and `level` <= '.$high_level;
    $row = $db->fetchAll($sql);

	$role_id_list = '';
	$add_comma = false;
	for($i=0;$i<count($row);$i++)
	{
		if($add_comma)
		{
			$role_id_list .= ',';
		}
		$role_id_list .= $row[$i]['role_id'];
		$add_comma = true;
	}

	$content = trim ( $_POST ['content'] );
	if ($content == '') {
		errorExit ( "信件内容不能为空" );
	}
	
	$content_log = $content;
	$content = str_replace("\\'", "'", $content); // 还原 '
    $content = str_replace("\\\"", "\"", $content);  // 还原 "
    $content = str_replace("\\\\", "\\", $content);  // 还原 \
    $content = urlencode($content);
	
	$role_name = '';

	//发送信件
	$result = getJson ( $erlangWebAdminHost."email/send_email/" .
		"?role_id={$role_id_list}&role_name={$role_name}&content={$content}" );
	if ($result ['result'] == 'ok') {
		$loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_SEND_EMAIL_BY_CONDITION,$content, '','', '', $str_role);
		infoExit ( "信件发送成功" );
	} else {
		infoExit ( "信件发送失败" );
	}
}
$smarty->assign("id",$id);
$smarty->assign("roleid",$roleid);
$smarty->assign("role_name",$role_name);
$smarty->display ( 'module/pay/send_email.html' );

