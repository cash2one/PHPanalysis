<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:43:06
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\today.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c8a2b38a6_40985704',
  'file_dependency' => 
  array (
    '7c86c77d05ca046982dd933e775ce820a4e0653c' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\today.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c8a2b38a6_40985704 ($_smarty_tpl) {
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
		<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_statistics'];?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                <form name="myform" action="?type=zonghe" method="post" >
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
'/>
                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
'/>
                &nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
                </form>
                <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="2" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['current_register_info_statistics'];?>
</b></font>
                            </td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_total'];?>
：</td>
                          <td width="75%"><?php echo $_smarty_tpl->tpl_vars['account_count']->value;?>
</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['current_accounts_num'];?>
：</td>
                          <td width="75%"><?php echo $_smarty_tpl->tpl_vars['HaveRoleAccount']->value;?>
---------<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['creat_role_lose_rate'];?>
(<?php echo $_smarty_tpl->tpl_vars['HaveRoleAccountload']->value;?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['current_role_num'];?>
：</td>
                          <td width="75%"><?php echo $_smarty_tpl->tpl_vars['role_count']->value;?>
</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['wei_users'];?>
：</td>
                          <td width="75%"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['role_count_of_wei']->value)===null||$tmp==='' ? 0 : $tmp);?>
(<?php echo $_smarty_tpl->tpl_vars['role_count_of_wei']->value/$_smarty_tpl->tpl_vars['role_count']->value;?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['shu_users'];?>
：</td>
                          <td width="75%"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['role_count_of_shu']->value)===null||$tmp==='' ? 0 : $tmp);?>
(<?php echo $_smarty_tpl->tpl_vars['role_count_of_shu']->value/$_smarty_tpl->tpl_vars['role_count']->value;?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['wu_users'];?>
：</td>
                          <td width="75%"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['role_count_of_wu']->value)===null||$tmp==='' ? 0 : $tmp);?>
(<?php echo $_smarty_tpl->tpl_vars['role_count_of_wu']->value/$_smarty_tpl->tpl_vars['role_count']->value;?>
)</td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_users'];?>
：</td>
                          <td width="75%"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['role_count_of_no']->value)===null||$tmp==='' ? 0 : $tmp);?>
(<?php echo $_smarty_tpl->tpl_vars['role_count_of_no']->value/$_smarty_tpl->tpl_vars['role_count']->value;?>
)</td>
                        </tr>
                     </table>


                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr class='table_list_head'>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['year'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['month'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_accounts'];?>
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
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] == null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_result_data'];?>

                            <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'];?>

                            <?php }?>
                            </td><td>
                            <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['year'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];?>

                            <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];?>

                            <?php }?>
                            </td><td>
                            <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] != null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['month'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];?>

                            <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];?>

                            <?php }?>
                            </td><td>
                            <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] == null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'] !== null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'] != null && $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['year'] != null) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all'];?>

                            <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];?>

                            <?php }?>
                            </td><td>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['c'];?>

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
	</div>



</body>
</html>
<?php }
}
