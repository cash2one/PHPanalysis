<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:43:06
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\online\online_stat.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c8ad005c5_31813966',
  'file_dependency' => 
  array (
    '3a24f85422ae9b5fff9eded21b2b3ece11d32711' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\online\\online_stat.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c8ad005c5_31813966 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_statistics'];?>
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
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_statistics'];?>
</div>
      <div><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div>
      <div class='divOperation'>
        <form name="myform" method="post">
        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='date1' name='date1' size='12' value='<?php echo $_smarty_tpl->tpl_vars['date1']->value;?>
'/>&nbsp;
        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='date2' name='date2' size='12' value='<?php echo $_smarty_tpl->tpl_vars['date2']->value;?>
'/>
        &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sampling_unit'];?>
：
        <select id="viewtype" name="viewtype" >
        <option value="1" <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 1) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>
</option>
        <option value="2" <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 2) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];?>
</option>
        <option value="3" <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 3) {?>selected<?php }?>>5<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>
</option>
        <option value="4" <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 4) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['today_highest'];?>
</option>
        </select>
        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>
<input type='text' id="nickname" name='hour' size='10' value='<?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
'/>
        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>
<input type='text' id="nickname" name='min' size='10' value='<?php echo $_smarty_tpl->tpl_vars['min']->value;?>
'/>
        <input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
        </form>
    </div><br>

<TABLE style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-COLLAPSE: collapse; BACKGROUND-COLOR: white" cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-WEIGHT: bold; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid" align="left" colSpan=33>
                    <?php echo $_smarty_tpl->tpl_vars['date1']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
~<?php echo $_smarty_tpl->tpl_vars['date2']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>

                    <FONT color=red>
                        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['per'];?>

                        <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 1) {?>
                        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>

                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 2) {?>
                        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];?>

                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['viewtype']->value == 3) {?>
                        5<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>

                        <?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['average_online'];?>

                    </FONT>
                    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['trends_photo'];?>

                    (<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['total_average'];?>
:<?php echo $_smarty_tpl->tpl_vars['avgonline']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['maximum'];?>
：<?php echo $_smarty_tpl->tpl_vars['maxonline']->value;?>
) <font color="#696969"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_explain'];?>
</font>
                </TD>
              </TR>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid"vAlign=bottom align=middle>
                <table cellpadding="0" cellspacing="1">
                    <tr>
                 <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['datalist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
                <td valign="bottom" style="padding-left:10px">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0 valign="bottom">
                          <TBODY>
                          <TR>
                            <td valign=bottom>
                              <table cellspacing=0 cellpadding="0" width=15 border=0 valign="bottom">
                                <tbody>
                                <tr>
                                  <Td>
                                    <FONT color=red size=1><?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
</FONT>
                                  </Td>
                                </tr>  

                                <tr>
                                  <Td width=100<?php echo '%>';?>
                                    <IMG title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['height'];?>
 src="/web/admin/static/images/green.gif" width=100% >
                                  </Td>
                                </tr>  
                                </tbody>
                              </table>
                            </td>

                            <td valign=bottom>
                              <table cellspacing=0 cellpadding="0" width=15 border=0 valign="bottom">
                                <tbody>
                                <tr>
                                  <Td>
                                    <FONT color=red size=1><?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avg_distinct_ip'];?>
</FONT>
                                  </Td>
                                </tr>  

                                <tr>
                                  <Td width=100<?php echo '%>';?>
                                    <IMG title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avg_distinct_ip'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['distinctIpheight'];?>

                                    src="/web/admin/static/images/red.gif" width=100<?php echo '%>';?>
                                  </Td>
                                </tr>  
                                </tbody>
                              </table>
                            </td>
                          </TR>
                          <tr>
                            <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"; colspan="2"
                            align=middle>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];?>

                            <?php if ($_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'] != '') {?>
                            :
                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'];?>

                            <?php if ($_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] != '') {?>
                            <br/>
                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];?>

                           </TD>
                          </tr>
              </TBODY></TABLE>
            </td>
            <?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
            </tr>
            </table>
</TD></TR></TBODY></TABLE>

<br>
<br>


<TABLE style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-COLLAPSE: collapse; BACKGROUND-COLOR: white" cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-WEIGHT: bold; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid" align="left" colSpan=33><?php echo $_smarty_tpl->tpl_vars['date1']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
~<?php echo $_smarty_tpl->tpl_vars['date2']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
<FONT
                  color=red><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['per'];
if ($_smarty_tpl->tpl_vars['viewtype']->value == 1) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];
}
if ($_smarty_tpl->tpl_vars['viewtype']->value == 2) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];
}
if ($_smarty_tpl->tpl_vars['viewtype']->value == 3) {?>5<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];
}
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['top_online'];?>
</FONT></TD></TR>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid"
                vAlign=bottom align=middle>
                <table cellpadding="0" cellspacing="1"><tr>
                <?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['datalist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
                <td valign="bottom" style="padding-left:10px">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0
                        valign="bottom">
                          <TBODY>
                          <TR>
                            <td valign=bottom>
                              <table cellspacing=0 cellpadding="0" width=15 border=0 valign="bottom">
                                <tbody>
                                <tr>
                                  <Td>
                                    <FONT color=red size=1><?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
</FONT>
                                  </Td>
                                </tr>  

                                <tr>
                                  <Td width=100<?php echo '%>';?>
                                    <IMG
                                      title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['height'];?>

                                      src="/web/admin/static/images/green.gif"
                                      width=100<?php echo '%>';?>
                                  </Td>
                                </tr>  
                                </tbody>
                              </table>
                            </td>

                            <td valign=bottom>
                              <table cellspacing=0 cellpadding="0" width=15 border=0 valign="bottom">
                                <tbody>
                                <tr>
                                  <Td>
                                    <FONT color=red size=1><?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avg_distinct_ip'];?>
</FONT>
                                  </Td>
                                </tr>  

                                <tr>
                                  <Td width=100<?php echo '%>';?>
                                    <IMG title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avg_distinct_ip'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['distinctIpheight'];?>

                                    src="/web/admin/static/images/red.gif" width=100<?php echo '%>';?>
                                  </Td>
                                </tr>  
                                </tbody>
                              </table>
                            </td>
                          </TR>
                          <tr>
                            <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"; colspan="2"
                            align=middle>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];?>

                            <?php if ($_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'] != '') {?>
                            :
                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'];?>

                            <?php if ($_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] != '') {?>
                            <br/>
                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];?>

                           </TD>
                          </tr>
              </TBODY></TABLE>
            </td>
            <?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
            </tr>
            </table>
