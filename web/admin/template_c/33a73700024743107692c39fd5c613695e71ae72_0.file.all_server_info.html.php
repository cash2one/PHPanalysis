<?php
/* Smarty version 3.1.29, created on 2016-09-05 10:15:19
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\center\all_server_info.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ccd537487ac8_08694410',
  'file_dependency' => 
  array (
    '33a73700024743107692c39fd5c613695e71ae72' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\center\\all_server_info.html',
      1 => 1468910703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ccd537487ac8_08694410 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css"></link>
        <link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css"></link>
        <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/FusionCharts.js"><?php echo '</script'; ?>
>
        <!--  添加回到顶部      start        -->
        <SCRIPT type=text/javascript >

</SCRIPT>
 <!--  添加回到顶部   end        -->
        <style type="text/css">
            #all {text-align:left;margin-left:4px; line-height:1;}
            #nodes {width:100%;float:left;border:1px #ccc solid;}
            #result {width: 100%; height:100%; clear:both;border:1px #ccc solid;}
            .table_all_head { color:#232323; background-color:#99CC66;font-weight:bold; }

        </style>
        <title>服务器列表</title>
    </head>
    <body>
        <div id="all">
            <div id="position">服务器列表</div>
            <div id="main"><form name="form" method="GET">
                    <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#D7E4F5">
                        <tr><td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['select_agents'];?>
：</td></tr>
                        <tr>
                            <td>
                                <input type="radio" name="radio_agent" id="radio_agent" onclick="clkAgent(0)" value="0" <?php if ($_smarty_tpl->tpl_vars['agent']->value == 0) {?> checked <?php }?>  /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['any'];?>

                                <?php
$_from = $_smarty_tpl->tpl_vars['allAgentName']->value;
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
                                <input type="radio" name="radio_agent" id="radio_agent" onclick="clkAgent('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
')"  value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"  <?php if ($_smarty_tpl->tpl_vars['agent']->value == $_smarty_tpl->tpl_vars['key']->value) {?> checked <?php }?> /><?php echo $_smarty_tpl->tpl_vars['item']->value;?>

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
                            </td>
                        </tr>
                        <tr><td  bgcolor="#D7Eff5">
                                <input type="hidden" name="whichpage" value="1"/>
                              <!--  &nbsp;代理ID：<input type="text" name="agentID" id="agentID" value="" size="5">-->
                                    &nbsp;服务器：S<input type="text" name="serverID" value="<?php echo $_smarty_tpl->tpl_vars['server_id']->value;?>
" size="5">
                                &nbsp;域名：<input type="text" name="domainName" value="<?php echo $_smarty_tpl->tpl_vars['domain_name']->value;?>
">
                                    &nbsp;IP：<input type="text" name="ip" value="<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
">
                                        &nbsp;状态：<select name="serverStatus" id="serverStatus">
                                            <option value="0">全部</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['stat']->value == 1) {?> selected <?php }?> >开服</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['stat']->value == 2) {?> selected <?php }?> >合服</option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['stat']->value == 3) {?> selected <?php }?> >停服</option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['stat']->value == 4) {?> selected <?php }?> >未开服</option>
                                        </select>
                                        &nbsp;类型：<select name="serverType" id="serverType">
                                            <option value="0">全部</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['type']->value == 1) {?> selected <?php }?>   >简体服</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['type']->value == 2) {?> selected <?php }?> >繁体服</option>
                                            <option value="3"  <?php if ($_smarty_tpl->tpl_vars['type']->value == 3) {?> selected <?php }?> >越南服</option>
                                            <option value="4"  <?php if ($_smarty_tpl->tpl_vars['type']->value == 4) {?> selected <?php }?> >测试服</option>
                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['type']->value == 5) {?> selected <?php }?> >其它用途</option>
                                        </select>
                               &nbsp; <input value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['view'];?>
" type="submit" id="btnsubmit"/>
                               &nbsp;<input type="button" name="addAgent" value="代理列表/添加"  onclick="window.location='agent_list.php?action=new'" />
                                  &nbsp;<input type="button" name="addServer" value="添加服务器"  onclick="window.location='server_manage.php?action=new'"/>
                            </td>
                         </tr>
                    </table>
                </form>


                <table width="100%"  border="0" cellpadding="4" cellspacing="1">
                    <tr class='table_list_head' align='center'>
                        <td >序号</td>
                        <td >代理名</td>
                        <td >服务器名</td>
                        <td >域名</td>
                        <td >IP</td>
                        <td >类型</td>
                        <td >状态</td>
                        <td>备注</td>
                        <td >操作时间</td>
                        <td >操作</td>
                    </tr>
                    <tbody>
                        <?php echo $_smarty_tpl->tpl_vars['html']->value;?>

                    </tbody>
                </table>
                <div ><center>
                        <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

                    </center>
                </div>
            </div>
        </div>

    </body>
    <?php echo '<script'; ?>
 type="text/javascript">
        function clkAgent(key){
            key==0?$("#agentID").val(''):$("#agentID").val(key);
            
        }
    <?php echo '</script'; ?>
>
</html><?php }
}
