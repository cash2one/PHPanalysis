<?php
/* Smarty version 3.1.29, created on 2016-09-05 14:44:22
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\account\accountLoginCount.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57cd1446839305_85126890',
  'file_dependency' => 
  array (
    'c7341df1ce30f4e694a0305638341efe8f99a447' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\account\\accountLoginCount.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57cd1446839305_85126890 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['log_statistics'];?>
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
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['log_statistics'];?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                <form name="myform" method="post" >
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
:<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['dateStart']->value;?>
'/>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['dateEnd']->value;?>
'/>
                &nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
                </form>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr class='table_list_head'>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date_time'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['add_user'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['day_add_user_rate'];?>
</td><td>
<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_num'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['distribution_photo'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['distribution_photo'];?>
</td>
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

                        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
                        <tr class='trEven'>
                        <?php } else { ?>
                        <tr class='trOdd'>
                        <?php }?>
                            <td width="8%"><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['date'];?>
</td>
                            <td width="8%"><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['new_count'];?>
</td>
                            <td width="8%"><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['lost'];?>
</td>
                            <td width="8%"><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['total_number'];?>
</td>
                            <td width="30%" align="left"><img src="/web/admin/static/images/green.gif" height="5" width="<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['total_number']/$_smarty_tpl->tpl_vars['count']->value[3]*100;?>
%" /></td>
                            <td width="8%"><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['once_number'];?>
</td>
                            <td width="30%" align="left"><img src="/web/admin/static/images/green.gif" height="5" width="<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['once_number']/$_smarty_tpl->tpl_vars['count']->value[4]*100;?>
%" /></td>
                        </tr>
                    <?php }} else {
 ?>

                    <?php
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
                    	<tr bgcolor="#E5F9FF">
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_volume'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[5];?>
<br><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['maximum'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[6];?>
</td><td></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_volume'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[1];?>
<br><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['maximum'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[3];?>
</td><td></td>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_volume'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[2];?>
<br><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['maximum'];?>
：<?php echo $_smarty_tpl->tpl_vars['count']->value[4];?>
</td><td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
	</div>
</body>
</html>
<?php }
}
