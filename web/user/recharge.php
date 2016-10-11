<?php

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
 *  pay_ticket  代金券，单位：Q点
 *  pay_gold 元宝数
 */
function testAction(){
        $url = 'http://192.168.8.195/web/api/pay.php';
        $pay_num = date('YmdHis'). rand(1000,9999);
        $post_data['pay_num']       = $pay_num;     //

        $post_data['pay_to_user']      = '360';     //充值账号名
        $post_data['pay_money'] = 100;              //
        $post_data['pay_ticket']    = 10;
        $post_data['pay_gold']    = 1000;
        
        $post_data['pay_time']    = time();
        //flag=md5(pay_num+pay_to_user+pay_money+pay_ticket+pay_gold+pay_time+key)
        //$post_data = array();
        $res = request_post($url, $post_data);       
        var_dump($res);

 }

testAction();
//$smarty->display("recharge.html");