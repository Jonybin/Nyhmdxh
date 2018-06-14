<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\wamp\www\public/../application/admin\view\allcount\lr_fenxi.html";i:1526008707;}*/ ?>
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
        <script src="https://img.hcharts.cn/highcharts/modules/drilldown.js"></script>
        <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
    </head>
    <body>
        <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
        <div id="container_2" style="min-width:400px;height:400px"></div>
        <script>
        Highcharts.chart('container', {

        chart: {
            type: 'column'
        },
        title: {
            text: '南阳市行贿黑名单系统'
        },
        subtitle: {
            text: '录入单位占比分析'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '录入占比'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
        series: [{
            name: '录入单位',
            colorByPoint: true,
            data: [<?php echo $str; ?>]
           
        }],
        drilldown: {
            series: [<?php echo $dir; ?>]
        },
        credits:{
            enabled: true, // 禁用版权信息
            href:'https://www.langrs.top',
            text:'JonyBin',
        }
    }); 

//第二个
    var chart = Highcharts.chart('container_2',{
    chart: {
        type: 'column'
    },
    title: {
        text: '录入地区'
    },
    subtitle: {
        text: '录入地区数量对比'
    },
    xAxis: {
        categories: [
            <?php echo $diqu_name; ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: '录入数量 (条)'
        }
    },
    tooltip: {
        // head + 每个 point + footer 拼接成完整的 table
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.f}条</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    credits:{
            enabled: true, // 禁用版权信息
            href:'https://www.langrs.top',
            text:'JonyBin',
        },
    plotOptions: {
        column: {
            borderWidth: 0
        }
    },
    series: [<?php echo $fir; ?>]//各个单位下地区的总量
});
</script>
    </body>
</html>
<!-- {
                name: '纪检委',
                id: '纪检委',
                data: [
                    [
                        'v11.0',
                        24.13
                    ],
                    [
                        'v8.0',
                        17.2
                    ],
                    [
                        'v9.0',
                        8.11
                    ],
                    [
                        'v10.0',
                        5.33
                    ],
                    [
                        'v6.0',
                        1.06
                    ],
                    [
                        'v7.0',
                        0.5
                    ]
                ]
            }, {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    [
                        'v40.0',
                        5
                    ],
                    [
                        'v41.0',
                        4.32
                    ],
                    [
                        'v42.0',
                        3.68
                    ],
                    [
                        'v39.0',
                        2.96
                    ],
                    [
                        'v36.0',
                        2.53
                    ],
                    [
                        'v43.0',
                        1.45
                    ],
                    [
                        'v31.0',
                        1.24
                    ],
                    [
                        'v35.0',
                        0.85
                    ],
                    [
                        'v38.0',
                        0.6
                    ],
                    [
                        'v32.0',
                        0.55
                    ],
                    [
                        'v37.0',
                        0.38
                    ],
                    [
                        'v33.0',
                        0.19
                    ],
                    [
                        'v34.0',
                        0.14
                    ],
                    [
                        'v30.0',
                        0.14
                    ]
                ]
            }, {
                name: 'Firefox',
                id: 'Firefox',
                data: [
                    [
                        'v35',
                        2.76
                    ],
                    [
                        'v36',
                        2.32
                    ],
                    [
                        'v37',
                        2.31
                    ],
                    [
                        'v34',
                        1.27
                    ],
                    [
                        'v38',
                        1.02
                    ],
                    [
                        'v31',
                        0.33
                    ],
                    [
                        'v33',
                        0.22
                    ],
                    [
                        'v32',
                        0.15
                    ]
                ]
            } -->