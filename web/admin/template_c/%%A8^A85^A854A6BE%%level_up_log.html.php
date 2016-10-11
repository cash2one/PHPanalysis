<?php /* Smarty version 2.6.25, created on 2016-05-21 14:56:01
         compiled from module/analysis/level_up_log.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/analysis/level_up_log.html', 113, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_record']; ?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">
#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}
</style>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#role_name").val('');
			$("#account_name").val('');
		});
		$("#role_name").keydown(function(){
			$("#role_id").val('');
			$("#account_name").val('');
		});
		$("#account_name").keydown(function(){
			$("#role_id").val('');
			$("#role_name").val('');
		});
	});
</script>
</head>

<body>
	<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['data_analysis']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_record']; ?>
</div>

	<form action="?action=search" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
：</td>
			<td><input type="text" name="role_id" id="role_id" value="<?php echo $this->_tpl_vars['role']['role_id']; ?>
" /></td>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
：</td>
			<td><input type="text" name="role_name" id="role_name" value="<?php echo $this->_tpl_vars['role']['role_name']; ?>
" /></td>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
：</td>
			<td><input type="text" name="account_name" id="account_name" value="<?php echo $this->_tpl_vars['role']['account_name']; ?>
" /></td>
			<td><input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
	</form>
	<?php if ($this->_tpl_vars['role']): ?>
		<table class='paystat' style="width:57%">
			<tr class='table_list_head'>
				<td>角色ID</td>
				<td>角色名</td>
				<td>用户名</td>
				<td>操作</td>
			</tr>
			<?php $_from = ($this->_tpl_vars['role']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val']):
?>
			<tr class="trOdd">
				<td><?php echo $this->_tpl_vars['val']['role_id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['val']['role_name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['val']['account_name']; ?>
</td>
				<td><a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?action=search&type=continue&role_id=<?php echo $this->_tpl_vars['val']['role_id']; ?>
&role_name=<?php echo $this->_tpl_vars['val']['role_id']; ?>
&account_name=<?php echo $this->_tpl_vars['val']['account_name']; ?>
">查询</a></td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endif; ?>
	<br>
	<table width="800"  border="0" cellpadding="4" cellspacing="1">
		<tr bgcolor="#E9EEF2">
			<td colspan="3" align="left">
				<font color="#006600"><b><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_record_alert']; ?>
</b></font>
			</td>
        </tr>
	</table>
	<br>
	<!-- 具体一个玩家的升级记录 -->
	<?php if ($this->_tpl_vars['level_data']): ?>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="3" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_record']; ?>
</b></font>
			</td>
        </tr>
	</table>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<!-- SECTION  START ------------------------ -->
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['level_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php if ($this->_sections['loop']['rownum'] % 20 == 1): ?>
			<tr class="table_list_head" align="center">
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['riginal_level']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['now_level']; ?>
</td>
                <td>转生等级</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_time']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_place']; ?>
</td>
			</tr>
		<?php endif; ?>
		<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
		<tr class='trEven'  align="center">
		<?php else: ?>
		<tr class='trOdd'  align="center">
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['old_level']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['new_level']-$this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['old_level'] > 1): ?><font color="red"><?php endif; ?><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['new_level']; ?>

			</td>
            <td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['reincarnation']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['mtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
			<td><?php echo $this->_tpl_vars['level_data'][$this->_sections['loop']['index']]['map_id']; ?>
</td>

		</tr>
		<?php endfor; else: ?>
		<?php endif; ?>
		<!-- SECTION  END -------------------------->
	</table>
	<br>
	<?php endif; ?>
    

	<!-- 升级有问题的玩家 -->
	<?php if ($this->_tpl_vars['wrong_level']): ?>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="3" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['upgrade_exception_record']; ?>
</b></font><font color="#000000"><b><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_record_note']; ?>
</b></font>
			</td>
        </tr>
	</table>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<!-- SECTION  START -------------------------->
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['wrong_level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php if ($this->_sections['loop']['rownum'] % 20 == 1): ?>
			<tr class="table_list_head" align="center">
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['riginal_level']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['now_level']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_time']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['user_upgrade_place']; ?>
</td>
			</tr>
		<?php endif; ?>
		<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
		<tr class='trEven'  align="center">
		<?php else: ?>
		<tr class='trOdd'  align="center">
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['old_level']; ?>
</td>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['new_level']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['mtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
			<td><?php echo $this->_tpl_vars['wrong_level'][$this->_sections['loop']['index']]['map_id']; ?>
</td>

		</tr>
		<?php endfor; else: ?>
		<?php endif; ?>
		<!-- SECTION  END -------------------------->
	</table>
	<?php endif; ?>

</body>
</html>