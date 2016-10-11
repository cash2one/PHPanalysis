<?php /* Smarty version 2.6.25, created on 2016-05-21 11:23:56
         compiled from module/register/time_lost_rate.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/register/time_lost_rate.html', 18, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<title>
	<?php echo $this->_tpl_vars['_lang']['left']['time_lose_rate']; ?>

</title>
</head>

<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['loss_rate_analysis']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['time_lose_rate']; ?>
</div>
	<table width="100%" cellspacing="1" cellpadding="3" border="0" class='table_list'>
		<tr align='left'>
		<td colspan=9><?php echo $this->_tpl_vars['_lang']['conmon']['sys_time_now']; ?>
：<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
		</tr>
	</table>
<div style="float:left;margin:5px 0;">
	<form name="myform" method="post" >
	&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：
	<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='datestart' size='12' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
'/>
	&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：
	<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateend' size='12' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
'/>
	&nbsp;<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/>
	&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['left']['total_role_name']; ?>
：<font color="red"><b><?php echo $this->_tpl_vars['total_user']; ?>
</b></font>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['new']['roles_in_times']; ?>
：<font color="red"><b><?php echo $this->_tpl_vars['count_all_user']; ?>
</b></font>
	</form>
</div>
<br><br>
<div style='float:left;margin-right:5px;'>
	<table cellspacing=1 cellpadding=3 border=0 class='table_list' style='width:auto;'>
		<tr bgcolor="#A5D0F1">
			<td colspan=3><b><?php echo $this->_tpl_vars['_lang']['left']['one_day']; ?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td width="auto"><b><?php echo $this->_tpl_vars['_lang']['left']['finally_offline_time']; ?>
<font color="red"><?php echo $this->_tpl_vars['_lang']['left']['minus']; ?>
</font><?php echo $this->_tpl_vars['_lang']['conmon']['registered_time']; ?>
</b></td>
			<td width="100"><b><?php echo $this->_tpl_vars['_lang']['conmon']['people_num']; ?>
</b></td>
			<td width="100"><b><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</b></td>
		</tr>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['one_day_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo $this->_tpl_vars['one_day_result'][$this->_sections['loop']['index']]['desc']; ?>
</td>
		<td><?php echo $this->_tpl_vars['one_day_result'][$this->_sections['loop']['index']]['num']; ?>
</td>
		<td><?php echo $this->_tpl_vars['one_day_result'][$this->_sections['loop']['index']]['rate']; ?>
%</td>
		<tr>
		<?php endfor; endif; ?>
	</table>
</div>

<div style='float:left;'>
	<table cellspacing=1 cellpadding=3 border=0 class='table_list' style='width:auto;'>
		<tr bgcolor="#A5D0F1">
			<td colspan=3><b><?php echo $this->_tpl_vars['_lang']['left']['one_month']; ?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td width="auto"><b><?php echo $this->_tpl_vars['_lang']['left']['finally_offline_time']; ?>
<font color="red"><?php echo $this->_tpl_vars['_lang']['left']['minus']; ?>
</font><?php echo $this->_tpl_vars['_lang']['conmon']['registered_time']; ?>
</b></td>
           <td width="100"><b><?php echo $this->_tpl_vars['_lang']['conmon']['people_num']; ?>
</b></td>
			<td width="100"><b><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</b></td>
		</tr>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['one_month_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo $this->_tpl_vars['one_month_result'][$this->_sections['loop']['index']]['desc']; ?>
</td>
		<td><?php echo $this->_tpl_vars['one_month_result'][$this->_sections['loop']['index']]['num']; ?>
</td>
		<td><?php echo $this->_tpl_vars['one_month_result'][$this->_sections['loop']['index']]['rate']; ?>
%</td>
		<tr>
		<?php endfor; endif; ?>
	</table>
</div>


</body>
</html>