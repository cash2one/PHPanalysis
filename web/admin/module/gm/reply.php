<?php
define ( 'IN_DATANG_SYSTEM', true );
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN . "/include/global.php";
global $smarty, $db;

    $id=trim ($_POST ['id']);
	$role_id = trim ($_POST ['role_id']);
    $role_name = trim ( $_POST ['role_name']);
    $page = trim ( $_POST ['page']);

	if ($role_id == '' && $role_name == '') {
		errorExit ( "角色id和角色名不能同时为空" );
	}

	//清除空格
	$role_id = preg_replace('/\s/', '', $role_id);
	#$role_name = preg_replace('/\s/', '', $role_name);
	//将中文逗号替换成英文逗号
	$role_id = str_replace("，", ",", $role_id);
	#$role_name = str_replace("，", ",", $role_name);

	$content = trim ( $_POST ['content'] );
	if ($content == '') {
		errorExit ( "信件内容不能为空" );
	}
	$role_name_log = $role_name;
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);

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
        $loger->Log( AdminLogClass::TYPE_REPLY_COMPLAINT, $content_log, '', '', $role_id, $role_name_log);

        $updateSql = 'UPDATE  `'.$dbConfig['dbname'].'`.`t_GM_Complaint` SET `state` = 1, reply =  \'' .
			urldecode($content) .
			'\' where id='.$id.'';
        @$row2 = $db->fetchAll($updateSql);
        echo "<script language='javascript'> alert('回复成功');location.href='gm_complaint.php?page={$page}' </script>";

	} else {
		infoExit ( "回复送失败" );
	}


