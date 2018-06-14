<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"E:\wamp\www\public/../application/admin\view\information\lists_l.html";i:1522071892;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1521612284;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<h1>
    <span class="action-span1">行贿信息列表</span>
</h1>
<div class="form-div search_form_div">
    <form method="get" action="" name="search_form">
        <!-- <select id="danwei_geren" name="danwei_geren" onchange="chang_geren_danwei(this.options[this.options.selectedIndex].value)">
            <option value="0" selected>单位基本信息</option>
            <option value="1">个人基本信息</option>
        </select> -->
        <!-- <button autofocus="autofocus" style=""><a href="/index.php/admin/Information/lists/type/danwei">单位行贿信息</a></button>
        <button><a href="/index.php/admin/Information/lists/type/geren">个人行贿信息</a></button> -->
        <input id="company_name" style="margin-left:0%;" placeholder="请输入查询条件" type="text" name="keyword" size="50" value="<?php if(!empty($keyword))echo $keyword;?>" />
        <input type="hidden" name="condition" value="1"/>
        <input type="submit" value=" 检索 " class="button" style="margin-left: 15px"/>
    </form>
</div>
<!-- 列表 -->

<div class="list-div" id="listDiv">
    <?php if($condition == 1): ?>
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th >单位/个人</th>
            <th >单位/个人名称</th>
            <th >统一社会信用代码/身份证</th>
            <th >行贿次数</th>
            <th >行贿数额(元)</th>
            <th >录入人员</th>
            <th >审核人员</th>
            <th >行贿时间</th>
            <th >录入时间</th>
            <th >审核状态</th>
            <th width="150">操作</th>
        </tr>
        <?php foreach($info as $k => $v): ?>
        <tr class="tron">
            <td align="center"><?php if($v['danwei_geren'] =='1'){echo "个人";}else{echo "单位"; } ?></td>
            <td align="center"><?php if($v['danwei_geren'] =='1'){echo $v['username'];}else{echo $v['company_name']; } ?></td>
            <td align="center"><?php echo $v['jigouma'] ?><?php echo $v['cert_number'] ?></td>
            <td align="center"><?php echo $v['xinhui_cishu'] ?></td>
            <td align="center"><?php echo $v['xinhui_money'] ?></td>
            <td align="center"><?php echo $v['input_name'] ?></td>
            <td align="center"><?php echo $v['exam_name'] ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['xinhui_time']) ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['input_time']) ?></td>
            <td align="center"><?php echo $v['status']==0?'待审核':($v['status']==1?'审核通过':'审核失败') ?></td>
            <td align="center">
                <a href="/index.php/admin/Information/lst_l_xiang/information_id/<?php echo $v['information_id']; ?>">查看详情</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td align="right" nowrap="true" colspan="14" height="30"><?php echo $page; ?></td>
        </tr>

    </table>
    <?php endif; ?>
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

<!--
<script>
    function chang_geren_danwei(obj){
        if(obj==0){
            $("#danwei_table").show();
            $("#geren_table").hide();
        }else{
            $("#danwei_table").hide();
            $("#geren_table").show();
        }
    }

    $("tr.tron").mouseover(function(){
        $(this).find("td").css("backgroundColor", "#DDEEF2");
    });
    $("tr.tron").mouseout(function(){
        $(this).find("td").css("backgroundColor", "#FFF");
    });


    //检查检索框
    function check(){
        if($("#danwei_geren").val()==0){
            if($("#company_name").val()=='' && $("#jigouma").val()==''){
                alert('需填写公司名称或社会统一信用码去检索');
                return false;
            }
        }else{
            if($("#username").val()=='' && $("#cert_number").val()==''){
                alert('需填写个人姓名或身份证号码去检索');
                return false;
            }
        }
    }
</script>-->
