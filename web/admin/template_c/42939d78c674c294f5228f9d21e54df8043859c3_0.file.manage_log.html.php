<?php
/* Smarty version 3.1.29, created on 2016-07-26 09:36:20
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\backstat\manage_log.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5796be9486d091_16851841',
  'file_dependency' => 
  array (
    '42939d78c674c294f5228f9d21e54df8043859c3' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\backstat\\manage_log.html',
      1 => 1469440920,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5796be9486d091_16851841 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin_manage_record'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
<?php echo '</script'; ?>
>

<body>
	<div id="all">
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin_manage_record'];?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                        <tr>
                            <td colspan="8">
                                <form  name=form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" method="post">
                                    <input type='hidden' name='dopost' value='submit'>
                                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin'];?>
：<input type="text" name="admin_name" value="<?php echo $_smarty_tpl->tpl_vars['admin_name']->value;?>
" />&nbsp;&nbsp;
                                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
'/>
                                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
'/>&nbsp;&nbsp;
                                    <input type="checkbox" name="gulvxt" value="9001"  checked="checked"  /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['filter_login_action'];?>

                                    <select name=op_id>
				              <?php
$_from = $_smarty_tpl->tpl_vars['op_name']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
					          <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['op_id']->value) {?>
							  <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
						      <?php } else { ?>
							  <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
						      <?php }?>
				              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
?>
			            </select>
		                    <input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['search'];?>
" />
		                </form>
                            </td>
			</tr>
			<tr bgcolor="#D2E9FF">
                            <td colspan="8"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_statistics'];?>
：<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
&nbsp;00:00:00&nbsp;~&nbsp;<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
&nbsp;23：59：59</td>
			</tr>
                    <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['keywordlist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
	                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
                        <tr bgcolor="#D2E9FF" align="center">
                            <td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['time'];?>
</td>
                            <td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin'];?>
</td>
                            <td width="5%">IP</td>
                            <td width="10%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
</td>
                            <td width="15%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user'];?>
</td>
                            <td width="55%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['detail'];?>
</td>
                            <td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['num'];?>
</td>
                        </tr>
                        <?php }?>
	                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
	                <tr class='trEven' bgcolor="#E0EEEE">
	                <?php } else { ?>
	                <tr class='trOdd'  bgcolor="#E0EEEE">
	                <?php }?>
                            <td>
			        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M:%S");?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['admin_name'];?>

                            </td>
                           <td>
                             <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['admin_ip'];?>

                           </td>
                           <td>
                                 <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>

                           </td>
                           <td>
                                 <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['user_name'];?>

                           </td>
                           <td>
                                 <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mdetail_str'] != '') {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mdetail_str'];
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mdetail'];
} else {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mdetail'];
}?>
                           </td>
                           <td>
                                 <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['number'];?>

                           </td>
	                    </tr>
                    <?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
                  </table>
                </div>
            </div>
        </div>
	</div>
</body>
</html><?php }
}
