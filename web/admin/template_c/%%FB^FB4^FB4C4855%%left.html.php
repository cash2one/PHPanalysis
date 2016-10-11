<?php /* Smarty version 2.6.25, created on 2016-07-21 11:50:20
         compiled from left.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</title>
<link rel="stylesheet" href="../admin/static/css/base.css" type="text/css">
<style type="text/css">
body { margin:3px; padding:0px; font-size:12px; font-family:"Courier New", Courier, monospace; background:#86C1FF; margin:3 0 0 0;}
.tdborder {
	border-left: 1px solid #43938B;
	border-right: 1px solid #43938B;
	border-bottom: 1px solid #43938B;
}
.tdrl {
	border-left: 1px solid #788C47;
	border-right: 1px solid #788C47;
}
.topitem {
	cursor: hand;
	background-image:url(../admin/static/images/mtbg1.gif);
	height:24px;
	width:98%;
	border-right: 1px solid #2FA1DB;
	border-left: 1px solid #2FA1DB;
	clear:left
}
.itemsct {
	border-right: 1px solid #2FA1DB;
	border-left: 1px solid #2FA1DB;
	background-color:#EEFAFE;
	margin-bottom:6px;
	width:98%;
}
.itemem {
	text-align:left;
	clear:left;
	border-bottom: 1px solid #2FA1DB;
	height:21px;
}
.tdl {
	float:left;
	margin-top:2px;
	margin-left:6px;
	margin-right:5px
}
.tdr {
	float:left;
	margin-top:2px
}
.topl {
	float:left;

	margin-right:3px;
}
.topr {
	padding-top:4px;
	cursor:pointer;
}
.toprt {
	text-align:center;
	padding-top:3px
}
body {
	scrollbar-base-color:#8CC1FE;
	scrollbar-arrow-color:#FFFFFF;
	scrollbar-shadow-color:#6994C2
}
.green{
	background-color:#CCFFCC;
}


</style>
<script type="text/javascript" src="../admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
showHide = function(objID) {
	$('#' + objID).toggle();//切换元素的可见状态
}
$(document).ready(function(){
	$(".itemem").click(function(){
		$(".itemem").removeClass("green");
		$(this).addClass("green");
	});
});

</script>
</head>

<body>
	<div id="all">
    	<div class='topitem' align='left'>
    		<div class='topl'></div>
    		<div class='topr'><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</div>
  	</div>
         
            
    	<div onClick='showHide("items1")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['server_info']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items1' class='itemsct'>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'SERVER_INFO'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


        <div onClick='showHide("items2")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['online_register']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items2' class='itemsct'>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'ONLINE_REG'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>

        
	<div onClick='showHide("items3")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['loss_rate_analysis']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items3' class='itemsct'>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'LOST_RATE'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


        <div onClick='showHide("items4")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items4' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'CONSUME_LOG'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


     	<div onClick='showHide("items5")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['data_analysis']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items5' class='itemsct'>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'DATA_ANL'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


	<div onClick='showHide("items6")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['new']['operate_act']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items6' class='itemsct'>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'FESTIVAL_DATA'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


     	<div onClick='showHide("items7")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['message_manage']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items7' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'MSG_MAN'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


     	<div onClick='showHide("items8")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['gm_manage']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items8' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'GM_MAN'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>


     	<div onClick='showHide("items9")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['admin_manage']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items9' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'BACK_MAN'): ?>
		<dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
                </dl>
            <?php endif; ?>
	<?php endfor; endif; ?>
     	</div>


     	<div onClick='showHide("items10")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['left']['sys_manage']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items10' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'SYSTEM'): ?>
		<dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
                </dl>
            <?php endif; ?>
	<?php endfor; endif; ?>
     	</div>
        
        
    <!-- 以下为新加入功能 根据数据后台需求表-->
    <!-- 基本信息 -->
        <div onClick='showHide("items11")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['basic_info']; ?>
</div>
      	</div>
      	<div style='clear:both'></div><!-- 清除全部样式 使下面的div不会错位 -->
      	<div style='display:none' id='items11' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'BASIC_INFO'): ?>
                <dl class='itemem'>
                    <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                    <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
                </dl>
            <?php endif; ?>
        <?php endfor; endif; ?>
     	</div>
        
        <!-- 用户付费 -->
        <div onClick='showHide("items12")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['user_pay']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items12' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'USER_PAY'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>
        
        <!-- 留存活跃 -->
        <div onClick='showHide("items13")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['keep_active']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items13' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'KEEP_ACTIVE'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>
        
        <!-- 参与信息 -->
        <div onClick='showHide("items14")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['participate_info']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items14' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'PARTICIPATE_INFO'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>
        
        <!-- 资源概况 -->
       <div onClick='showHide("items15")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['resource_overview']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items15' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'RESOURCE_OVERVIEW'): ?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
            </dl>
			<?php endif; ?>
		<?php endfor; endif; ?>
     	</div>
        
        <!-- 新手引导-->
        <div onClick='showHide("items16")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $this->_tpl_vars['_lang']['data']['novice']; ?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items16' class='itemsct'>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['user_power']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <?php if ($this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['man_type'] == 'NOVICE'): ?>
                <dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['url']; ?>
 target='main_frame'><?php echo $this->_tpl_vars['user_power'][$this->_sections['loop']['index']]['desc']; ?>
</a></dd>
                </dl>
            <?php endif; ?>
	<?php endfor; endif; ?>
     	</div>

    </div>
</body>
</html>