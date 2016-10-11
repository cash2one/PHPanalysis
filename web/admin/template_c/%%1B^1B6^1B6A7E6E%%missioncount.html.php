<?php /* Smarty version 2.6.25, created on 2016-05-21 11:24:49
         compiled from module/missioncount/missioncount.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['task_lose_rate']; ?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
</script>
</head>

<body>
	<div id="all">
	<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['loss_rate_analysis']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['task_lose_rate']; ?>
</div>
		<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
             <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['mission']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			 <?php if ($this->_sections['loop']['rownum'] % 20 == 1): ?>
			 <tr class='table_list_head'>
                 <td><?php echo $this->_tpl_vars['_lang']['left']['task_id']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['left']['task_name']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['left']['accept_num']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['left']['finish_num']; ?>
</td><td><?php echo $this->_tpl_vars['_lang']['left']['task_lose_rate']; ?>
</td>
             </tr>
			 <?php endif; ?>
					<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
					<tr class='trEven'>
					<?php else: ?>
					<tr class='trOdd'>
					<?php endif; ?>
                            <td><?php echo $this->_tpl_vars['mission'][$this->_sections['loop']['index']]['mission_id']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['mission'][$this->_sections['loop']['index']]['name']; ?>
</td>
                        	<td><?php echo $this->_tpl_vars['mission'][$this->_sections['loop']['index']]['accept_num']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['mission'][$this->_sections['loop']['index']]['complete_num']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['mission'][$this->_sections['loop']['index']]['mission_lost_rate']; ?>
%</td>
                  </tr>
             <?php endfor; endif; ?>
		</table>
	</div>
</body>
</html>