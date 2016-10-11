<?php /* Smarty version 2.6.25, created on 2016-07-11 11:30:02
         compiled from module/online/today.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/online/today.html', 200, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['today_online']; ?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/highcharts.js"></script>

<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'spline'
					},
					title: {
						text: '<?php echo $this->_tpl_vars['_lang']['left']['online_real_graph']; ?>
'
					},
				//	subtitle: {
				//		text: 'October 6th and 7th 2009 at two locations in Vik i Sogn, Norway'
				//	},
					xAxis: {
						type: 'datetime'
					},
					yAxis: {
						title: {
							text: '<?php echo $this->_tpl_vars['_lang']['left']['online_num']; ?>
'
						},
						min: 0,
						maxPadding: 0.02,
						minorGridLineWidth: 0, 
						gridLineWidth: 0,
						alternateGridColor: null,
						plotBands: [{ 
							from: 0,
							to: 500,
							color: 'rgba(0, 0, 0, 0)',
							label: {
								//text: 'Light air',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 500,
							to: 1000,
							color: 'rgba(68, 170, 213, 0.1)',
							label: {
								//text: 'Light breeze',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 1000,
							to: 1500,
							color: 'rgba(0, 0, 0, 0)',
							label: {
								//text: 'Gentle breeze',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 1500,
							to: 2000,
							color: 'rgba(68, 170, 213, 0.1)',
							label: {
								//text: 'Moderate breeze',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 2000,
							to: 2500,
							color: 'rgba(0, 0, 0, 0)',
							label: {
								//text: 'Fresh breeze',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 2500,
							to: 3000,
							color: 'rgba(68, 170, 213, 0.1)',
							label: {
								//text: 'Strong breeze',
								style: {
									color: '#606060'
								}
							}
						}, { 
							from: 3000,
							to: 3500,
							color: 'rgba(0, 0, 0, 0)',
							label: {
								//text: 'High wind',
								style: {
									color: '#606060'
								}
							}
						}]
					},
					tooltip: {
						formatter: function() {
				                return '<b>'+ '<?php echo $this->_tpl_vars['_lang']['left']['online_num']; ?>
' +'</b><br/>'+ this.series.name +
								Highcharts.dateFormat(' %H:%M:%S', this.x) +', '+ this.y +' 人';
						}
					},
					plotOptions: {
						spline: {
							lineWidth: 1,
							states: {
								hover: {
									lineWidth: 2
								}
							},
							marker: {
								enabled: false,
								states: {
									hover: {
										enabled: true,
										symbol: 'circle',
										radius: 5,
										lineWidth: 1
									}
								}	
							},
							pointInterval: 30, // one hour
							//pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
						}
					},
					series: [{
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['today']; ?>
<?php echo $this->_tpl_vars['_lang']['left']['online_num']; ?>
:<?php echo $this->_tpl_vars['today_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['today_data']; ?>
],
						color:'#0070dd',
					}, {
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['yesterday']; ?>
:<?php echo $this->_tpl_vars['yest_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['yest_data']; ?>
],
						visible:false,
					}, {
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['before_yesterday']; ?>
:<?php echo $this->_tpl_vars['be_yest_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['be_yest_data']; ?>
],
						visible:false,
					}, {
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['last_week_new']; ?>
:<?php echo $this->_tpl_vars['lw_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['lw_data']; ?>
],
						visible:false,
					},
					{
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['today']; ?>
<?php echo $this->_tpl_vars['_lang']['left']['online_ip_num']; ?>
:<?php echo $this->_tpl_vars['today_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['today_data_ip']; ?>
],
						color: '#FF00FF'
					}, {
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['yesterday']; ?>
:<?php echo $this->_tpl_vars['yest_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['yest_data_ip']; ?>
],
						visible:false,
					}, {
						name: '<?php echo $this->_tpl_vars['_lang']['conmon']['before_yesterday']; ?>
:<?php echo $this->_tpl_vars['be_yest_str']; ?>
',
						data: [<?php echo $this->_tpl_vars['be_yest_data_ip']; ?>
],
						visible:false,
					}, 

					],
					navigation: {
						menuItemStyle: {
							fontSize: '10px'
						}
					}
				});
				
				
			});			
		</script>

</head>

<body>
	<div id="all">
		<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['online_register']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['today_online']; ?>
</div>
    	<div><?php echo $this->_tpl_vars['errorMsg']; ?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table cellspacing="1" cellpadding="3" border="0" class='table_list'>
                        <tr>	
                            <td colspan=9><?php echo $this->_tpl_vars['_lang']['conmon']['sys_time_now']; ?>
：<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                        </tr>
						<tr bgcolor="#E5F9FF"> 
                            <td colspan="3" background="/web/admin/static//images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['today_online_info_Statistics']; ?>
 <?php echo $this->_tpl_vars['_lang']['left']['current_online']; ?>
:<?php echo $this->_tpl_vars['now_online']; ?>
 <?php echo $this->_tpl_vars['_lang']['left']['highest_online']; ?>
:<?php echo $this->_tpl_vars['max_online']; ?>
 <?php echo $this->_tpl_vars['_lang']['left']['lowest_online']; ?>
:<?php echo $this->_tpl_vars['min_online']; ?>
 <?php echo $this->_tpl_vars['_lang']['left']['start_to_now']; ?>
<?php echo $this->_tpl_vars['_lang']['left']['highest_online']; ?>
:<?php echo $this->_tpl_vars['all_max']; ?>
</b></font>
                            </td>
                        </tr>
                    </table>
					<div id="container" style="width: 95%; height: 100%"></div>
					<center><font color="red"><b><?php echo $this->_tpl_vars['_lang']['left']['full_service_alert']; ?>
</b></font></center><br>

                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF"> 
                            <td colspan="4" background="/web/admin/static//images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['today_online_Statistics_30second_per']; ?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'> 
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['left']['statistical_time']; ?>
</td>
                          <td width="25%"><label style="color:red; font-weight:bold;"><?php echo $this->_tpl_vars['_lang']['new']['current']; ?>
</label><?php echo $this->_tpl_vars['_lang']['left']['online_num']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['_lang']['conmon']['ip_count']; ?>
</td>
                          <td width="50%"></td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['onlines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['online']):
?>
						<?php if ($this->_tpl_vars['key'] % 2 == 0): ?>
						<tr class='trEven'>
						<?php else: ?>
						<tr class='trOdd'>
						<?php endif; ?> 
                          <td width="25%"><?php echo ((is_array($_tmp=$this->_tpl_vars['online']['dateline'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['online']; ?>
</td>
                          <td width="25%"><?php echo $this->_tpl_vars['online']['distinct_ip']; ?>
</td>
                          <td width="50%" align="left"><img src="/web/admin/static//images/green.gif" height="5" width="<?php echo $this->_tpl_vars['online']['weight']; ?>
" /></td>
                        </tr>
                        <?php endforeach; else: ?>
                       	<tr bgcolor="#FFFFFF"> 
                          <td colspan="3"><font color="#FF0000"><?php echo $this->_tpl_vars['_lang']['left']['no_record']; ?>
</font></td>
                        </tr>
                        <?php endif; unset($_from); ?>
                        
                     </table>

                </div>
            </div>
        </div>
	</div>
</body>
</html>