</TD></TR></TBODY></TABLE>
<!-- 
<TABLE style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-COLLAPSE: collapse; BACKGROUND-COLOR: white" cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-WEIGHT: bold; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid" align="left" colSpan=33><?php echo $_smarty_tpl->tpl_vars['date1']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
~<?php echo $_smarty_tpl->tpl_vars['date2']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date'];?>
<FONT
                  color=red><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['per'];
if ($_smarty_tpl->tpl_vars['viewtype']->value == 1) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];
}
if ($_smarty_tpl->tpl_vars['viewtype']->value == 2) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];
}
if ($_smarty_tpl->tpl_vars['viewtype']->value == 3) {?>5<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];
}
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['top_online'];?>
</FONT></TD></TR>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid"
                vAlign=bottom align=middle>
                <table cellpadding="0" cellspacing="1"><tr>
                <?php
$__section_loop_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['maxdatalist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_2_total = $__section_loop_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_2_total != 0) {
for ($__section_loop_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_2_iteration <= $__section_loop_2_total; $__section_loop_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
                <td valign="bottom">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0
                        valign="bottom">
                          <TBODY>
                          <TR>
                            <TD height=47></TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle height=20><FONT
                              color=red size=1><?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
</FONT>
                           </TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle><IMG
                              title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avgonline'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['height'];?>

                              src="/web/admin/static/images/green.gif"
                          width=10></TD></TR>
         <tr><TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"
                align=middle>
         <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];?>

          <?php if ($_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'] != '') {?>
        :
         <?php }?>
          <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'];?>

         <?php if ($_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] != '') {?>
         <br/>
         <?php }?>

         <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];?>
</TD></tr>
              </TBODY></TABLE>
            </td>


            <td valign="bottom">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0
                        valign="bottom">
                          <TBODY>
                          <TR>
                            <TD height=47></TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle height=20><FONT
                              color=red size=1><?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['avg_distinct_ip'];?>
</FONT>
                           </TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle><IMG
                              title=<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_times'];?>
：<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['distinct_ip'];?>
 height=<?php echo $_smarty_tpl->tpl_vars['datalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['distinctIpheight'];?>

                              src="/web/admin/static/images/red.gif"
                          width=10></TD></TR>
         <tr><TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"
                align=middle>
         <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'];?>

          <?php if ($_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'] != '') {?>
        :
         <?php }?>
          <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['minute'];?>

         <?php if ($_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['hour'] != '') {?>
         <br/>
         <?php }?>

         <?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['month'];?>
/<?php echo $_smarty_tpl->tpl_vars['maxdatalist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['day'];?>
</TD></tr>
              </TBODY></TABLE>
            </td>
            <?php
}
}
if ($__section_loop_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_2_saved;
}
?>
            </tr>
            </table>
</TD></TR></TBODY></TABLE>
-->
  </div>
</body>
</html><?php }
}
