<?php
//曲线图数据格式化处理函数 (多个服务器)
function all_curveCharts($results){
    $charts=array();
    $charts=getresults($results);//结果集转为数组
    foreach($charts as $key1=>$value1){//取出数组中的所有值
        foreach($value1 as $key2=>$value2){
            $role_level[]=$value2;
        }
    }
    return $role_level;
}

//曲线图数据格式化处理函数 (单个服务器)
function curveCharts($results){
        $charts=get_result($results);//结果集转为数组
        array_multisort($charts);//对数组进行排序
        $role_level_num=array_count_values($charts);//统计数组中所有的值出现的次数  '等级'=>'该等级的角色数'
        $end=end($role_level_num);//将数组的内部指针指向最后一个单元
        $endkey=key($role_level_num);//获得最后一个单元的键
        //将中间可能空缺的键值补上
        $transition=array();
        for($i=0;$i<=$endkey;$i++){
            array_push($transition, 0);
        }//构建一个等长数组，数字索引，值全部为零，为了解决数字数组不连续的情况
        $diff=array_diff_ukey($transition, $role_level_num, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集  
        $diff=array_keys($diff);//获取差集中所有的键
        //$result = array_merge($diff, $arr);
        $diff=array_fill_keys($diff,0);//用差集中的键填充数组，值全部为0
        $role_level_num=$role_level_num+$diff;//合并两个数组
        ksort($role_level_num);//对数组按照键名排序
        return $role_level_num;
}
function data_get($limit_result){
    $arr=array();
    $keys=array();
    $values=array();
    $id_num=array();
    $id_nums=array();
        $rows = array();
        while (($row = mysql_fetch_assoc($limit_result)) !== false) {
            array_push($rows, $row['role_level']);
        }
        $arr=array_count_values($rows);//统计数组中所有的值出现的次数（每个等级出现的次数   等级=>该等级角色数)
        ksort($arr);
        $keys=array_keys($arr);//获取$arr所有键名，以数字索引从新排列
        $values=array_values($arr);//获取$arr所有值，以数字索引从新排列
        for($i=0;$i<count($arr);$i++){
            $id_num=array('id'=>$keys[$i],'num'=>$values[$i]);//生成格式数组
            array_push($id_nums,$id_num);
        }
        $end=end($arr);//将数组的内部指针指向最后一个单元
        $endkey=key($arr);//获得最后一个单元的键
        //将中间可能空缺的键值补上
        $transition=array();
        for($i=0;$i<=$endkey;$i++){
            array_push($transition, 0);
        }//构建一个等长数组，数字索引，值全部为零，为了解决数字数组不连续的情况
        $diff=array_diff_ukey($transition, $arr, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集  
        $diff=array_keys($diff);//获取差集中所有的键
        //$result = array_merge($diff, $arr);
        $diff=array_fill_keys($diff,0);//用差集中的键填充数组，值全部为0
        $arr=$arr+$diff;//合并两个数组
        ksort($arr);//对数组按照键名排序
        
        $result_array=array('array_data'=>$id_nums,'json_data'=>$arr);
       return $result_array;
}
function key_compare_func($key1, $key2)
{
    if ($key1 == $key2)
        return 0;
    else if ($key1 > $key2)
        return 1;
    else
        return -1;
}       

//处理数据库结果集   
function get_result($query_result){
    if ($query_result) {
        $rows = array();
        while (($row = mysql_fetch_array($query_result)) !== false) {
            array_push($rows, $row[0]);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}



?>
