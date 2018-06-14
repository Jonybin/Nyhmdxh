<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"E:\wamp\www\public/../application/admin\view\information\czsq_lst.html";i:1495090426;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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

    <span class="action-span1">申请处置列表</span>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th >单位/个人</th>
            <th >单位名称/个人姓名</th>
            <th >处置人员</th>
            <th >处置结果</th>
            <th >处置时间</th>
            <th >审核状态</th>
            <th width="150">操作</th>
        </tr>
        <?php foreach($info as $k => $v): ?>
        <tr class="tron">
            <td align="center"><?php if($v['danwei_geren']==0): echo '单位';else: echo '个人';endif;?></td>
            <td align="center"><?php if($v['danwei_geren']==0): echo $v['company_name'];else: echo $v['username'];endif;?></td>
            <td align="center"><?php echo $v['cz_name'] ?></td>
            <td align="center"><?php echo $v['chuzhi_jieguo'] ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['chuzhi_time']) ?></td>
            <td align="center">
                <?php if($v['status_chaxun']==0): ?>
                等待审核
                <?php elseif($v['status_chaxun']==1):?>
                审核通过
                <?php else: ?>　
                审核失败
                <?php endif;?>
            </td>
            <td align="center">
                <?php if($v['status_chaxun']==1): ?>
                <a href="/index.php/admin/Information/daochu_chuzi/id/<?php echo $v['id']; ?>">查看详情</a>
                <?php else: ?>　
                <a href="/index.php/admin/Information/edit_chuzi/id/<?php echo $v['id']; ?>">修改</a>  |  <a href="/index.php/admin/Information/del_chuzi/id/<?php echo $v['id']; ?>" onclick="return confirm('确定要删除吗？');">删除</a>
                <?php endif;?>
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
