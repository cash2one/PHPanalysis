<?php /* Smarty version 2.6.25, created on 2016-05-21 14:55:57
         compiled from module/online/now_role_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/online/now_role_list.html', 51, false),array('function', 'math', 'module/online/now_role_list.html', 76, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['online_list']; ?>
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
</script>
</head>

<body>
	<div id="all">
		<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['online_register']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['online_list']; ?>
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
&role_id=<?php echo $this->_tpl_vars['role_id']; ?>
&nickname=<?php echo $this->_tpl_vars['nickname']; ?>
&acname=<?php echo $this->_tpl_vars['acname']; ?>
"><?php echo $this->_tpl_vars['page_name']; ?>
</a></td>
                            <?php endforeach; endif; unset($_from); ?>
							<td><?php if ($this->_tpl_vars['page_count'] > 0): ?><?php echo $this->_tpl_vars['_lang']['conmon']['all_page']; ?>
(<?php echo $this->_tpl_vars['page_count']; ?>
)<?php endif; ?></td>
              <td>
                &nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $this->_tpl_vars['role_id']; ?>
" />
                &nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
：<input type='text' id="nickname" name='nickname' size='10' value='<?php echo $this->_tpl_vars['nickname']; ?>
'/> 
                &nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
：<input type='text' id="acname" name='acname' size='10' value='<?php echo $this->_tpl_vars['acname']; ?>
'/>
              </td>
							<td><input name="pid" type="text" class="text" size="3" maxlength="6">&nbsp;
								<input type="submit" class="button" name="Submit" value="GO">
							</td>
						</form>
          </tr>
          

          
              
                    </table>
                	<table width="100%" cellspacing="1" cellpadding="3" border="0" class='table_list'>
                        <tr>
                            <td colspan=9><?php echo $this->_tpl_vars['_lang']['conmon']['sys_time_now']; ?>
：<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                        </tr>
                    </table>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="5" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['online_user_list_15second_per']; ?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'>
                          <td width="15%"><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
                          <td width="15%"><?php echo $this->_tpl_vars['_lang']['conmon']['current_online_time']; ?>
(<?php echo $this->_tpl_vars['_lang']['conmon']['minute']; ?>
)</td>
                          <td width="20%"><?php echo $this->_tpl_vars['_lang']['conmon']['login_ip']; ?>
</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['onlines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['online']):
?>
						<?php if ($this->_tpl_vars['key'] % 2 == 0): ?>
						<tr class='trEven'>
						<?php else: ?>
						<tr class='trOdd'>
						<?php endif; ?>
                          <td width="15%"><?php echo $this->_tpl_vars['online']['role_id']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['role_name']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['account_name']; ?>
</td>
                          <td width="15%"><?php echo smarty_function_math(array('equation' => "(now - lasttime)/60",'now' => time(),'lasttime' => $this->_tpl_vars['online']['last_login_time'],'format' => "%.d"), $this);?>
</td>
                          <td width="20%"><?php echo $this->_tpl_vars['online']['last_login_ip']; ?>
</td>
                        </tr>
                        <?php endforeach; else: ?>
                       	<tr bgcolor="#FFFFFF">
                          <td colspan="5"><font color="#FF0000"><?php echo $this->_tpl_vars['_lang']['left']['no_record']; ?>
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