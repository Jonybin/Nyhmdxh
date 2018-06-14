<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\wamp\www\public/../application/admin\view\allcount\lr_xji_num_count.html";i:1525847892;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span1">录入统计</span>
       <!-- <span class="action-span"><a href="/index.php/admin/allcount/export_xji_num">导出Excel表</a></span> -->
    </form>
</div>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">

        <tr>
            <th >录入管理员单位</th>
            <th >录入总量</th>
            <th >单位数量</th>
            <th >个人数量</th>
            <th >行贿行为数量</th>
            <th >行贿犯罪数量</th>
<!--             <th >操作</th> -->
        </tr>
        <?php if(is_array($info) || $info instanceof \think\Collection): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center">
                    <?php echo $v['Company']; ?>
                </td>

                <td align="center">
                        <?php echo $v['all_num']; ?>
                </td>
                <td align="center">
                         <?php echo $v['danwei_num']; ?>

                </td>
                <td align="center">
                        <?php echo $v['geren_num'];; ?>
                    </a>
                </td>
                <td align="center">
                        <?php echo $v['xingwei_num']; ?>
                    </a>
                </td>
                <td align="center">
                        <?php echo $v['fanzui_num']; ?>
                </td>
                    <!-- <td align="center"><a href="/index.php/admin/allcount/lr_xji_num_count/dq/<?php echo $v['Company']; ?>">查看详情</a></td> -->
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td align="center">总计</td>
            <td align="center"><?php echo $sum_lr; ?></td>
            <td align="center"><?php echo $sum_danwei; ?></td>
            <td align="center"><?php echo $sum_geren; ?></td>
            <td align="center"><?php echo $sum_xw; ?></td>
            <td align="center"><?php echo $sum_fz; ?></td>
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