<?php /* Smarty version 2.6.25, created on 2016-05-21 11:22:25
         compiled from module/register/reg_info_detail_query.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/register/reg_info_detail_query.html', 38, false),array('function', 'html_options', 'module/register/reg_info_detail_query.html', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
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

<title>
	<?php echo $this->_tpl_vars['_lang']['left']['log_statistics']; ?>

</title>
</head>


<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['online_register']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['registration_information']; ?>
</div>

<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
">
<?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='datestart' size='12' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateend' size='12' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['sort']; ?>

<select name="sort_1">
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sortoption'],'selected' => $this->_tpl_vars['search_sort_1']), $this);?>

</select>

<select name="sort_2">
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sortoption'],'selected' => $this->_tpl_vars['search_sort_2']), $this);?>

</select>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $this->_tpl_vars['role']['role_id']; ?>
" />
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
:<input type="text" id="role_name" name="role_name" size="10" value="<?php echo $this->_tpl_vars['role']['role_name']; ?>
" />
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
:<input type="text" id="account_name" name="account_name" size="10" value="<?php echo $this->_tpl_vars['role']['account_name']; ?>
" />
<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/>
&nbsp;&nbsp;&nbsp;
<?php if ($this->_tpl_vars['record_count']): ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['total']; ?>
<?php echo $this->_tpl_vars['record_count']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['records']; ?>

<?php endif; ?>
</form>
</div>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
<form method="get" action="">
 <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
 <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?datestart=<?php echo ((is_array($_tmp=$this->_tpl_vars['start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
&amp;dateend=<?php echo ((is_array($_tmp=$this->_tpl_vars['end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
&amp;sort_1=<?php echo $this->_tpl_vars['search_sort_1']; ?>
&amp;sort_2=<?php echo $this->_tpl_vars['search_sort_2']; ?>
&amp;page=<?php echo $this->_tpl_vars['item']; ?>
&amp;role_id=<?php echo $this->_tpl_vars['role']['role_id']; ?>
&amp;role_name=<?php echo $this->_tpl_vars['role']['role_name']; ?>
&amp;account_name=<?php echo $this->_tpl_vars['role']['account_name']; ?>
"><?php echo $this->_tpl_vars['key']; ?>
</a><span style="width:5px;"></span>
 <?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['page_count'] > 0): ?>

<?php echo $this->_tpl_vars['_lang']['conmon']['all_page']; ?>
(<?php echo $this->_tpl_vars['page_count']; ?>
)
<?php if ($this->_tpl_vars['page_count'] > 5): ?>
	<input name="datestart" type="hidden" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
	<input name="dateend" type="hidden" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
">
	<input name="sort_1" type="hidden" value="<?php echo $this->_tpl_vars['search_sort_1']; ?>
">
	<input name="role_id" type="hidden" size="10" value="<?php echo $this->_tpl_vars['role']['role_id']; ?>
" />
	<input name="role_name" type="hidden" size="10" value="<?php echo $this->_tpl_vars['role']['role_name']; ?>
" />
	<input name="account_name" type="hidden" size="10" value="<?php echo $this->_tpl_vars['role']['account_name']; ?>
" />
    <input name="page" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO">
<?php endif; ?>

[ <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?excel=true&datestart=<?php echo ((is_array($_tmp=$this->_tpl_vars['start'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
&amp;dateend=<?php echo ((is_array($_tmp=$this->_tpl_vars['end'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
&amp;sort_1=<?php echo $this->_tpl_vars['search_sort_1']; ?>
&amp;sort_2=<?php echo $this->_tpl_vars['search_sort_2']; ?>
&amp;role_id=<?php echo $this->_tpl_vars['role']['role_id']; ?>
&amp;role_name=<?php echo $this->_tpl_vars['role']['role_name']; ?>
&amp;account_name=<?php echo $this->_tpl_vars['role']['account_name']; ?>
"><?php echo $this->_tpl_vars['_lang']['conmon']['out_excel']; ?>
</a> ]
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
		<td ><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
		<td ><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
		<td ><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['registered_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['last_login_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['last_login_ip']; ?>
</td>
		<td>转生</td>
		<td ><?php echo $this->_tpl_vars['_lang']['conmon']['role_level']; ?>
</td>
	</tr>
	<?php endif; ?>

	<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
	<tr class='trEven'>
	<?php else: ?>
	<tr class='trOdd'>
	<?php endif; ?>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['last_login_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['last_login_ip']; ?>
</td>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['zhuanshen']; ?>
</td>
    <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['level']; ?>
</td>
	</tr>
<?php endfor; else: ?>

<?php endif; ?>
<!-- SECTION  END -------------------------->

</form>
</table>

</body>
</html>