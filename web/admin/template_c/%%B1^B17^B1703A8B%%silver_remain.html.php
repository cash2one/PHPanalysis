<?php /* Smarty version 2.6.25, created on 2016-05-21 11:25:07
         compiled from module/pay/silver_remain.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/pay/silver_remain.html', 74, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<title>
	<?php echo $this->_tpl_vars['_lang']['left']['last_silver_ranking']; ?>

</title>
</head>

<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['last_silver_ranking']; ?>
</div>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
<form method="get" action="">
 <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
 <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?page=<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['key']; ?>
</a><span style="width:5px;"></span>
 <?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['page_count'] > 0): ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['all_page']; ?>
(<?php echo $this->_tpl_vars['page_count']; ?>
)

<?php if ($this->_tpl_vars['page_count'] > 5): ?>
  <input name="page" type="text" class="text" size="3" maxlength="6">
  &nbsp;<input type="submit" class="button" name="Submit" value="GO">
<?php endif; ?>

[ <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?excel=true"><?php echo $this->_tpl_vars['_lang']['conmon']['out_excel']; ?>
</a> ]
<?php endif; ?>
<?php if ($this->_tpl_vars['record_count']): ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['total']; ?>
<?php echo $this->_tpl_vars['record_count']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['records']; ?>

<?php endif; ?>
</form>
    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
<form id="form1" name="form1" method="post" action="">
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
	<?php if ($this->_sections['loop']['rownum'] % 20 == 1): ?>
	<tr class='table_list_head'>
		<td><?php echo $this->_tpl_vars['_lang']['new']['rank']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
        <td><?php echo $this->_tpl_vars['_lang']['conmon']['reincarnation']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_level']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['new']['remain_silver']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['left']['offline_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['left']['last_offline_time']; ?>
</td>
	</tr>
	<?php endif; ?>

	<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
	<tr class='trEven'>
	<?php else: ?>
	<tr class='trOdd'>
	<?php endif; ?>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['reincarnation']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['level']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver']; ?>
</td>
		<td><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['is_online'] == 1): ?><font color="#0000FF"><?php echo $this->_tpl_vars['_lang']['conmon']['online']; ?>
</font><?php else: ?><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['left_day'] >= 3): ?><font color="red"><?php endif; ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['left_day']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['day']; ?>
<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['left_h_m']; ?>
<?php endif; ?></td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['last_offline_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
	</tr>
<?php endfor; else: ?>

<?php endif; ?>
<!-- SECTION  END -------------------------->

</form>
</table>

</body>
</html>