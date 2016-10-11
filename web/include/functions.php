<?php
/**
 * 函数功能集合
 */

function getWebJson($urlPath)
{
	global $smarty, $erlangWebAdminHost;
	$result = @ file_get_contents($erlangWebAdminHost.$urlPath);
	if ($result) {
		return json_decode($result, true);
	}
}

/*
 * 过滤$name中的 ' " \
 */
function urlString($name){
    $name = str_replace("\\'", "'", $name); // 还原 '
    $name = str_replace("\\\"", "\"", $name);  // 还原 "
    $name = str_replace("\\\\", "\\", $name);  // 还原 \
    $name = urlencode($name);
    return $name;
}


//递归实现数组内所有元素urlencode
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


function encode($array){
    $str = urldecode(json_encode(url_encode($array)));
    return $str;
}