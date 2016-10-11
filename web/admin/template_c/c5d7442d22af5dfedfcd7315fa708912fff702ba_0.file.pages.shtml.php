<?php
/* Smarty version 3.1.29, created on 2016-09-29 09:27:16
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\common\pages.shtml" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ec6df46790b4_43654757',
  'file_dependency' => 
  array (
    'c5d7442d22af5dfedfcd7315fa708912fff702ba' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\common\\pages.shtml',
      1 => 1472643644,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ec6df46790b4_43654757 ($_smarty_tpl) {
?>
<table style="width:100%;">
    <tr class='trOdd'>
    <td height="30" class="even">
    <?php if ($_smarty_tpl->tpl_vars['pageList']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['pageList']->value;
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
            <a id="pageUrl" href="javascript:void(0);" onclick="changePage('<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
');"> <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 </a>
            <span style="width:5px;"></span>
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
        &nbsp; &nbsp; &nbsp; 
    <?php }?>
    总共 <?php echo $_smarty_tpl->tpl_vars['recordCnt']->value;?>
 个记录 &nbsp; &nbsp; &nbsp; 
	每页显示<input type="text" id="recordPerPage" name="recordPerPage" size="3" style="text-align:center;" value="<?php echo $_smarty_tpl->tpl_vars['recordPerPage']->value;?>
" />个记录
    &nbsp; &nbsp; &nbsp; 总共 <?php echo $_smarty_tpl->tpl_vars['pageCnt']->value;?>
 页 &nbsp; &nbsp; &nbsp; 
    跳至<input id="page" name="page" type="text" class="text" size="3" style="text-align:center;" maxlength="6" value="<?php echo $_smarty_tpl->tpl_vars['pageNo']->value;?>
" />页 &nbsp;
    <input type="submit" class="button" name="Submit" value="GO">
    </td>
    </tr>
</table>

<?php }
}
