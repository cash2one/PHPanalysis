<?php
/* Smarty version 3.1.29, created on 2016-09-05 10:15:18
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\center\link_agent_info.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ccd5368fd047_27036086',
  'file_dependency' => 
  array (
    'a47a0c0da1495b2d1b734339666ed231048a3659' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\center\\link_agent_info.html',
      1 => 1468910703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ccd5368fd047_27036086 ($_smarty_tpl) {
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

        <style type="text/css">
            #all {text-align:left;margin-left:4px; line-height:1;}
            #nodes {width:100%;float:left;border:1px #ccc solid;}
            #result {width: 100%; height:100%; clear:both;border:1px #ccc solid;}
            .table_all_head { color:#232323; background-color:#99CC66;font-weight:bold; }

        </style>
        <title>代理链接</title>
    </head>
    <body>
        <div id="all">
            <div id="position">代理链接</div>
            <div id="main">
                <table width="100%"  border="0" cellpadding="4" cellspacing="1">
                    <tr class='table_list_head' align='center'><td colspan="6"><b>代理列表</b></td> </tr>
                    <tr class='table_list_head' align='center'>
                        <td>序号</td>
                        <td >代理管理后台</td>
                        <td>官网</td>
                        <td>论坛</td>
                        <td>首服时间</td>
                        <td>已开服数量</td>
                    </tr>
                    <tbody>
                       	<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['data']->value) ? count($_loop) : max(0, (int) $_loop));
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
                                <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)+1;?>
</td>
                                <td><a target="blank" href='<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['agent_system'];?>
'><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['agent_name'];?>
</a></td>
                                <td><a target="blank" href='<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['official_website'];?>
'><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['official_website'];?>
</a></td>
                                <td><a target="blank" href='<?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bbs'];?>
'><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bbs'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['first_open_time'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['server_num'];?>
</td>
                            </tr>
                            <?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html><?php }
}
