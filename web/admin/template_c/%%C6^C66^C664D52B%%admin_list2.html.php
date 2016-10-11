<?php /* Smarty version 2.6.25, created on 2016-06-20 17:18:36
         compiled from module/backstat/admin_list2.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
        <title><?php echo $this->_tpl_vars['_lang']['left']['admin_list_user']; ?>
</title>
        <link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css"/>
        <link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css"/>
        <style type="text/css">

            #all {text-align:left;margin-left:4px; line-height:1;}
            #nodes {width:100%; float:left;border:1px #ccc solid;}
            #result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

        </style>
        <script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
    </head>
    <body>
        <div id="all">
            <div id="position"><?php echo $this->_tpl_vars['_lang']['left']['admin_manage']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['admin_list_user']; ?>
</div>
            <div id="main">
                <table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                    <tr bgcolor="#E5F9FF">
                        <td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
                            <font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['note']; ?>
</b></font>
                        </td>
                    </tr>
                    <tr bgcolor="#E5F9FF" align="left">
                        <td><?php echo $this->_tpl_vars['_lang']['left']['admin_list_user_note1']; ?>
</td>
                    </tr>
                    <tr bgcolor="#E5F9FF" align="left">
                        <td><?php echo $this->_tpl_vars['_lang']['left']['admin_list_user_note2']; ?>
</td>
                    </tr>
                    
                </table>
                <p></p>
                <input type=button value="<?php echo $this->_tpl_vars['_lang']['left']['new_manage']; ?>
" onclick="window.location='admin_manage.php?action=new'"/>
                <table id="group" width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                    <tr class="table_list_head">
                        <th><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</th>
                        <th><?php echo $this->_tpl_vars['_lang']['left']['descript']; ?>
</th>
                        <th><?php echo $this->_tpl_vars['_lang']['left']['group_name']; ?>
</th>
                        <th><?php echo $this->_tpl_vars['_lang']['left']['agent_list']; ?>
</th>
                        <th><?php echo $this->_tpl_vars['_lang']['left']['function']; ?>
</th>
                    </tr>
                    <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>                   
                    <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
                    <tr class='trEven'>
                        <?php else: ?>
                        <tr class='trOdd'>
                            <?php endif; ?>
                            <td width="10%"><?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['username']; ?>
</td>
                            <td width="10%"><?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['admin_desc']; ?>
 </td>
                            <td width="10%"><a href='group_manage.php?action=update&gid=<?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['gid']; ?>
'><?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['gname']; ?>
</a></td>
                            <td width="50%"><?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['agent_auth']; ?>
</td>
                            <td width="10%"><a href="admin_manage.php?action=update&uid=<?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['uid']; ?>
&whichpage=<?php echo $this->_tpl_vars['whichpage']; ?>
"><?php echo $this->_tpl_vars['_lang']['left']['update']; ?>
</a> /
                                <a href='admin_list2.php?action=delete&uid=<?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['uid']; ?>
&username=<?php echo $this->_tpl_vars['data'][$this->_sections['loop']['index']]['username']; ?>
&whichpage=<?php echo $this->_tpl_vars['whichpage']; ?>
'><?php echo $this->_tpl_vars['_lang']['conmon']['delete']; ?>
</a>
                            </td>
                        </tr>
                        <?php endfor; endif; ?>
                </table>
                <div ><center>
                        <?php echo $this->_tpl_vars['page']; ?>

                    </center>
                </div>
            </div>
        </div>
    </body>
</html>