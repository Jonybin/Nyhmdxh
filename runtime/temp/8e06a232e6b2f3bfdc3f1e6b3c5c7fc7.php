<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\wamp\www\public/../application/admin\view\allcount\cx_fenxi.html";i:1526031677;}*/ ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"><link rel="icon" href="https://static.jianshukeji.com/highcharts/images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            /* css 代码  */
        </style>
        <script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
        <script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
        <script src="http://cdn.hcharts.cn/highcharts/modules/offline-exporting.js"></script>
        <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
    </head>
    <body>
        <div id="container" style="min-width:400px;height:400px"></div>
        <script>
            var chart = Highcharts.chart('container',{
    chart: {
        type: 'column'
    },
    title: {
        text: '南阳市行贿黑名单系统'
    },
    subtitle: {
        text: '查询数量统计'
    },
    xAxis: {
        categories: [
            <?php echo $dq_name; ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: '查询次数'
        }
    },
    tooltip: {
        // head + 每个 point + footer 拼接成完整的 table
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.f} 条</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            borderWidth: 0
        }
    },
    credits:{
            enabled: true, // 用版权信息
            href:'https://www.langrs.top',
            text:'JonyBin',
        },
    series: [<?php echo $sir; ?>]
});
        </script>
    </body>
</html>