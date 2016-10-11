<?php /* Smarty version 2.6.25, created on 2016-05-21 11:24:53
         compiled from module/pay/review_gold.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/pay/review_gold.html', 86, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['approval_ingot']; ?>
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
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['approval_ingot']; ?>
</div>
	<div id="all">
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                        <tr>
							<td colspan="8">
							  <form  name=form action="?action=do3&type=search" method="post">
                              <input type='hidden' name='dopost' value='submit'>
							  <?php echo $this->_tpl_vars['_lang']['left']['applicant']; ?>
：<input type="text" name="apply_admin_name" value="<?php echo $this->_tpl_vars['apply_admin_name']; ?>
" />&nbsp;&nbsp;
							  <?php echo $this->_tpl_vars['_lang']['left']['reviewer']; ?>
：<input type="text" name="review_admin_name" value="<?php echo $this->_tpl_vars['review_admin_name']; ?>
" />&nbsp;&nbsp;
							  <?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $this->_tpl_vars['search_keyword1']; ?>
'/>
							  <?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $this->_tpl_vars['search_keyword2']; ?>
'/>&nbsp;&nbsp;
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
		                      <input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/>
                              <input type="hidden" name="whichpage" value="<?php echo $this->_tpl_vars['whichpage']; ?>
">
		                      </form>
                            </td>
						</tr>
                        </tr>
						<tr class='table_list_head'>
							<td colspan="8"><?php echo $this->_tpl_vars['_lang']['left']['time_statistics']; ?>
：<?php echo $this->_tpl_vars['search_keyword1']; ?>
&nbsp;00:00:00&nbsp;~&nbsp;<?php echo $this->_tpl_vars['search_keyword2']; ?>
&nbsp;23：59：59</td>
						</tr>
					</table>

					<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF"
					style="table-layout:fixed;word-break:break-all;word-wrap:break-word;">
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
						<tr class='table_list_head' align="center">
							<td >id</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['app_time']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['left']['applicant']; ?>
</td>
							<!-- <td width="8%">申请人IP</td> -->
							<td ><?php echo $this->_tpl_vars['_lang']['conmon']['operating']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['left']['gm_to_role_name']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['user_role_id']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['type']; ?>
</td>
							<!-- <td width="5%">物品ID</td> -->
							<td ><?php echo $this->_tpl_vars['_lang']['left']['bind_qk']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['conmon']['num']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['reason']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['review_time']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['left']['reviewer']; ?>
</td>
							<!-- <td width="8%">审核者IP</td> -->
							<td ><?php echo $this->_tpl_vars['_lang']['left']['statu']; ?>
</td>
							<td><?php echo $this->_tpl_vars['_lang']['new']['agree']; ?>
</td>
							<td ><?php echo $this->_tpl_vars['_lang']['new']['refuse']; ?>
</td>
						</tr>
                        <?php endif; ?>
	                    <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
	                    <tr class='trEven' align="center">
	                    <?php else: ?>
	                    <tr class='trOdd'  align="center">
	                    <?php endif; ?>
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['id']; ?>
</td>
		                   <td><?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['mtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
	                 	   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['admin_name']; ?>
</td>
		                   <!-- <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['admin_ip']; ?>
 </td> -->
		                   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['desc']; ?>
</td>
		                   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_name']; ?>
</td>
						   <td><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_id'] != '0'): ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_id']; ?>
<?php endif; ?></td>
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_name']; ?>
</td>
						   <!-- <td><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_id'] != '0'): ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_id']; ?>
<?php endif; ?></td> -->
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['bind_cn']; ?>
</td>
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['number']; ?>
</td>
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['reason']; ?>
</td>
						   <td><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['review_mtime'] != '0'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['review_mtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<?php endif; ?></td>
						   <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['review_admin_name']; ?>
</td>
						   <!-- <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['review_admin_ip']; ?>
</td> -->
						   <td><?php if ($this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['status'] != '4'): ?><FONT color=red><?php endif; ?><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['status_desc']; ?>
</td>

							<form action="?action=do1&type=agree" method="post">
							<td><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['id']; ?>
" />
								<input type="hidden" name="role_id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_id']; ?>
" />
								<input type="hidden" name="role_name" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_name']; ?>
" />
								<input type="hidden" name="item_type" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_name']; ?>
" />
								<input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_id']; ?>
" />
								<input type="hidden" name="bind" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['bind']; ?>
" />
								<input type="hidden" name="number" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['number']; ?>
" />
								<input type="hidden" name="reason" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['reason']; ?>
" />								
								<input type="submit" name="submit" value=" <?php echo $this->_tpl_vars['_lang']['new']['agree']; ?>
 "/>
							</td>
                                <input type="hidden" name="whichpage" value="<?php echo $this->_tpl_vars['whichpage']; ?>
">
							</form>
						   
							<form action="?action=do2&type=deny" method="post">
							<td><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['id']; ?>
" />
								<input type="hidden" name="role_id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_id']; ?>
" />
								<input type="hidden" name="role_name" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['user_name']; ?>
" />
								<input type="hidden" name="item_type" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_name']; ?>
" />
								<input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['item_id']; ?>
" />
								<input type="hidden" name="bind" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['bind']; ?>
" />
								<input type="hidden" name="number" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['number']; ?>
" />
								<input type="hidden" name="reason" value="<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['reason']; ?>
" />	
								<input type="submit" name="submit" value=" <?php echo $this->_tpl_vars['_lang']['new']['refuse']; ?>
 "/>
                                <input type="hidden" name="whichpage" value="<?php echo $this->_tpl_vars['whichpage']; ?>
">
                                </td>
							</form>
	                    </tr>
                    <?php endfor; endif; ?>
                  </table>
                   <div id='1'><center>
                        <?php echo $this->_tpl_vars['page']; ?>

                    </center>
                </div>
                  
                </div>
            </div>
        </div>
	</div>
</body>
</html>