<?php /* Smarty version 2.6.25, created on 2016-05-21 11:25:27
         compiled from module/analysis/silver_use_stat.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'module/analysis/silver_use_stat.html', 166, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">

<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#acname").val('');
			$("#nickname").val('');
		});
		$("#nickname").keydown(function(){
			$("#role_id").val('');
			$("#acname").val('');
		});
		$("#acname").keydown(function(){
			$("#role_id").val('');
			$("#nickname").val('');
		});
	});
</script>
<title>
	<?php echo $this->_tpl_vars['_lang']['left']['silver_use_statistics']; ?>

</title>
</head>

<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['data_analysis']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['silver_use_statistics']; ?>
</div>
<span style="color:red;font-weight: bold;"><?php echo $this->_tpl_vars['_lang']['left']['start_to_now']; ?>
 【<?php echo $this->_tpl_vars['_lang']['left']['silver_use']; ?>
】<?php echo $this->_tpl_vars['_lang']['left']['binded']; ?>
:<?php echo $this->_tpl_vars['silver_bind_all']; ?>
 + <?php echo $this->_tpl_vars['_lang']['left']['not_binded']; ?>
:<?php echo $this->_tpl_vars['silver_unbind_all']; ?>
</span><br>

<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
">
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $this->_tpl_vars['role_id']; ?>
" />
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
:<input type='text' id="nickname" name='nickname' size='10' value='<?php echo $this->_tpl_vars['search1']; ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
:<input type='text' id="acname" name='acname' size='10' value='<?php echo $this->_tpl_vars['search2']; ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $this->_tpl_vars['search_keyword1']; ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $this->_tpl_vars['search_keyword2']; ?>
'/>
&nbsp;<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"  />
&nbsp;
<input type="button" class="button" name="datePrev" value="<?php echo $this->_tpl_vars['_lang']['conmon']['today']; ?>
" onclick="javascript:location.href='<?php echo $this->_tpl_vars['URL_SELF']; ?>
?order=<?php echo $this->_tpl_vars['order']; ?>
&dateStart=<?php echo $this->_tpl_vars['dateStrToday']; ?>
&dateEnd=<?php echo $this->_tpl_vars['dateStrToday']; ?>
';">&nbsp
&nbsp;
<input type="button" class="button" name="datePrev" value="<?php echo $this->_tpl_vars['_lang']['conmon']['before_one_day']; ?>
" onclick="javascript:location.href='<?php echo $this->_tpl_vars['URL_SELF']; ?>
?order=<?php echo $this->_tpl_vars['order']; ?>
&dateStart=<?php echo $this->_tpl_vars['dateStrPrev']; ?>
&dateEnd=<?php echo $this->_tpl_vars['dateStrPrev']; ?>
';">
&nbsp;
<input type="button" class="button" name="dateNext" value="<?php echo $this->_tpl_vars['_lang']['conmon']['after_one_day']; ?>
" onclick="javascript:location.href='<?php echo $this->_tpl_vars['URL_SELF']; ?>
?order=<?php echo $this->_tpl_vars['order']; ?>
&dateStart=<?php echo $this->_tpl_vars['dateStrNext']; ?>
&dateEnd=<?php echo $this->_tpl_vars['dateStrNext']; ?>
';">
&nbsp;
<input type="button" class="button" name="dateAll" value="<?php echo $this->_tpl_vars['_lang']['new']['all_total']; ?>
" onclick="javascript:location.href='<?php echo $this->_tpl_vars['URL_SELF']; ?>
?order=<?php echo $this->_tpl_vars['order']; ?>
&dateStart=ALL&dateEnd=ALL';">
</form>

<?php if ($this->_tpl_vars['list']): ?>
<table class='paystat' style="width:100%">
	<tr class='table_list_head'>
		<td>角色Id</td>
		<td>角色名</td>
		<td>用户名</td>
		<td>操作</td>
	</tr>
	<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
?type=url&search_id=<?php echo $this->_tpl_vars['val']['rold_id']; ?>
&search_nickname=<?php echo $this->_tpl_vars['val']['role_name']; ?>
&search_acname=<?php echo $this->_tpl_vars['account_name']; ?>
&dateEndStamp=<?php echo $this->_tpl_vars['dateEndStamp']; ?>
&dateStartStamp=<?php echo $this->_tpl_vars['dateStartStamp']; ?>
">查询</a></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>


</div>

<?php if ($this->_tpl_vars['keywordlist']): ?>
	<div style='float:left;margin-right:5px;'>
	<table cellspacing="1" cellpadding="3" border="0" class='paystat' >
	<!-- SECTION  START -------------------------->

	<tr class='table_list_head'>
		<td colspan=7 >
	    <?php echo $this->_tpl_vars['_lang']['left']['silver_use_statistics']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['left']['time_statistics']; ?>
：<?php echo $this->_tpl_vars['search_keyword1']; ?>
 0:0:0
	    ~ <?php echo $this->_tpl_vars['search_keyword2']; ?>
 23:59:59</td>
		<?php if ($this->_tpl_vars['type']): ?><td></td><td></td><?php endif; ?>
	</tr>

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
			<td><?php echo $this->_tpl_vars['_lang']['left']['operation_type']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['record_operating_times']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['record_operating_man_num']; ?>
</td>
			<!-- <td>总银两</td> -->
			<td><?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['silver']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['no_bind']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['silver']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</td>
		</tr>
		<?php endif; ?>

		<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
		<tr class='trEven'>
		<?php else: ?>
		<tr class='trOdd'>
		<?php endif; ?>
			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['desc']; ?>

			</td>
			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['c']; ?>

			</td>
			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_num']; ?>

			</td>
<!-- 			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver']; ?>

			</td> -->
			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_bind']; ?>

			</td>
			<td>
			<font color="red">
				<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_bind_per']; ?>
<?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_bind'] >= 0): ?>%<?php endif; ?>
			</font>
			</td>
			<td>
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_unbind']; ?>

			</td>
			<td>
			<font color="red">
			<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_unbind_per']; ?>
<?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['silver_unbind'] >= 0): ?>%<?php endif; ?>
			</font>
			</td>
		</tr>
	<?php endfor; else: ?>

	<?php endif; ?>
	<!-- SECTION  END -------------------------->

	</form>
	</table>
	</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['buy_stat']): ?>
	<div style='float:left;'>
	<table cellspacing="1" cellpadding="3" border="0" class='paystat' >
		<tr class='table_list_head'>
			<td colspan=10>
				(<?php echo $this->_tpl_vars['_lang']['left']['buy_by_silver']; ?>
)<?php echo $this->_tpl_vars['_lang']['left']['props_statistics']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['left']['time_statistics']; ?>
：<?php echo $this->_tpl_vars['search_keyword1']; ?>
 0:0:0 ~ <?php echo $this->_tpl_vars['search_keyword2']; ?>
 23:59:59
			</td>
		<tr>
	<?php $_from = $this->_tpl_vars['buy_stat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>
		<?php if ($this->_tpl_vars['key'] % 20 == 0): ?>
		<tr class='table_list_head'>
			<td><?php echo $this->_tpl_vars['_lang']['left']['props_id']; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['props_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['total_ge']; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['silver']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['left']['no_bind']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['silver']; ?>
</td>
			<td><?php echo $this->_tpl_vars['_lang']['conmon']['rate']; ?>
</td>
			<!-- <td>总银两</a></td> -->
		</tr>
		<?php endif; ?>
		<tr class="<?php echo smarty_function_cycle(array('values' => 'trOdd, trEven'), $this);?>
">
			<td><?php echo $this->_tpl_vars['row']['itemid']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['item_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['amount']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['silver_bind']; ?>
</td>
			<td>
				<font color="red">
					<?php echo $this->_tpl_vars['row']['silver_bind_per']; ?>
<?php if ($this->_tpl_vars['row']['silver_bind'] >= 0): ?>%<?php endif; ?>
				</font>
			</td>
			<td><?php echo $this->_tpl_vars['row']['silver_unbind']; ?>
</td>
			<td>
				<font color="red"><?php echo $this->_tpl_vars['row']['silver_unbind_per']; ?>
<?php if ($this->_tpl_vars['row']['silver_unbind'] >= 0): ?>%<?php endif; ?></font>
			</td>
			<!-- <td><?php echo $this->_tpl_vars['row']['silver_unbind']; ?>
</td> -->
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>
	</div>
<?php else: ?>
<br><label style="color:red; font-weight:bold;">【<?php echo $this->_tpl_vars['search2']; ?>
】</label><?php echo $this->_tpl_vars['_lang']['new']['buy_by_silver']; ?>

<?php endif; ?>

</body>
</html>