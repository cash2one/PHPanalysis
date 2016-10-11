<?php
session_start();
define('IN_DATANG_SYSTEM', true);
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
define('ROOT', dirname(__FILE__));
function dirtree($path) {
	$d = dir($path);
	$versionDirs = array();
	while(false !== ($v = $d->read())) {
		if($v == '.' || $v == '..') {
			continue;
		}

		if((string)intval($v) === $v) {
			$versionDirs[]  = $v;
		}
	}
	return $versionDirs;
}
$defaultHost = '我不知道这是什么,不填了';

if(!$_SESSION['host']) {
	$host = $defaultHost;
} else {
	$host = $_SESSION['host'];
}

$defaultCVS = 0;
if(!$_SESSION['cvs']) {
	$cvs = $defaultCVS;
} else {
	$cvs = $_SESSION['cvs'];
}

$versionDirs = dirtree(ROOT.'/user');
if(!empty($_POST)) {
	if(isset($_POST['account']) && trim($_POST['account']) != '') {
		$account = trim($_POST['account']);
		$time = time();
		$agentid = 1;
		$serverid = 10001;
		$fcm = $_POST['fcm'];
		$fcmTicket = $fcm;
		if(!$fcm) {
			$fcmTicket = '';	
		}
		$datakey = $API_SECURITY_TICKEY_LOGIN.$account.$time.$agentid.$serverid.$fcmTicket;
		$ticket = md5($datakey);
		
		$_SESSION['account_name'] = $account;
		$_SESSION['timestamp'] = $time;
		$_SESSION['agent_id'] = $agentid;
		$_SESSION['server_id'] = $serverid;
		$_SESSION['ticket'] = $ticket;
		$_SESSION['fcm'] = $fcmTicket;
		$_SESSION['host'] = '';
		$_SESSION['cvs'] = '';
		if(($_POST['conn_host'] && $_POST['conn_host'] != $defaultHost) && ($_POST['cvs'] && $_POST['cvs'] != $defaultCVS)) {
			$_SESSION['host'] = trim($_POST['conn_host']);
			$_SESSION['cvs'] = $_POST['cvs'];
		}
		header("location:./user/ming2good.php");
		exit;
	}
}

$gameConfig = file_exists('config/game.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
body{font-size:12px; color:#030;}
.block{text-align:left;width:400px;border:1px solid #cccccc; padding:20px;clear:both;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>明2快速登录</title>
</head>

<body>
<center>
<div class="block">
<form action="ming2good.php" method="post" enctype="multipart/form-data" target="_self">
	<?php
		if($gameConfig == false) {
			echo '<p><font color="red"><b>';
			echo '你未初始化脚本, 请使用script/init_dev_client.sh';
			echo '</b></font></p>';
		}
	?>
	<p><b>请输入账号:</b><input type="text" value="" name="account" /></p>
	<p><b>要连接的主机:</b><input type="text" name="conn_host" value="<?php echo $host;?>" name="host" style="width:200px" /></p>
	<p><b>要连接的版本号:</b>
	<select name="cvs">
		<option value="0" <?php if($cvs == 0) {?>selected<?php }?>>我不知道这是什么,不选择</option>
		<?php foreach($versionDirs as $dir) {?>
		<option value="<?php echo $dir;?>" <?php if($cvs == $dir) {?>selected<?php }?>>svn:<?php echo $dir;?></option>
		<?php }?>
	</select></p>
	<p><b>防沉迷测试:</b>
    <select name="fcm">
        <option value="0">不选择</option>
        <option value="1">通过</option>
        <option value="2">未通过</option>
    </select></p>
	<input type="submit" value="登录" />
</form>
</div>
</center>
</body>
</html>