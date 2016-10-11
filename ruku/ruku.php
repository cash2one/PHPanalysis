<?php
error_reporting(1);
include('ruku.config.php');
header('Content-type: text/html; charset=utf-8');
//ignore_user_abort();//函数设置与客户机断开是否会终止脚本执行
set_time_limit(0);//设置一个脚本的执行时间为无限长
//通过数组中的关键字确定日志该插入哪个表中
//$chars=array('OnlineRoleNum','Dungeon','ResourceChange','Battle', 'GamePlay', 'DungeonEnter','SpeedAbnormal', 'LogoutRole', 'YuanbaoUse','YuanbaoGain','Pvp','Levelup','HeroChange','UseSp','PvpEnter', 'GuildTask','Chat', 'EquipUp','ItemBuy', 'Friend','LoginRole', 'DailyCheckin','Guild', 'Prepaid', 'RechargeIngotInfo','CreateRole','Message','Package','Mail','Phone','Survey','Specialcoin');
$inputs=array('OnlineRoleNum','Dungeon','LogoutRole','LoginRole','YuanbaoUse','Prepaid', 'RechargeIngotInfo');

/*====================== 数据库连接池 ========================= */
$sql_serlist='SELECT svr_id FROM serverlists';//获取服务器列表
$conn=mysqli_connect($svr_host,$svr_username,$svr_password,$svr_dbname,$svr_port);//连接对应数据库
mysqli_set_charset($conn,'utf8');
$result=mysqli_query($conn,$sql_serlist);
$row=array();
$rows=array();
while($row=mysqli_fetch_array($result)){
   array_push($rows,$row[0]);
}
$conn=array();
for($i=0;$i<=count($rows)-1;$i++){
    $db=$DBpre.$rows[$i];
    $conn[$rows[$i]]=mysqli_connect($Host,$Username,$Password,$db,$Port);//连接对应数据库
    if($conn[$rows[$i]]){
        mysqli_set_charset($conn[$rows[$i]],'utf8');
    }else{
        $ruku_sql_err_log='ruku_sql_err_log.txt';
        $err=date("Y-m-d H:i:s",time()).' 数据库：'.$db.' 连接失败,可能因为数据库与服务器列表不一致！'."\r\n";
        //file_put_contents($ruku_sql_err_log, $err, FILE_APPEND | LOCK_EX);//记录错误
        error_log($err,3,$ruku_sql_err_log);//记录错误
    }
    
}

/*============= 数据的解析与入库 ================*/
if(is_dir($filedir)){
    foreach(get_files($filedir) as $filename){
        $file_name=basename($filename);//获取文件名，包含完整路径
        $file_last_name=substr($file_name,-17);//获取文件名的时间部分
        if($file_last_name!==$now_file_name){//如果不是正在产生的文件则读取
            $err_file=$err_aimUrl;
            $right_file=$right_aimUrl;
            $err_file=$err_aimUrl.'/'.$file_name;//执行中出错文件存放位置
            $right_file=$right_aimUrl.'/'.$file_name;//执行中没出错的文件存放位置

            $contents=str_replace(' ','',file_get_contents($filename));//读取文件内容并去除文件中所有空格
            $contents=preg_replace('/\n|\r\n/',' ',$contents);//使用空格替换文件中所有换行符
            $handle=explode(' ',$contents);//将字符串以空格为分隔符打散为数组
            //循环对比一行数据中的关键字，确定该行数据应该插入到对应数据表
            for($i=0;$i<=count($handle)-1;$i++){
                preg_match("/\[[a-zA-Z]+\]/",$handle[$i],$dbtable);//匹配一段字符串并将其取到$dbtable变量中，格式为：[ResourceChange]
                preg_match("/\"server\":[1-9]+/",$handle[$i],$server);//匹配到服务器
                $server=substr($server[0],9);//取出服务器，格式为 "server":1
                $svr_id=intval($server);//将服务器ID转为整型
                $dbtable=substr($dbtable[0],1,-1);//取出关键字(表名)
                if(in_array($dbtable,$inputs)){
                    $content=strstr($handle[$i],'{');//取出第一个'{’到最后一个字符的字符串（要导入的json数据）
                    $dbtable='xy_'.strtolower($dbtable); //确定表名
                    $sql=Array2InsertDB($content,$dbtable);
                    if(!$conn[$svr_id] || !$sql){//如果没有该数据库或者sql语句生成失败
                        $ruku_err_log=$err_aimUrl.'/ruku_err_log.txt';
                        $person=date("Y-m-d H:i:s",time()).$err_file.' 第'.$i.'行日志出现异常(可能是日志缺陷或者数据库与服务器列表不一致导致)'."\r\n";
                        file_put_contents($ruku_err_log, $person, FILE_APPEND | LOCK_EX);//记录错误
                        moveFile($filename,$err_file,false);//执行出错，移动到错入记录目录
                    }else if(!mysqli_query($conn[$svr_id],$sql)){//如果插入数据库出错
                        $ruku_err_log=$err_aimUrl.'/ruku_err_log.txt';
                        $person=date("Y-m-d H:i:s",time()).$err_file.' 第'.$i.'行日志出现未知异常'."\r\n";
                        file_put_contents($ruku_err_log, $person, FILE_APPEND | LOCK_EX);//记录错误
                        moveFile($filename,$err_file,false);//执行出错，移动到错入记录目录
                    }   
                }
            }
            moveFile($filename,$right_file,false);//插入数据库过程中没出错则移动到正确文件存放目录
        }
    } 
}else{
    exit;
}

