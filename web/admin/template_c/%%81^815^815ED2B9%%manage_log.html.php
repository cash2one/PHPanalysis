<?php /* Smarty version 2.6.25, created on 2016-07-21 11:14:29
         compiled from module/backstat/manage_log.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/backstat/manage_log.html', 70, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['admin_manage_record']; ?>
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

<body>
	<div id="all">
	<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['admin_manage']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['admin_manage_record']; ?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                        <tr>
							<td colspan="8">
							  <form  name=form action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
" method="post">
                              <input type='hidden' name='dopost' value='submit'>
							  <?php echo $this->_tpl_vars['_lang']['left']['admin']; ?>
：<input type="text" name="admin_name" value="<?php echo $this->_tpl_vars['admin_name']; ?>
" />&nbsp;&nbsp;
							  <?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $this->_tpl_vars['search_keyword1']; ?>
'/>
							  <?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $this->_tpl_vars['search_keyword2']; ?>
'/>&nbsp;&nbsp;
							  <input type="checkbox" name="gulvxt" value="9001"  checked="checked"  /><?php echo $this->_tpl_vars['_lang']['left']['filter_login_action']; ?>

			                  <select name=op_id>
				              <?php $_from = $this->_tpl_vars['op_name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					          <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['op_id']): ?>
							  <option value="<?php echo $this->_tpl_vars['key']; ?>
" selected="selected"><?php echo $this->_tpl_vars['item']; ?>
</option>
						      <?php else: ?>
							  <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
						      <?php endif; ?>
				              <?php endforeach; endif; unset($_from); ?>
			                  </select>
		                      <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['_lang']['conmon']['search']; ?>
" />
		                      </form>
                            </td>
						</tr>
                        </tr>
						<tr bgcolor="#D2E9FF">
							<td colspan="8"><?php echo $this->_tpl_vars['_lang']['left']['time_statistics']; ?>
：<?php echo $this->_tpl_vars['search_keyword1']; ?>
&nbsp;00:00:00&nbsp;~&nbsp;<?php echo $this->_tpl_vars['search_keyword2']; ?>
&nbsp;23：59：59</td>
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
	                    <?php if ($this->_sections['loop']['rownum'] % 20 == 1): ?>
						<tr bgcolor="#D2E9FF" align="center">
							<td width="5%"><?php echo $this->_tpl_vars['_lang']['new']['time']; ?>
</td>
							<td width="5%"><?php echo $this->_tpl_vars['_lang']['left']['admin']; ?>
</td>
							<td width="5%">IP</td>
							<td width="10%"><?php echo $this->_tpl_vars['_lang']['conmon']['operating']; ?>
</td>
							<td width="15%"><?php echo $this->_tpl_vars['_lang']['conmon']['user']; ?>
</td>
							<td width="55%"><?php echo $this->_tpl_vars['_lang']['left']['detail']; ?>
</td>
							<td width="5%"><?php echo $this->_tpl_vars['_lang']['conmon']['num']; ?>
</td>
						</tr>
                        <?php endif; ?>
	                    <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
	                    <tr class='trEven' bgcolor="#E0EEEE">
	                        <?php else: ?>
	                    <tr class='trOdd'  bgcolor="#E0EEEE">
	                    <?php endif; ?>
		                   <td>
			                 <?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>

		                   </td>
	                 	   <td>
			                 <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['admin_name']; ?>

		                   </td>
		                   <td>
		              	     <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['admin_ip']; ?>

		                   </td>
		                   <td>
		                   	 <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['desc']; ?>

		                   </td>
		                   <td>
		                 	 <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_name']; ?>

		                   </td>
		                   <td>
			                 <?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mdetail_str'] != ''): ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mdetail_str']; ?>
<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mdetail']; ?>
<?php else: ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mdetail']; ?>
<?php endif; ?>
		                   </td>
		                   <td>
		                 	 <?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['number']; ?>

		                   </td>
	                    </tr>
                    <?php endfor; endif; ?>
                  </table>
                </div>
            </div>
        </div>
	</div>
</body>
</html>