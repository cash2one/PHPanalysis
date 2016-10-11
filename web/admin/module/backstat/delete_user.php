<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db, $auth;


   $uid=$_POST['uid'];
   $sql1 = 'SELECT * FROM `t_admin_user` '
        . ' where uid = ' .$uid;
   $row = GFetchRowOne($sql1); 
   
   $sql="delete from `t_admin_user` where `uid`='$uid'";
   $query=mysql_query($sql);
   if($query)
   {
   	$loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_SYS_DELETE_ADMIN,'', '','', $uid, $row['username']);
   	echo '<script language="javascript">window.alert("成功删除！");</script>';}
    else {echo '<script language="javascript">window.alert("删除不成功！");</script>';}
    echo "<meta http-equiv=refresh content='1; url=admin_list.php'>";