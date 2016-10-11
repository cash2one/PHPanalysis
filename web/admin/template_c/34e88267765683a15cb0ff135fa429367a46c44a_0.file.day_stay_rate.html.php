<?php
/* Smarty version 3.1.29, created on 2016-09-18 17:07:24
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\day_stay_rate.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57de594cda6ba0_17207040',
  'file_dependency' => 
  array (
    '34e88267765683a15cb0ff135fa429367a46c44a' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\day_stay_rate.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57de594cda6ba0_17207040 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_statistics'];?>
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
</head>

<body>
	<div id="all">
		<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['day_lose_rate'];?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table width="6500"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                    	<tr class='table_list_head'>
                    		<td width="100">注册日期</td>
                            <td width="100">登陆请求</td>
                            <td width="100">点击创建角色数</td>
                            <td width="100">当天进入角色数</td>
                            <td width="100">1天登陆</td>
                            <td width="100">1天留存率</td>
                            <td width="100">2天登陆</td>
                            <td width="100">2天留存率</td>
                            <td width="100">3天登陆</td>
                            <td width="100">3天留存率</td>
                            <td width="100">4天登陆</td>
                            <td width="100">4天留存率</td>
                            <td width="100">5天登陆</td>
                            <td width="100">5天留存率</td>
                            <td width="100">6天登陆</td>
                            <td width="100">6天留存率</td>
                            <td width="100">7天登陆</td>
                            <td width="100">7天留存率</td>
                            <td width="100">8天登陆</td>
                            <td width="100">8天留存率</td>
                            <td width="100">9天登陆</td>
                            <td width="100">9天留存率</td>
                            <td width="100">10天登陆</td>
                            <td width="100">10天留存率</td>
                            <td width="100">11天登陆</td>
                            <td width="100">11天留存率</td>
                            <td width="100">12天登陆</td>
                            <td width="100">12天留存率</td>
                            <td width="100">13天登陆</td>
                            <td width="100">13天留存率</td>
                            <td width="100">14天登陆</td>
                            <td width="100">14天留存率</td>
                            <td width="100">15天登陆</td>
                            <td width="100">15天留存率</td>
                            <td width="100">16天登陆</td>
                            <td width="100">16天留存率</td>
                            <td width="100">17天登陆</td>
                            <td width="100">17天留存率</td>
                            <td width="100">18天登陆</td>
                            <td width="100">18天留存率</td>
                            <td width="100">19天登陆</td>
                            <td width="100">19天留存率</td>
                            <td width="100">20天登陆</td>
                            <td width="100">20天留存率</td>
                            <td width="100">21天登陆</td>
                            <td width="100">21天留存率</td>
                            <td width="100">22天登陆</td>
                            <td width="100">22天留存率</td>
                            <td width="100">23天登陆</td>
                            <td width="100">23天留存率</td>
                            <td width="100">24天登陆</td>
                            <td width="100">24天留存率</td>
                            <td width="100">25天登陆</td>
                            <td width="100">25天留存率</td>
                            <td width="100">26天登陆</td>
                            <td width="100">26天留存率</td>
                            <td width="100">27天登陆</td>
                            <td width="100">27天留存率</td>
                            <td width="100">28天登陆</td>
                            <td width="100">28天留存率</td>
                            <td width="100">29天登陆</td>
                            <td width="100">29天留存率</td>
</tr>
                    <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['zhuce_list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
						<tr bgcolor="#E5F9FF" align="center">
                        	<td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['zcrq'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['dlqq'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['cjjs'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['jrcj'];?>
</td>
                        	<td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['1day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['1rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['2day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['2rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['3day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['3rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['4day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['4rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['5day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['5rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['6day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['6rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['7day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['7rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['8day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['8rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['9day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['9rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['10day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['10rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['11day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['11rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['12day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['12rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['13day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['13rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['14day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['14rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['15day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['15rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['16day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['16rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['17day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['17rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['18day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['18rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['19day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['19rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['20day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['20rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['21day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['21rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['22day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['22rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['23day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['23rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['24day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['24rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['25day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['25rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['26day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['26rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['27day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['27rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['28day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['28rate'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['29day'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['zhuce_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['29rate'];?>
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
</html>
<?php }
}
