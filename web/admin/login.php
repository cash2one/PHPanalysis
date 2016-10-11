<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include "../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $auth;
$action2 = trim($_REQUEST['action2']);
$smarty->assign('agent_id', $AGENT_ID);

//if(isset($_COOKIE['dt'])){
//    $smarty->assign('username',strDecode($_COOKIE['dt']));
//    $smarty->assign('password',strDecode($_COOKIE['ok']));
//    $smarty->assign('checked',$_COOKIE['checked']);
//}

if ($action2 == 'change_server')
{
	$username = trim($_REQUEST['username']);
	$password = trim($_REQUEST['password']);
	
	if (($result = validUsername($username)) !== true) {
		$smarty->assign('errorMsg',$result);
		$smarty->display("login_new.html");
		exit();
	}
	if (($result = validPassword($password)) !== true) {
		$smarty->assign('errorMsg',$result);
		$smarty->display("login_new.html");
		exit();
	}
	if ($auth->changeServer($username, $password, $AGENT_ID)) {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_SYS_LOGIN,'', '','', '', '');
		//登录成功，跳转到首页
		header("Location:/web/admin/index.php");

		exit();
	} else {
		$errorMsg = "用户名或者密码错误，请重新输入";
		$smarty->assign('errorMsg',$result);
        header("Location:/web/admin/login.php");
        exit();
    }
}

$action = trim($_REQUEST['action']);
if ($action == 'login'){

//	if ($auth->alreadyLogin()) {
//		header("Location:/web/admin/index.php");
//		exit();
//	}
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$validation = trim($_POST['validation']);
	//$setcookie = $_POST['chkcookie'];
	
//	$code_flag = 0;
//	if($username=='yun_dt_7789'||$username=='7789_kefu_sl')
//		$code_flag =1;
//	if(!$code_flag) {

		if($validation != $_SESSION['code']) {
			$smarty->assign('errorMsg','验证码错误');
			$smarty->display('login_new.html');
			exit();
		}
//	}


	if (($result = validUsername($username)) !== true) {
		$smarty->assign('errorMsg',$result);
		$smarty->display("login_new.html");
		exit();
	}
	if (($result = validPassword($password)) !== true) {
		$smarty->assign('errorMsg',$result);
		$smarty->display("login_new.html");
		exit();
	}
	//echo 111;exit;
    $val = $auth->login($username, $password, $AGENT_ID);
    //var_dump($val);exit;
	if ($auth->login($username, $password, $AGENT_ID)) {
        //var_dump($_SESSION);exit;
        $loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_SYS_LOGIN,'登录', '1','登录', '0', 'null');
		//登录成功，跳转到首页
        //$setcookie == 1 ? savePasswd($setcookie,$username,$password) : savePasswd(0);
		
		header("Location:/web/admin/index.php");
		exit();
	} else {
		$errorMsg = "用户名或者密码错误，请重新输入";
		$smarty->assign('errorMsg',$errorMsg);
		$smarty->display("login_new.html");
		exit();
	}
} 
else
{   
	$smarty->display("login_new.html");
	exit();
//	//检查是否已经登录
//	if ($auth->auth()) {
//		header("Location:/web/admin/index.php");
//		exit();
//	} else {
//		$smarty->display("login.html");
//		exit();
//	}
}

function savePasswd($flag,$username,$password){
    if($flag == 1){
        setcookie(dt,strEndecode($username),time()+60*60*24*7);
        setcookie(ok,strEndecode($password),time()+60*60*24*7);
        setcookie(checked,1,time()+60*60*24*7);
    } else{
        setcookie(dt,$username,time()-1);
        setcookie(ok,$password,time()-1);
        setcookie(checked,0,time()-1);
    }
}
//cookie信息简单加密
function strEndecode($str){
    $str = strrev($str);
    $len = strlen($str);
    $result = 'dt';
    for($i=0; $i<$len; $i++){
        $result .= $str[$i];
        $result .=ucfirst(substr(md5($str[$i]),$i,3));
    }
    return $result;
}

//cookie信息解密
function strDecode($str){
    $len = strlen($str);
    $result = '';
    for($i=2; $i<$len; ){
        $result .=$str[$i];
        $i += 4;
    }
    $result = strrev($result);
    return $result;
}
