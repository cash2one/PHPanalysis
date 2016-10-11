<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/7/16
 * Time: 15:20
 */

class pages
{
    /**
     * @var int 页面显示数
     */
    private $pagesize = 0;

    /**
     * @var int  当前页码
     */
    private $page = 0;

    /**
     * @var int 总记录数
     */
    private $total = 0;

    /**
     * @var int 总页码数
     */
    private $pagenum = 0;

    /**
     * @var string  limit
     */
    private $limit;

    /**
     * @var string 地址
     */
    private $url;

    /**
     * @var int 两边保持数字分页量
     */
    private $bothnum;

    public function  __construct($_total, $_pagesize)
    {
        $this->total = $_total;
        $this->pagesize = $_pagesize;
        $this->pagenum = ceil($_total/$_pagesize);
        $this->page = $this->setPage();
        $this->limit = "limit " . ($this->page - 1) * $this->pagesize . "," . $this->pagesize;
        $this->url = $this->setUrl();
        $this->bothnum = 2;
    }

    private function setPage()
    {
        $num = $_REQUEST['page'];
        if(!empty($num) || $num>0){
            if($num > $this->pagenum){
                return $this->pagenum;
            }else{
                return $num;
            }
        }else{
            return 1;
        }
    }

    /**
     * 存在缺陷  只能处理有get方式的分页
     */
    private function setUrl()
    {
        $_url = $_SERVER['REQUEST_URI'];
        $_par = parse_url($_url);
        if(isset($_par['query'])){
            parse_str($_par['query'],$_query);
            unset($_query['page']);
            $_url = $_par['path'].'?'.http_build_query($_query);
        }
        return $_url;
    }

    private function pageList()
    {
        $_pagelist = '';
        for($i=$this->bothnum;$i>=1;$i--){
            $_page = $this->page-$i;
            if($_page<1) continue;
            $_pagelist .= '<a class="show_page" href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        $_pagelist .= '<span class="me">'.$this->page.'</span>';
        for($i=1;$i<=$this->bothnum;$i++){
            $_page = $this->page+$i;
            if($_page > $this->pagenum)break;
            $_pagelist .= '<a class="show_page" href="'.$this->url.'&page='.$_page.'">'.$_page.'</a>';
        }
        return $_pagelist;
    }

    private function first()
    {
        if($this->page > $this->bothnum+1){
            return '<a class="first_page" href="'.$this->url.'">首页</a>';
        }
    }

    private function prev()
    {
        if($this->page==1){
            return '<span class="disabled">上一页</span>';
        }
        return '<a class="prev_page" href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
    }

    private function next()
    {
        if ($this->page == $this->pagenum) {
            return '<span class="disabled">下一页</span>';
        }
        return ' <a class="next_page" href="'.$this->url.'&page='.($this->page+1).'">下一页</a> ';
    }
    //尾页
    private function last()
    {
        if ($this->pagenum - $this->page > $this->bothnum) {
            return ' ...<a class="last_page" href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a> ';
        }
    }

    public function showpage()
    {
        $_page = '';
        $_page .= $this->first();
        $_page .= $this->prev();
        $_page .= $this->pageList();
        $_page .= $this->last();
        $_page .= $this->next();
        return $_page;
    }

    public function getLimit()
    {
        return $this->limit;
    }
}
