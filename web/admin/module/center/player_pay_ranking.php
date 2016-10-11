<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';

global $smarty, $db;


//echo $dStartTime;echo "<br>";
//echo $dEndTime;echo "<br>";
//echo $lastDay;echo "<br>";
//echo $lastWeek;echo "<br>";


$radio_agent = isset($_REQUEST['radio_agent']) ? $_REQUEST['radio_agent'] :0;
$radio_server = isset($_REQUEST['radio_server'] )?$_REQUEST['radio_server'] :0;
$cost_money = isset($_REQUEST['cost_money'])&&$_REQUEST['cost_money']!=null?$_REQUEST['cost_money'] :3000;
$flag = true;
if($_REQUEST['account_name']==null)
    $flag = false;

$account_name = $_REQUEST['account_name'];

$whichpage = $_REQUEST['whichpage'];
if(!$whichpage) {
    $whichpage=$notepage=1;
}
else {
    $notepage=$whichpage;
}
$pagesize=15;
$noterecs=($notepage-1)*$pagesize;


foreach($ALL_SERVER_LIST as $key=>$value) {
    if($key == 0) continue;
    foreach($value as $k=>$v) {
        $serStr = "S".$k;
        if($v['stat'] == 4)//未开
        {
            continue;
        }
        else if($v['stat'] == 2)//合服
        {
            $serStr .= "(合)";
        }
        else if($v['stat'] == 3)//关服
        {
            $serStr .= "(关)";
        }
        $servers[$key][$k] = $serStr;
    }
}
$where = '  where 1 ';
if($radio_agent!=0){
    $where .= '  and agent_id='.$radio_agent;
    $where .= $radio_server!=0? " and server_id=$radio_server ":' ';
}
if($flag)
$where .= ' and account_name="'.$account_name.'"  ';

$having =' having sum(money)>='.$cost_money;


$query_st="select count(account_name) from player_pay_ranking $where group by account_name  $having ";
$result=mysql_query($query_st);
$rsnum=mysql_num_rows($result);
$pagecount=ceil($rsnum/$pagesize);
//mysql_data_seek($result,($notepage-1)*15);
$query_st="select account_name,sum(money) as money,sum(gold_total) as account_gold from player_pay_ranking $where  group by account_name $having  order by money desc limit $noterecs,$pagesize";


$result=$db->fetchAll($query_st);
foreach($result as $key=>$value){
    if($key!=0) $account_name_list .=',';
    $account_name_list .= '"'.$value['account_name'].'"';
}
if(count($result)<1)
    $account_name_list = '"0"';
$sql = "select account_name,role_name,agent_id,server_id,level,gold,gold_total,last_login_time,last_pay_time from player_pay_ranking where account_name in($account_name_list)";
$role_data = $db->fetchAll($sql);

//echo time(),'<br>';
//echo substr('2011-09-25 12:32:07',0,10);
//echo strtotime('2011-09-25 12:32:07');


foreach( $role_data as $key=>$value) {
    $temp_data[$value['account_name']][] = $value;   
}

$head = '<tr align="center" height="25" font-size="12px" ><td><b>序号</b></td><td><b>金额</b></td><td><b>总元宝</b></td><td><b>账号</b></td><td><b>最后充值时间</b></td><td><b>最后登陆时间</b></td><td><b>角色名</b></td>
    <td><b>当前等级</b></td><td><b>身上元宝</b></td><td><b>累积充值元宝</b></td><td><b>报警</b></td></tr>';

foreach($result as $key => $value){
    $tr_class = $key%2==0?'class="tr_odd"':'class="tr_even"';
    $id = $whichpage+$key+1;
    $temp_role_data = $temp_data[$value['account_name']];
    $length = count($temp_role_data);
    $html .= '<tr '.$tr_class.' height="25"><td rowspan="'.$length.'">'.$id.'</td><td rowspan="'.$length.'">'.$value['money'].'</td><td rowspan="'.$length.'">'
    .$value['account_gold'].'</td><td rowspan="'.$length.'">'.$value['account_name'].'</td>';
    
    foreach($temp_role_data as $k=> $v){
        $agent_id = $v['agent_id'];
        $server_id =$v['server_id'];
        $role_name = $AGENT_NAME[$agent_id].'  S'. $server_id.'  '.$v['role_name'];
        
        if($ALL_SERVER_LIST[$agent_id][$server_id]['stat']!=1 || $v['last_login_time']==$v['last_pay_time']){
            $info = '已合服或合服后未登陆新服';           
        } else {

        $now = strtotime(date('Y-m-d'));
        $login_date = substr($v['last_login_time'], 0,10);

        $day = ($now-strtotime($login_date))/(60*60*24);
        if($day<=1) $info = '昨天已登陆';
        else if($day<=2) $info = '前天已登陆';
        else if($day<=3) $info  = '3天前登陆';
        else if($day<=5) $info = '<font color="blue">'.$day.'天前登陆</font>';
        else $info = '<font color="red">'.$day.'天前登陆</font>';
        }

        $td = '<td>'.$v['last_pay_time'].'</td><td>'.$v['last_login_time'].'</td><td>'.$role_name.'</td><td>'
        .$v['level'].'</td><td>'.$v['gold'].'</td><td>'.$v['gold_total'].'</td><td>'.$info.'</td>';
        if($k != 0)
            $td = '<tr '.$tr_class.' height="25">'.$td;
        $html .= $td.'</tr>';
    }
    
   
}
$tbody = $head.$html;






$get = "radio_agent=$radio_agent&radio_server=$radio_server&cost_money=$cost_money&account_name=$account_name&";

$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;
$start = "<a href='player_pay_ranking.php?$get"."whichpage=".$fisrt."'>首页</a></font>&nbsp;&nbsp";
if($whichpage>=1) {
    $start.= "<a href='player_pay_ranking.php?$get"."whichpage=".$prev."'>上一页</a> ";
}
for($counter=1;$counter<=5;$counter++) {
    $page_num=$whichpage+$counter;
    if($page_num>$pagecount)
        break;
    $start.= ("<font size=+1 color=red><a href='player_pay_ranking.php?$get"."whichpage=$page_num'>".$page_num."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $start.= "<a href='player_pay_ranking.php?$get"."whichpage=".$next."'>下一页</a> ";
}
$start.= "<a href='player_pay_ranking.php?$get"."whichpage=".$pagecount."'>尾页</a> ";
$start.= "总页数（".$pagecount."）";
$start.= "共".$rsnum."条记录";

$smarty->assign('whichpage',$whichpage);


$smarty->assign("page",$start);

$smarty->assign('account_name',$account_name);
$smarty->assign('cost_money',$cost_money);
$smarty->assign('agent_id',$radio_agent);
$smarty->assign('server_id',$radio_server);
$smarty->assign('tbody',$tbody);
$smarty->assign('servers',json_encode($servers));
$smarty->assign("allAgentName", $AGENT_NAME);


$smarty->display("module/center/player_pay_ranking.html");



