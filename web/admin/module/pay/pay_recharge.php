<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 2015/6/15
 * Time: 15:02
 */


define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';
$type = $_REQUEST['type'];


if( $type == "action"){

    $count_name = $_REQUEST['count_name'];
    $role_id = $_REQUEST['role_id'];
    $money = $_REQUEST['pay_money'];
    $res = testAction($count_name, $role_id, $money, 0);
    if($res == 1){
        echo "<H1>充值成功</H1>";
        die();
    }elseif($res == -4){
        echo "<H1>测试充值已关闭</H2>";
        die();
    }else{
        echo "<H1>充值失败,系统错误</H2>";
        die();
    }

}else if($type == "ajax"){

    $countName = $_REQUEST['count_name'];
    $sql = "select role_id, role_name from `db_role_base_p` where account_name = '".$countName."';";
    $result = GFetchRowSet($sql);
    $json = encode($result);
    echo($json);
    return;

}

$smarty->display("module/pay/pay_recharge.html");

//========= function ==========
function encode($array){
    $str = urldecode(json_encode(url_encode($array)));
    return $str;
}

function url_encode($str) {
    if(is_array($str)) {
        foreach($str as $key=>$value) {
            $str[urlencode($key)] = url_encode($value);
        }
    } else {
        $str = urlencode($str);
    }
    return $str;
}

//curl 请求
function request_post($url = '', $post_data = array()) {
    if (empty($url) || empty($post_data)) {
        return false;
    }
    $o = "";
    foreach ( $post_data as $k => $v )
    {
        $o.= "$k=" . urlencode( $v ). "&" ;
    }
    $post_data = substr($o,0,-1);
    $postUrl = $url;
    $curlPost = $post_data;
    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);

    return $data;
}
/**
 *  pay_to_user  充值账号
 *  pay_money  充值额，人民币，单位：元
 *  pay_ticket  
 *  pay_gold 元宝数
 */
function testAction($countent_name,$role_id,$money,$ticket=0){
    $url = "http://127.0.0.1"."/web/api/pay_test.php";
    $pay_num = date('YmdHis'). rand(1000,9999);
    $post_data['pay_num']       = $pay_num;

    $post_data['pay_to_user']      = $countent_name;
    $post_data['role_id']   = $role_id;
    $post_data['pay_money'] = $money;
    $post_data['pay_ticket']    = $ticket;
    $post_data['pay_gold']    = $money*10;

    $post_data['pay_time']    = time();
    //flag=md5(pay_num+pay_to_user+pay_money+pay_ticket+pay_gold+pay_time+key)
    //$post_data = array();
    $res = request_post($url, $post_data);
    return $res;
}
