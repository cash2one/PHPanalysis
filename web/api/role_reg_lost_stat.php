<?php
/**
 * 玩家注册流失数据接口
 * @author zengjintong
 * @date 2011.06.01
 * 传入参数：日期:YYYY-MM-DD
 * 返回：注册连接数，到达注册数，flash第一次加载数，未创建角色数，	点击页面数，点击进入游戏人数，回车提交人数
 */

define('IN_DATANG_SYSTEM', true);

include("../config/config.php");
include SYSDIR_ROOT_CLIENT.'config/config.key.php';

$datetime    = trim($_REQUEST['date']);           //查询时间
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
//$datetime = "2011-06-02";


if(empty($datetime)|| empty($time) || empty($flag) )
{
	echo json_encode("-1");
	exit;
}

else
{
	$token = md5($datetime.$time.$API_SECURITY_TICKEY_LOGIN);

	if($token != $flag )
	{
		echo json_encode("-2");
		exit;
	}
}

//注册连接数，到达注册数，flash第一次加载数，未创建角色数，点击页面数，点击进入游戏人数，回车提交人数
//1.到达页面数。
//2.加载完，进入角色数。
//3.创建完角色，进入游戏数


$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
$date = strtotime($datetime);
$year = date('Y', $date);
$month = date('n', $date);
$day = date('j', $date);

$filedir = "/data/logs/login.logs/".$year.".".$month.".".$day."/";

for($i=0;$i<24;$i++)
{
	for($j=1;$j<5000;$i++)  //一个小时最多5000个文件，文件名如1.1， 1.10
	{
		$filename = $filedir.$i.".".$j;

		if( !file_exists($filename) ) //文件不存在，说明这个小时已经没有日志文件了
		{
			break;
		}
		include "$filename";

		$countnum = count($log);
        for($k=0;$k<$countnum;$k++)
        {
            if( $log[$k]['where_id'] == 1 )
            {
            	$num1++;
            }
            else if( $log[$k]['where_id'] == 2 )
            {
            	$num2++;
            }
            else if( $log[$k]['where_id'] == 3 )
            {
            	$num3++;
            }
            else if( $log[$k]['where_id'] == 4 )
            {
            	$num4++;
            }
        }
	}
}
/*
echo $num1;	 		//注册连接数	从代理平台官网或者广告到游戏玩家信息审核页面玩家总数
echo " ";
echo $num1;  		//到达注册数
echo " ";
echo $num2;  		//flash第一次加载加载完， 开始创建角色
echo " ";
echo $num2-$num3;	//连接登录服务器 服务器返回未创建角色异常(连接服务器成功)
echo " ";
echo 0;				//加载完创建角色页面以后 玩家点击flash 页面事件
echo " ";
echo $num3;  		//点击“进入游戏”按钮  创建完角色
echo " ";
echo $num3;			//回车提交 相当于 点击进入游戏 按钮
echo " ";
echo 0;				//单项百分比 本阶段与前一阶段之差除以注册连接数
echo " ";
echo 0;			 	//多项百分比 本阶段与注册连接数之差除以注册连接数
*/

$string = array ( 'num1'=> $num1, 'num2' => $num1,'num3' => $num2,'num4' => $num2-$num3,
'num5' => 0,'num6' => $num3,'num7' => $num3,'num8' => 0,'num9' => 0);

$result = json_encode($string);

echo($result);


