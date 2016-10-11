<?php /* Smarty version 2.6.25, created on 2016-05-21 14:55:59
         compiled from module/pay/pay_month.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/highcharts.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'column'
        },
        title: {
            text: '<?php echo $this->_tpl_vars['_lang']['left']['monthly_recharge_histogram']; ?>
'
        },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function() {
                return ''+
                    Highcharts.dateFormat(' %Y年%m月%e日', this.x) +'<br/>'+ this.series.name +'：' + this.y;
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['amount']; ?>
',
            data: [<?php echo $this->_tpl_vars['pay_data_total']; ?>
]				
        },{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['qq_amount']; ?>
',
            data: [<?php echo $this->_tpl_vars['pay_data_qq']; ?>
]				
        },{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['ticket_amount']; ?>
',
            data: [<?php echo $this->_tpl_vars['pay_data_ticket']; ?>
]				
        },{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['people_times']; ?>
',
            data: [<?php echo $this->_tpl_vars['times_cnt_data']; ?>
]
        },{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['people_num']; ?>
',
            data: [<?php echo $this->_tpl_vars['role_cnt_data']; ?>
]
        },{
            name: '<?php echo $this->_tpl_vars['_lang']['conmon']['arpu']; ?>
',
            data: [<?php echo $this->_tpl_vars['arpu_data']; ?>
]
        }]
    });
});
</script>
<title>
	<?php echo $this->_tpl_vars['_lang']['left']['recharge_statistics_day']; ?>

</title>
</head>

<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['ingot_month_statistics']; ?>
</div>
<form name="myform" method="post" action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
">
<?php echo $this->_tpl_vars['_lang']['conmon']['start_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM'})" id='dateStart' name='dateStart' size='10' value='<?php echo $this->_tpl_vars['search_keyword1']; ?>
'/>
&nbsp;<?php echo $this->_tpl_vars['_lang']['conmon']['end_time']; ?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM'})" id='dateEnd' name='dateEnd' size='10' value='<?php echo $this->_tpl_vars['search_keyword2']; ?>
'/>
<input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"  />
&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['record_count']): ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['total']; ?>
<?php echo $this->_tpl_vars['record_count']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['records']; ?>

<?php endif; ?>
<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
<center><b><?php echo $this->_tpl_vars['_lang']['left']['ingot_month_statistics_note']; ?>
</b></center>
<?php if ($this->_tpl_vars['balance']): ?>
<br><span style="color:red;font-weight: bold;"><?php echo $this->_tpl_vars['_lang']['new']['all_money_from']; ?>
：<?php echo $this->_tpl_vars['balance']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['yuan']; ?>
</span>
<?php endif; ?>
</form>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
<form method="get" action="">
 <?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
 <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?page=<?php echo $this->_tpl_vars['item']; ?>
&amp;forceFlag=<?php echo $this->_tpl_vars['forceFlag']; ?>
"><?php echo $this->_tpl_vars['key']; ?>
</a><span style="width:5px;"></span>
 <?php endforeach; endif; unset($_from); ?>

	<center><?php if ($this->_tpl_vars['page_count'] > 0): ?>
	<?php echo $this->_tpl_vars['_lang']['conmon']['all_page']; ?>
(<?php echo $this->_tpl_vars['page_count']; ?>
)

	<?php if ($this->_tpl_vars['page_count'] > 5): ?>
	  <input name="page" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO">
	<?php endif; ?>

	[ <a href="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?excel=true&dateStart=<?php echo $this->_tpl_vars['search_keyword1']; ?>
&dateEnd=<?php echo $this->_tpl_vars['search_keyword2']; ?>
"><?php echo $this->_tpl_vars['_lang']['conmon']['out_excel']; ?>
</a> ]
	<?php endif; ?>
</center></form>
    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
<form id="form1" name="form1" method="post" action="">
<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['keywordlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['date_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['amount']; ?>
</td>
        <td><?php echo $this->_tpl_vars['_lang']['conmon']['qq_amount']; ?>
</td>
        <td><?php echo $this->_tpl_vars['_lang']['conmon']['ticket_amount']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['people_times']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['people_num']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['conmon']['arpu']; ?>
</td>
	</tr>
	<?php endif; ?>

	<?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
	<tr class='trEven'>
	<?php else: ?>
	<tr class='trOdd'>
	<?php endif; ?>
		<td>
		<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['year']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['year']; ?>
<?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['month']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['month']; ?>

		</td>
        <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['pay_day_total']; ?>
</td>
        <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['pay_day_qq']; ?>
</td>
        <td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['pay_day_ticket']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['times_cnt']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['role_cnt']; ?>
</td>
		<td><?php echo $this->_tpl_vars['keywordlist'][$this->_sections['loop']['index']]['arpu']; ?>
</td>
	</tr>
<?php endfor; else: ?>

<?php endif; ?>
<!-- SECTION  END -------------------------->

</form>
</table>

</body>
</html>