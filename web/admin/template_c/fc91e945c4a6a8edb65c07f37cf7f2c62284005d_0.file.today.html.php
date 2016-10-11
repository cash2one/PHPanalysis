<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:43:08
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\online\today.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c8c49ff72_83131922',
  'file_dependency' => 
  array (
    'fc91e945c4a6a8edb65c07f37cf7f2c62284005d' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\online\\today.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c8c49ff72_83131922 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['today_online'];?>
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
 type="text/javascript" src="/web/admin/static/js/highcharts.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'spline'
					},
					title: {
						text: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_real_graph'];?>
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
							text: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_num'];?>
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
				                return '<b>'+ '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_num'];?>
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
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['today'];
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_num'];?>
:<?php echo $_smarty_tpl->tpl_vars['today_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['today_data']->value;?>
],
						color:'#0070dd',
					}, {
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['yesterday'];?>
:<?php echo $_smarty_tpl->tpl_vars['yest_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['yest_data']->value;?>
],
						visible:false,
					}, {
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['before_yesterday'];?>
:<?php echo $_smarty_tpl->tpl_vars['be_yest_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['be_yest_data']->value;?>
],
						visible:false,
					}, {
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['last_week_new'];?>
:<?php echo $_smarty_tpl->tpl_vars['lw_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['lw_data']->value;?>
],
						visible:false,
					},
					{
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['today'];
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_ip_num'];?>
:<?php echo $_smarty_tpl->tpl_vars['today_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['today_data_ip']->value;?>
],
						color: '#FF00FF'
					}, {
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['yesterday'];?>
:<?php echo $_smarty_tpl->tpl_vars['yest_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['yest_data_ip']->value;?>
],
						visible:false,
					}, {
						name: '<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['before_yesterday'];?>
:<?php echo $_smarty_tpl->tpl_vars['be_yest_str']->value;?>
',
						data: [<?php echo $_smarty_tpl->tpl_vars['be_yest_data_ip']->value;?>
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
		<?php echo '</script'; ?>
>

</head>

<body>
	<div id="all">
		<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['today_online'];?>
</div>
    	<div><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table cellspacing="1" cellpadding="3" border="0" class='table_list'>
                        <tr>	
                            <td colspan=9><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['sys_time_now'];?>
：<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
</td>
                        </tr>
						<tr bgcolor="#E5F9FF"> 
                            <td colspan="3" background="/web/admin/static//images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['today_online_info_Statistics'];?>
 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['current_online'];?>
:<?php echo $_smarty_tpl->tpl_vars['now_online']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['highest_online'];?>
:<?php echo $_smarty_tpl->tpl_vars['max_online']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lowest_online'];?>
:<?php echo $_smarty_tpl->tpl_vars['min_online']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['start_to_now'];
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['highest_online'];?>
:<?php echo $_smarty_tpl->tpl_vars['all_max']->value;?>
</b></font>
                            </td>
                        </tr>
                    </table>
					<div id="container" style="width: 95%; height: 100%"></div>
					<center><font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['full_service_alert'];?>
</b></font></center><br>

                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF"> 
                            <td colspan="4" background="/web/admin/static//images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['today_online_Statistics_30second_per'];?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'> 
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['statistical_time'];?>
</td>
                          <td width="25%"><label style="color:red; font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['current'];?>
</label><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_num'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['ip_count'];?>
</td>
                          <td width="50%"></td>
                        </tr>
                        <?php
$_from = $_smarty_tpl->tpl_vars['onlines']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_online_0_saved_item = isset($_smarty_tpl->tpl_vars['online']) ? $_smarty_tpl->tpl_vars['online'] : false;
$__foreach_online_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['online'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['online']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['online']->value) {
$_smarty_tpl->tpl_vars['online']->_loop = true;
$__foreach_online_0_saved_local_item = $_smarty_tpl->tpl_vars['online'];
?>
						<?php if ($_smarty_tpl->tpl_vars['key']->value%2 == 0) {?>
						<tr class='trEven'>
						<?php } else { ?>
						<tr class='trOdd'>
						<?php }?> 
                          <td width="25%"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['online']->value['dateline'],"%Y-%m-%d %H:%M:%S");?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['online'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['distinct_ip'];?>
</td>
                          <td width="50%" align="left"><img src="/web/admin/static//images/green.gif" height="5" width="<?php echo $_smarty_tpl->tpl_vars['online']->value['weight'];?>
" /></td>
                        </tr>
                        <?php
$_smarty_tpl->tpl_vars['online'] = $__foreach_online_0_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['online']->_loop) {
?>
                       	<tr bgcolor="#FFFFFF"> 
                          <td colspan="3"><font color="#FF0000"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_record'];?>
</font></td>
                        </tr>
                        <?php
}
if ($__foreach_online_0_saved_item) {
$_smarty_tpl->tpl_vars['online'] = $__foreach_online_0_saved_item;
}
if ($__foreach_online_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_online_0_saved_key;
}
?>
                        
                     </table>

                </div>
            </div>
        </div>
	</div>
</body>
</html>
<?php }
}
