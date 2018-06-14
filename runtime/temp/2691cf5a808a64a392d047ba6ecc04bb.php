<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"E:\wamp\www\public/../application/admin\view\notice\lst_gg.html";i:1521011542;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<h1>
    <span class="action-span"><a href="/index.php/admin/Notice/add_gg">添加通知公告</a></span>
    <span class="action-span1"><a href="#">通知公告列表</a></span>
    <div style="clear:both"></div>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th >公告标题</th>
            <th >公告内容</th>
            <th >添加时间</th>
            <th >状态</th>
            <th width="80">操作</th>
        </tr>
        <?php foreach($info as $k =>$v): ?>
        <tr class="tron">
            <td align="center"><?php echo $v['gg_title'] ?></td>
            <td align="center"><?php echo $v['gg_content'] ?></td>
            <td align="center"><?php echo date('Y-m-d',$v['gg_time']); ?></td>
            <td align="center"><?php if($v['gg_status']==0):echo '显示';else:echo '隐藏';endif;?></td>
            <td align="center">
                <a href="/index.php/admin/notice/edit_gg/gg_id/<?php echo $v['gg_id']; ?>" title="编辑">编辑</a> |
                <a href="/index.php/admin/notice/del_gg/gg_id/<?php echo $v['gg_id']; ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
            </td>
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