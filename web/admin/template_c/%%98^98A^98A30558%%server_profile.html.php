<?php /* Smarty version 2.6.25, created on 2015-12-03 21:06:52
         compiled from module/pay/server_profile.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>


<title>
	<?php echo $this->_tpl_vars['_lang']['new']['server_profile']; ?>

</title>
<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
：<?php echo $this->_tpl_vars['_lang']['new']['server_profile']; ?>
</div>

 <table width="100%" border="01" cellspacing="1" cellpadding="2" align="center" bgcolor="#E5F9FF">
     <tr align="left">
         <td><b><?php echo $this->_tpl_vars['_lang']['new']['agents']; ?>
:</b><?php echo $this->_tpl_vars['agent_name']; ?>
</td><td><b><?php echo $this->_tpl_vars['_lang']['conmon']['server']; ?>
:</b>S<?php echo $this->_tpl_vars['server']['server_id']; ?>
</td><td> <font color="red"><?php echo $this->_tpl_vars['message']; ?>
</font></td>
     </tr>
     <tr align="left">
         <td><b><?php echo $this->_tpl_vars['_lang']['new']['open_time']; ?>
:</b><?php echo $this->_tpl_vars['server']['open_time']; ?>
</td><td><b><?php echo $this->_tpl_vars['_lang']['new']['have_open_days']; ?>
:</b><?php echo $this->_tpl_vars['server']['date']; ?>
</td><td><b>Erlang版本:</b><?php echo $this->_tpl_vars['erlang_version']; ?>
</td>
     </tr>
     <tr align="left">
         <td><b><?php echo $this->_tpl_vars['_lang']['left']['register_num']; ?>
:</b><?php echo $this->_tpl_vars['register']; ?>
</td><td><b><?php echo $this->_tpl_vars['_lang']['left']['max_level']; ?>
:</b><?php echo $this->_tpl_vars['max_level']; ?>
</td><td>&nbsp;<!--<b>注册角色数:</b><?php echo $this->_tpl_vars['register']; ?>
--></td>
     </tr>
     <tr align="left">
         <td><b><?php echo $this->_tpl_vars['_lang']['conmon']['total_recharge_amount']; ?>
:</b><?php echo $this->_tpl_vars['pay_money']; ?>
</td><td><b><?php echo $this->_tpl_vars['_lang']['conmon']['total_recharge_num']; ?>
:</b><?php echo $this->_tpl_vars['pay_num']; ?>
</td><td><b>ARPU:</b><?php echo $this->_tpl_vars['arpu']; ?>
</td>
     </tr>
     <tr align="left">
         <td><b><?php echo $this->_tpl_vars['_lang']['left']['highest_online']; ?>
:</b><?php echo $this->_tpl_vars['max_all_online']; ?>
</td><td><b><?php echo $this->_tpl_vars['_lang']['new']['day_max_pay']; ?>
:</b><?php echo $this->_tpl_vars['max_all_pay']; ?>
</td><td> &nbsp;</td>
     </tr>
</table>

<form name="myform" method="post" action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
">
    <table><tr><td>
<?php echo $this->_tpl_vars['_lang']['conmon']['statistics']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dStartTime' size='12' value='<?php echo $this->_tpl_vars['dStartTime']; ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dEndTime' size='12' value='<?php echo $this->_tpl_vars['dEndTime']; ?>
'/>
<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"  />
</td></tr></table>
</form>
<table>
     <tr>
            <td> <FONT color=red><b><?php echo $this->_tpl_vars['_lang']['left']['recharge_statistics_day']; ?>
</b></FONT></td>
    </tr>
    <tr>
            <td>
<TABLE style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-COLLAPSE: collapse; BACKGROUND-COLOR: white" cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-WEIGHT: bold; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid" align="left" colSpan=33><?php echo $this->_tpl_vars['dStartTime']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>
--<?php echo $this->_tpl_vars['dEndTime']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>

                    <?php echo $this->_tpl_vars['_lang']['left']['trends_photo']; ?>
(<?php echo $this->_tpl_vars['_lang']['conmon']['total_average']; ?>
:<font color=red><?php echo $this->_tpl_vars['avg_pay']; ?>
</font> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['maximum']; ?>
：<font color=red><?php echo $this->_tpl_vars['max_pay']; ?>
</font>)</TD></TR>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid"
                vAlign=bottom align=middle>
                <table cellpadding="0" cellspacing="1"><tr>
                <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['pay']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
                <td valign="bottom">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0
                        valign="bottom">
                          <TBODY>
                          <TR>
                            <TD height=47></TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle height=20><FONT
                              color=red size=1><?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['money']; ?>
</FONT>
                           </TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle><IMG
                              title=<?php echo $this->_tpl_vars['_lang']['conmon']['total_recharge_amount']; ?>
：<?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['money']; ?>
 height=<?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['height']; ?>

                              src="/web/admin/static/images/green.gif"
                          width=16></TD></TR>
				 <tr><TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"
                align=middle>
				<?php if ($this->_tpl_vars['pay'][$this->_sections['loop']['index']]['week'] == 0 || $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['week'] == 6): ?><font color=red>
                                <?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['date']; ?>
</font>
                                <?php else: ?>
				 <?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['date']; ?>

                                     <?php endif; ?></TD></tr>
						  </TBODY></TABLE>
			      </td>
			      <?php endfor; endif; ?>
			      </tr>
			      </table>
</TD></TR></TBODY></TABLE>
            </td>
        </tr>

    <tr>
        <td><FONT color=red><b><?php echo $this->_tpl_vars['_lang']['left']['top_online']; ?>
</b></FONT></td>
    </tr>
    <tr>
        <td>
<TABLE style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; BORDER-COLLAPSE: collapse; BACKGROUND-COLOR: white" cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-WEIGHT: bold; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid" align="left" colSpan=33><?php echo $this->_tpl_vars['dStartTime']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>
--<?php echo $this->_tpl_vars['dEndTime']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['date']; ?>

                    <?php echo $this->_tpl_vars['_lang']['left']['trends_photo']; ?>
(<?php echo $this->_tpl_vars['_lang']['conmon']['total_average']; ?>
:<font color=red><?php echo $this->_tpl_vars['avg_online']; ?>
</font>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['maximum']; ?>
：<font color=red><?php echo $this->_tpl_vars['max_online']; ?>
</font>)</TD></TR>
              <TR>
                <TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid"
                vAlign=bottom align=middle>
                <table cellpadding="0" cellspacing="1"><tr>
                <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['online']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
                <td valign="bottom">
                  <TABLE cellSpacing=0 cellPadding=0 width=15 border=0
                        valign="bottom">
                          <TBODY>
                          <TR>
                            <TD height=47></TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle height=20><FONT
                              color=red size=1><?php echo $this->_tpl_vars['online'][$this->_sections['loop']['index']]['online']; ?>
</FONT>
                           </TD></TR>
                          <TR>
                            <TD vAlign=bottom align=middle><IMG
                              title=<?php echo $this->_tpl_vars['_lang']['left']['login_times']; ?>
：<?php echo $this->_tpl_vars['online'][$this->_sections['loop']['index']]['online']; ?>
 height=<?php echo $this->_tpl_vars['online'][$this->_sections['loop']['index']]['height']; ?>

                              src="/web/admin/static/images/green.gif"
                          width=16></TD></TR>
				 <tr><TD style="BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: 1px solid; BORDER-BOTTOM: 1px solid; WHITE-SPACE: nowrap; BACKGROUND-COLOR: whitesmoke"
                align=middle>
				 <?php if ($this->_tpl_vars['pay'][$this->_sections['loop']['index']]['week'] == 0 || $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['week'] == 6): ?><font color=red>
                                <?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['date']; ?>
</font>
                                <?php else: ?>
				 <?php echo $this->_tpl_vars['pay'][$this->_sections['loop']['index']]['date']; ?>

                                     <?php endif; ?></TD></tr>
						  </TBODY></TABLE>
			      </td>
			      <?php endfor; endif; ?>
			      </tr>
			      </table>
</TD></TR></TBODY></TABLE>
        </td>
        </tr>
   
</table>
</body>
</html>