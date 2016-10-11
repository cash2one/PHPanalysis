<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:41:28
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\server_info_gm.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c285cced3_15201736',
  'file_dependency' => 
  array (
    '38193d8acee206bda9705eb557195c66188a8714' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\server_info_gm.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c285cced3_15201736 ($_smarty_tpl) {
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

        <style type="text/css">
            #all {text-align:left;margin-left:4px; line-height:1;}
            #nodes {width:100%;float:left;border:1px #ccc solid;}
            #result {width: 100%; height:100%; clear:both;border:1px #ccc solid;}
            .table_all_head { color:#232323; background-color:#99CC66;font-weight:bold; }

        </style>
        <title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['server_info'];?>
</title>
    </head>
    <body>
        <div id="all">
            <div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['server_info'];?>
</div>
            <p align="center"><font color="red"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</font></p>
            <div id="main"><form name="form" method="GET">
                    <input type="hidden" name="action" value="save"/>
                    <table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#D7E4F5">
                        <tr>
                            <td width="33%">
                                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['stat'];?>
：<select name="serverStatus" id="serverStatus">
                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['info']->value['stat'] == 1) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['open_server'];?>
</option>
                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['info']->value['stat'] == 2) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['combine_server'];?>
</option>
                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['info']->value['stat'] == 3) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['close_server'];?>
</option>
                                    <option value="4" <?php if ($_smarty_tpl->tpl_vars['info']->value['stat'] == 4) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['un_open_server'];?>
</option>
                                </select>
                            </td>
                            <td width="33%">
                                类型：<select name="serverType" id="serverType"   >
                                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['info']->value['s_type'] == 1) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['ch_cn_server'];?>
</option>
                                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['info']->value['s_type'] == 2) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['ch_tw_server'];?>
</option>
                                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['info']->value['s_type'] == 3) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['vn_server'];?>
</option>
                                    <option value="4" <?php if ($_smarty_tpl->tpl_vars['info']->value['s_type'] == 4) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['test_server'];?>
</option>
                                    <option value="5" <?php if ($_smarty_tpl->tpl_vars['info']->value['s_type'] == 5) {?> selected <?php }?> ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['other_server'];?>
</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                          
                            <td  width="40%">
                                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['domain_name'];?>
：<input type="text" name="domainName" size="50" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['domain_name'];?>
"/>
                                <font color="red">*</font>如：dtz1.my4399.com
                            </td>
                        </tr>
                        <tr>
                            <td width="33%">&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['open_time'];?>
：
                                <input value="<?php echo $_smarty_tpl->tpl_vars['open_time']->value;?>
" class="Wdate" id="openTime"  name="openTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" size="22" />(注：可为空)&nbsp;
                            </td>
                            <td width="33%" ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['combine_time'];?>
：
                                <input value="<?php echo $_smarty_tpl->tpl_vars['combine_time']->value;?>
" class="Wdate" id="combineTime"  name="combineTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" size="22" />(注：可为空)&nbsp;
                            </td>
                            <td width="33%" ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['close_time'];?>
：
                                <input value="<?php echo $_smarty_tpl->tpl_vars['close_time']->value;?>
" class="Wdate" id="closeTime"  name="closeTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" size="22" />(注：可为空)&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['descript'];?>
：<textarea style="width:350px;height:50px;" name="sDesc" id="sDesc" ><?php echo $_smarty_tpl->tpl_vars['info']->value['s_desc'];?>
</textarea>(注：可为空)
                            </td>
                        </tr>

                        <tr>
                             <td colspan="2">
                                <div align="left">&nbsp;
                                    <input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['save'];?>
"/>&nbsp;&nbsp;&nbsp;
                                    <input type="reset" name="reset" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['modify'];?>
" />
                                </div>
                            </td>
                         </tr>

                    </table>
                </form>
            </div>
        </div>

    </body>

</html><?php }
}
