<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\WWW\ny_xinhui\public/../application/admin\view\allcount\cx_count.html";i:1492479892;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\header.html";i:1492479625;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\footer.html";i:1492159624;}*/ ?>
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
<body>



<script type="text/javascript" charset="utf-8" src="/admin/Js/showdate.js"></script>
<h1>

    <span class="action-span1">查询统计</span>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">

        <tr>
            <th >查询管理员单位</th>
            <th >查询管理员姓名</th>
            <th >查询数量</th>
            <th >单位数量</th>
            <th >个人数量</th>
            <th >行贿行为数量</th>
            <th >行贿犯罪数量</th>
            <th >时间段</th>
            <th >详细信息</th>
        </tr>
        <?php foreach($info as $k =>$v): ?>
        <tr class="tron">
            <td align="center"><?php echo $v['Company']; ?></td>
            <td align="center"><?php echo $v['cx_username']; ?></td>
            <td align="center"><?php echo $v['all_num']; ?></td>
            <td align="center"><?php echo $v['danwei_num']; ?></td>
            <td align="center"><?php echo $v['geren_num']; ?></td>
            <td align="center"><?php echo $v['xingwei_num']; ?></td>
            <td align="center"><?php echo $v['fanzui_num']; ?></td>
            <td align="center"><?php echo $mouth; ?>月~<?php echo $mouth+1 ?>月</td>
            <td align="center"><a href="/index.php/admin/allcount/cx_count_xiang/id/<?php echo $v['id']; ?>">查看详情</a></td>
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
        <div class="footer_right_right">服务热线：0377-66111182</div>
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