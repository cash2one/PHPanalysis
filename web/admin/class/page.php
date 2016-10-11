<?php
function get_page_no($name='pid')
{
    $pageNo = intval($_REQUEST[$name]);//$name='page'
    $pageNo = ($pageNo < 1) ? 1 : $pageNo;
    return $pageNo;
}

function get_record_per_page()
{
    $defaultRecordPerPage = 20;
    if(isset($_POST['recordPerPage']) && $_POST['recordPerPage'] > 0)
        return $_POST['recordPerPage'];
    else
        return $defaultRecordPerPage;
}

function get_page_list($pageNo, $pageCnt)
{
    $pageList = array();
    //若结果集不足一页或刚好一页，这不需要分页
    if ($pageCnt < 2){
     return $pageList;
    }
    $maxShowPageAmount = 10;//分页数字从1到10展示
    $start = max(1, $pageNo - $maxShowPageAmount / 2);
    if(($end = $start + $maxShowPageAmount - 1) >= $pageCnt)
    {
        $end = $pageCnt;
        $start = max(1, $end - $maxShowPageAmount + 1);
    }
        $pageList['首页'] = 1;
        $pageList['上页'] = ($pageNo > 1) ? ($pageNo - 1) : 1;

    for ($i = $start; $i <= $end; $i++) 
                if ($i == $pageNo)
                        $pageList["<font color=red>{$i}</font>"] = $i;
                else
                        $pageList[$i] = $i;

        $pageList['下页'] = ($pageNo < $pageCnt) ? ($pageNo + 1) : $pageCnt;
        $pageList['末页'] = $pageCnt;
        return $pageList;
}

/*
 * 取得有过滤条件的数据
 */
function getDataList($sql, $pageNo, $recordPerPage)
{
        $startNum = ($pageNo - 1) * $recordPerPage;
        $sql .= " LIMIT {$startNum}, {$recordPerPage}";
       return $sql;

        /*$fetchResult =getresults($sql);
        if(!is_array($fetchResult)){
                $fetchResult = array();
        }
        foreach($fetchResult as $log)
            if($log['mtime']){
                $log['time_str'] = strftime('%D %T', $log['mtime']);
            }
        return $fetchResult;*/
}





 


?>