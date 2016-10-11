<?php /* Smarty version 2.6.25, created on 2016-07-11 11:30:16
         compiled from module/online/history.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/online/history.html', 47, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['history_online']; ?>
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
：<?php echo $this->_tpl_vars['_lang']['left']['history_online']; ?>
</div>
    	<div><?php echo $this->_tpl_vars['errorMsg']; ?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table>
                    	<tr>
						<form method="get" action="">
                        	<?php $_from = $this->_tpl_vars['pageHTML']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_name'] => $this->_tpl_vars['page_id']):
?>
                        	<td><a href="?pid=<?php echo $this->_tpl_vars['page_id']; ?>
&dateStart=<?php echo $this->_tpl_vars['time_start']; ?>
&hour=<?php echo $this->_tpl_vars['hour']; ?>
&min=<?php echo $this->_tpl_vars['min']; ?>
"><?php echo $this->_tpl_vars['page_name']; ?>
</a></td>
                            <?php endforeach; endif; unset($_from); ?>
							<td><?php if ($this->_tpl_vars['page_count'] > 0): ?><?php echo $this->_tpl_vars['_lang']['conmon']['all_page']; ?>
(<?php echo $this->_tpl_vars['page_count']; ?>
)<?php endif; ?></td>
              <td>
                  <?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' 
                      value='<?php echo $this->_tpl_vars['time_start']; ?>
'/>
                  <?php echo $this->_tpl_vars['_lang']['conmon']['hour']; ?>
<input type='text' id="nickname" name='hour' size='10' value='<?php echo $this->_tpl_vars['hour']; ?>
'/> 
                  <?php echo $this->_tpl_vars['_lang']['conmon']['minute']; ?>
<input type='text' id="nickname" name='min' size='10' value='<?php echo $this->_tpl_vars['min']; ?>
'/>    
              </td>
							<td><input name="pid" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO"></td>
						</form>
                        </tr>
                    </table>
                	<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
                        <tr>	
                            <td colspan=9><?php echo $this->_tpl_vars['_lang']['conmon']['sys_time_now']; ?>
：<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                        </tr>
                    </table>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF"> 
                            <td colspan="4" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['today_online_Statistics_30second_per']; ?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'> 
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['statistical_time']; ?>
</td>
                          <td width="25%"><label style="color:red; font-weight:bold;"><?php echo $this->_tpl_vars['_lang']['new']['current']; ?>
</label><?php echo $this->_tpl_vars['_lang']['left']['online_num']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['conmon']['ip_count']; ?>
</td>
                          <td width="50%"></td>
                        </tr>

                        <?php $_from = $this->_tpl_vars['onlines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['online']):
?>
						<?php if ($this->_tpl_vars['key'] % 2 == 0): ?>
						<tr class='trEven'>
						<?php else: ?>
						<tr class='trOdd'>
						<?php endif; ?>
                          <td width="25%"><?php echo ((is_array($_tmp=$this->_tpl_vars['online']['dateline'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['online']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['distinct_ip']; ?>
</td>
                          <td width="50%" align="left"><img src="/web/admin/static/images/green.gif" height="5" width="<?php echo $this->_tpl_vars['online']['weight']; ?>
" /></td>
                        </tr>
                        <?php endforeach; else: ?>
                       	<tr bgcolor="#FFFFFF"> 
                          <td colspan="3"><font color="#FF0000"><?php echo $this->_tpl_vars['_lang']['left']['no_record']; ?>
</font></td>
                        </tr>
                        <?php endif; unset($_from); ?>
                        
                     </table>

                </div>
            </div>
        </div>
	</div>
</body>
</html>