/*===========  创建目录存放已经执行过得文件   暂时未采用 ==============================*/
function forcemkdir($path){
    $path=dirname($path);
    if(!file_exists($path)){
        mkdir($path,0777);
    }
}
/*=====================获取目录下所有文件================*/
function get_files($dir){
    $files = array();
    if(is_dir($dir)){
        if($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false) {
                if(!($file == '.' || $file == '..')){
                    $file = $dir.'/'.$file;
                    if(is_dir($file) && $file != './.' && $file != './..'){
                        $files = array_merge($files, get_files($file));
                    }
                    else if(is_file($file)){
                        $fullpath = $_SERVER['HTTP_REFERER'];
                        $fullpath = str_replace(basename($fullpath),"",$fullpath);
                        $fullpath .= substr($file,2);//windows下去掉盘符，linux环境下改为 $fullpath .=$file;
                        $files[] = $fullpath;
                    }
                }
            }
        }
    }
    return $files;
}

/*======================   字符串转码    ========================*/
function fixEncoding($in_str){
    $cur_encoding = mb_detect_encoding($in_str) ;
    if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8")){
        return $in_str;
    }
    else{
        return iconv("GBK","UTF-8",$in_str);
       // return utf8_encode($in_str);//ISO-8859-1 编码的字符串转换为 UTF-8 编码
    }
}

/*==================  数组解析函数  参数依次为：解析的内容，插入的表 ===========================*/
function Array2InsertDB($content,$table){
    $str_k='';
    $str_v='';
    $data=fixEncoding($content);
    $json=json_decode($data,true);
    foreach($json as $key=>$value)
    {
         if(is_array($value)){
             $value=json_encode($value);
        }
        $str_k .="$key,";
        $str_v .="'{$value}',";
    } 
    if($str_k=='' || $str_v==''){
        return false;
    }else{
        $str = "INSERT INTO $table (".trim($str_k,',').") VALUES (".trim($str_v, ',') . ")";
        return $str;
    }

}

/*=================    移动文件   =========================*/
function moveFile($fileUrl, $aimUrl, $overWrite = false) {//$overWrite 该参数控制是否覆盖原文件
        if (!file_exists($fileUrl)) {
            return false;
        }
        if (file_exists($aimUrl) && $overWrite = false) {
            return false;
        } elseif (file_exists($aimUrl) && $overWrite = true) {
            unlink($aimUrl);
            return true;
        }
        rename($fileUrl, $aimUrl);
        return true;
}

?> 