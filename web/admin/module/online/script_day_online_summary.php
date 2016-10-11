<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$DELETE_TIME=30;
$now_date = date('Y-m-d');
$end = strtotime($now_date);
$start = $end-60*60*24;
$end--;
$result = $db->fetchAll('select * from t_log_online_day_summary');

$sql = "select max(online) as max,min(online) as min,avg(online) as avg,from_unixtime(`dateline`,'%Y-%m-%d') as date from t_log_online ";
if(!empty($result)){
    $sql .= "where dateline>$start and dateline<$end";
}
$sql .= ' group by date';
$data = $db->fetchAll($sql);

foreach($data as $v){
    $sql_insert = 'insert ignore into t_log_online_day_summary(max,min,avg,date) values('
                .$v['max'].','
                .$v['min'].','
                .$v['avg'].',"'
                .$v['date'].'")';
    $db->query($sql_insert);
}
$time = $DELETE_TIME-30*60*60*24;

$sql_delete = 'delete from t_log_online where dateline<'.$time;

$db->query($sql_delete);


