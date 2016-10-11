<?php /* Smarty version 2.6.25, created on 2016-07-21 11:50:23
         compiled from module/basic_info/role_info.html */ ?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>角色信息</title>
                <link rel="stylesheet" href="../../../public/static/css/tags.css" type="text/css">
		<script type="text/javascript" src="../../../public/static/js/jquery-3.0.0.min.js"></script>
		<style type="text/css">
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: '月平均玩家登录数',
            x: -20 //center
        },
        subtitle: {
            text: '数据来自: 后台',
            x: -20
        },
        xAxis: {
            categories: ['一月份', '二月份', '三月份', '四月份', '五月份', '六月份',
                '七月份', '八月份', '九月份', '十月份', '十一月份', '十二月份']
        },
        yAxis: {
            title: {
                text: '登录次数'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '次'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '服务器一',
            data: [10000, 10005, 9559, 9000, 15005, 13000, 13500, 13500, 13200, 12900, 11001, 14002]
        }, {
            name: '服务器二',
            data: [10090, 9005, 10089, 9800, 13005, 13000, 12500, 11500, 13200, 12900, 12001, 13002]
        }, {
            name: '服务器三',
            data: [9000, 10200, 9559, 10200, 13005, 11000, 12500, 17500, 18200, 15900, 16001, 14002]
        }, {
            name: '服务器四',
            data: [8000, 10005, 9559, 12000, 14005, 15000, 13500, 16500, 14200, 18900, 19001, 20002]
        }]
    });
});
		</script>
	</head>
<body>
<script src="../../../public/static/js/highcharts/highcharts.js"></script>
<script src="../../../public/static/js/highcharts/modules/exporting.js"></script>
<h3>角色信息</h3>
<hr border="3px" color="#2e6fac">
<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
</body>
</html>
