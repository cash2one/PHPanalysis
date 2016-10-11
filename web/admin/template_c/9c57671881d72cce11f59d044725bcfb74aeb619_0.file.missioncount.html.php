<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:32
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\missioncount\missioncount.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c689fcdc1_18338316',
  'file_dependency' => 
  array (
    '9c57671881d72cce11f59d044725bcfb74aeb619' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\missioncount\\missioncount.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c689fcdc1_18338316 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task_lose_rate'];?>
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
 type="text/javascript">
<?php echo '</script'; ?>
>
</head>

<body>
	<div id="all">
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task_lose_rate'];?>
</div>
		<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
             <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['mission']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
			 <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
			 <tr class='table_list_head'>
                 <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task_id'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['accept_num'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['finish_num'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task_lose_rate'];?>
</td>
             </tr>
			 <?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
					<tr class='trEven'>
					<?php } else { ?>
					<tr class='trOdd'>
					<?php }?>
                            <td><?php echo $_smarty_tpl->tpl_vars['mission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mission_id'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
                        	<td><?php echo $_smarty_tpl->tpl_vars['mission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['accept_num'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['complete_num'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mission']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mission_lost_rate'];?>
%</td>
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
</body>
</html>
<?php }
}
