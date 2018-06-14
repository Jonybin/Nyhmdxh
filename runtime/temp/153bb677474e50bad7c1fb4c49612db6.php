<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"E:\wamp\www\public/../application/admin\view\allcount\cx_num_chuzhi.html";i:1522229025;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/admin/Js/tron.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/Js/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/index/css/index.css" media="screen, projection"/>
</head>
<body onload="load()">



<script type="text/javascript" charset="utf-8" src="/admin/Js/showdate.js"></script>
<h1>
    <!-- <span class="action-span"><a href="/index.php/admin/allcount/export_cx">导出Excel表</a></span> -->
    <span class="action-span1">查询处置统计</span>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">

        <tr>
            <th >查询单位</th>
            <th >查询关键词</th>
            <th >结果数量</th>
            <th >申请处置人</th>
            <th >申请处置内容</th>
            <th >查询时间</th>
            <th >处置时间</th>
            <th >操作</th>
        </tr>
        <?php foreach($info as $k =>$v): ?>
        <tr class="tron">
            <td align="center"><?php echo $v['username']; ?></td>
            <td align="center"><?php echo $v['keyword']; ?></td>
            <td align="center"><?php echo $v['finds']; ?></td>
            <td align="center"><?php echo $v['sq_name']; ?></td>
            <td align="center"><?php echo $v['cz_res']; ?></td>
            <td align="center"><?php echo date('Y-m-j H:i:s',$v['find_time']); ?></td>
            <td align="center"><?php echo date('Y-m-j H:i:s',$v['cz_time']); ?></td>
            <td align="center"><a href="/index.php/admin/allcount/cx_count_xiang/id/<?php echo $v['inf_id']; ?>">查看详情</a></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td align="right" nowrap="true" colspan="14" height="30"><?php echo $page; ?></td>
        </tr>

    </table>
</div>
<div style="height: 75px;width: 100%"></div>
<div class="footer" style="">
    <div class="footer_left">
        <div class="footer_left_left"></div>
        <div class="footer_left_right">2017 宛都实业</div>
    </div>
    <div class="footer_right">
        <div class="footer_right_right">服务热线：0377-66111811</div>
    </div>
</div>
</body>
</html>

<script>
    $("tr.tron").mouseover(function(){
        $(this).find("td").css("backgroundColor", "#DDEEF2");
    });
    $("tr.tron").mouseout(function(){
        $(this).find("td").css("backgroundColor", "#FFF");
    });
</script>