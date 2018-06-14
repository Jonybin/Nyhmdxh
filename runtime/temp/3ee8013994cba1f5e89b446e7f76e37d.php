<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\wamp\www\public/../application/admin\view\information\exam_edit_del.html";i:1525569723;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span1">审核修改删除列表</span>
</h1>

<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th >单位/个人姓名</th>
            <th >申请人单位/姓名</th>
            <th >申请日期</th>
            <th >联系电话</th>
            <th >申请事由</th>
            <th >审核状态</th>
            <th >修改/删除</th>
            <th width="150">操作</th>
        </tr>
        <?php foreach($info as $k => $v): ?>
        <tr class="tron">
            <td align="center"><?php if($v['danwei_geren']==0): echo $v['company_name'];else: echo $v['username'];endif;?></td>
            <td align="center"><?php echo $v['sq_username'] ?></td>
            <td align="center"><?php echo date('Y-m-d',$v['sq_time']); ?></td>
            <td align="center"><?php echo $v['sq_phone'] ?></td>
            <td align="center"><?php echo $v['sq_shiyou'] ?></td>
            <td align="center"><?php 
                if($is_root ==1){
                echo $v['status_sq']==0?'待审核':($v['status_sq']==1?'审核通过':'审核失败');
            }else{

                echo $v['shenhe_status']==0?'待审核':($v['shenhe_status']==1?'审核通过':'审核失败');} ?></td>
            
            <td align="center"><?php if($v['is_edit_del']==0):echo'修改'; elseif($v['is_edit_del']==1):echo '删除';else:echo '异议'; endif; ?></td>
            <td align="center">
                <?php if($is_root == 1): if($v['status_sq'] ==0): ?>
                    <a href="/index.php/admin/Information/do_lu_ex/sq_id/<?php echo $v['sq_id'].'-'.$is_root; ?>">审核</a>
                    <?php else: ?>
                     <a href="#">无法操作</a>
                    <?php endif; else: if($v['shenhe_status'] ==0): ?>
                    <a href="/index.php/admin/Information/do_lu_ex/sq_id/<?php echo $v['sq_id'].'-'.$is_root; ?>">审核</a>
                    <?php else: ?>
                     <a href="#">无法操作</a>
                    <?php endif; endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td align="right" nowrap="true" colspan="8" height="30"><?php echo $page; ?></td>
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