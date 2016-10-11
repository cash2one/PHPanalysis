<?php /* Smarty version 2.6.25, created on 2016-05-21 14:56:07
         compiled from module/register/today.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'module/register/today.html', 52, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['register_statistics']; ?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
</script>
</head>

<body>
	<div id="all">
		<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['online_register']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['register_statistics']; ?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                <form name="myform" action="?type=zonghe" method="post" >
                <?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $this->_tpl_vars['start']; ?>
'/>
                &nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $this->_tpl_vars['end']; ?>
'/>
                &nbsp;<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/>
                </form>
                <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="2" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['current_register_info_statistics']; ?>
</b></font>
                            </td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['register_total']; ?>
：</td>
                          <td width="75%"><?php echo $this->_tpl_vars['account_count']; ?>
</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['current_accounts_num']; ?>
：</td>
                          <td width="75%"><?php echo $this->_tpl_vars['HaveRoleAccount']; ?>
---------<?php echo $this->_tpl_vars['_lang']['left']['creat_role_lose_rate']; ?>
(<?php echo $this->_tpl_vars['HaveRoleAccountload']; ?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['current_role_num']; ?>
：</td>
                          <td width="75%"><?php echo $this->_tpl_vars['role_count']; ?>
</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['wei_users']; ?>
：</td>
                          <td width="75%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['role_count_of_wei'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
(<?php echo $this->_tpl_vars['role_count_of_wei']/$this->_tpl_vars['role_count']; ?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['shu_users']; ?>
：</td>
                          <td width="75%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['role_count_of_shu'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
(<?php echo $this->_tpl_vars['role_count_of_shu']/$this->_tpl_vars['role_count']; ?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['wu_users']; ?>
：</td>
                          <td width="75%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['role_count_of_wu'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
(<?php echo $this->_tpl_vars['role_count_of_wu']/$this->_tpl_vars['role_count']; ?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['no_users']; ?>
：</td>
                          <td width="75%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['role_count_of_no'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
(<?php echo $this->_tpl_vars['role_count_of_no']/$this->_tpl_vars['role_count']; ?>
)</td>
                        </tr>
                     </table>


                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr class='table_list_head'>
                            <td><?php echo $this->_tpl_vars['_lang']['conmon']['year']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['conmon']['month']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['conmon']['hour']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['left']['register_accounts']; ?>
</td>
                        </tr>

                    <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['keywordlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

                        <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['day'] == null || $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month'] == null || $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year'] == null || $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['hour'] == null): ?>
                        <tr bgcolor="#E5F9FF" align="center">
                        <?php else: ?>
                        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
                        <tr class='trEven'>
                        <?php else: ?>
                        <tr class='trOdd'>
                        <?php endif; ?>
                        <?php endif; ?>
                            <td>
                            <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year'] == null): ?><?php echo $this->_tpl_vars['_lang']['new']['all_result_data']; ?>

                            <?php else: ?>
                            <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year']; ?>

                            <?php endif; ?>
                            </td><td>
                            <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['day'] == null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month'] == null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year'] != null): ?><?php echo $this->_tpl_vars['_lang']['conmon']['year']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['all']; ?>

                            <?php else: ?>
                            <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month']; ?>

                            <?php endif; ?>
                            </td><td>
                            <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['day'] == null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month'] != null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year'] != null): ?><?php echo $this->_tpl_vars['_lang']['conmon']['month']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['all']; ?>

                            <?php else: ?>
                            <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['day']; ?>

                            <?php endif; ?>
                            </td><td>
                            <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['hour'] == null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['day'] !== null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month'] != null && $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year'] != null): ?><?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['all']; ?>

                            <?php else: ?>
                            <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['hour']; ?>

                            <?php endif; ?>
                            </td><td>
                            <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['c']; ?>

                            </td>
                        </tr>
                    <?php endfor; else: ?>

                    <?php endif; ?>

                    </table>
                </div>
            </div>
        </div>
	</div>



</body>
</html>