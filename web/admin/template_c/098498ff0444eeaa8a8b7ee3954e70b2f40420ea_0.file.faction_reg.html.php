<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:49
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\faction_reg.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c79a7f079_26549917',
  'file_dependency' => 
  array (
    '098498ff0444eeaa8a8b7ee3954e70b2f40420ea' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\faction_reg.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c79a7f079_26549917 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_registration'];?>
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
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_registration'];?>
</div>
    <div id="all">
        <div id="main">
            <div id="xxcx">
            <form name="form1" action="faction_reg.php" method="post" >
            <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_art'];?>
：
            <select name="faction" >
                <option id="1" <?php if ($_smarty_tpl->tpl_vars['faction']->value == "wei") {?>selected<?php }?> value="wei"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['faction_wei'];?>
</option>
                <option id="2" <?php if ($_smarty_tpl->tpl_vars['faction']->value == "shu") {?>selected<?php }?> value="shu"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['faction_shu'];?>
</option>
                <option id="3" <?php if ($_smarty_tpl->tpl_vars['faction']->value == "wu") {?>selected<?php }?> value="wu"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['faction_wu'];?>
</option>
                <option id="4" <?php if ($_smarty_tpl->tpl_vars['faction']->value == "no") {?>selected<?php }?> value="no"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['faction_no'];?>
</option>
            </select>
            &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
'/>
            &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
'/>
            &nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
            </form>
            <br>
            <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                <tr bgcolor="#E5F9FF">
                    <td colspan="2" background="/web/admin/static/images/wbg.gif">
                    <font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_registration'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];?>
</b></font>
                    </td>
                </tr>
                <tr bgcolor="#FFFFFF">
                    <td width="25%">
                    <b><font color="#FF0099">
                    <?php if ($_smarty_tpl->tpl_vars['faction']->value == 'wei') {?>
                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['tiandao'];?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['faction']->value == 'shu') {?>
                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yijian'];?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['faction']->value == 'wu') {?>
                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yinkui'];?>

                    <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['cihang'];?>

                    <?php }?>
                    </font></b> <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['current_role_num'];?>
：</td>
                    <td width="75%"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['number']->value)===null||$tmp==='' ? 0 : $tmp);?>
</td>
                </tr>
            </table>
            <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
            	<tr class='table_list_head'>
            		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['year'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['month'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_accounts'];?>
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
                <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] == null || $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] == null || $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] == null || $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] == null) {?>
                <tr bgcolor="#E5F9FF" align="center">
                <?php } else { ?>
                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
                <tr class='trEven'>
                <?php } else { ?>
                <tr class='trOdd'>
                <?php }?>
                <?php }?>
                    <td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] == null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_result_data'];
} else {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'];
}?></td>
                    <td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['year'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];
} else {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];
}?></td>
                    <td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] != null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['month'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];
} else {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];
}?></td>
                    <td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] !== null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] != null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];
} else {
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];
}?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['c'];?>
</td>
                </tr>
                <?php }} else {
 ?>
                <?php
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
            </table>
		</div>
	</div>
</div>
</body>
</html>
<?php }
}
