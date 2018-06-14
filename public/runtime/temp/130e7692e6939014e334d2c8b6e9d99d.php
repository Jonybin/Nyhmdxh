<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\WWW\ny_xinhui\public/../application/admin\view\information\lists.html";i:1492479685;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\header.html";i:1492479625;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\footer.html";i:1492159624;}*/ ?>
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
    <form method="post" action="" name="search_form">
        <table cellpadding="3" cellspacing="1">
            <tr >
                <td class="label" style="text-align: left;width: 5%">
                    单位/个人：
                    <select name="danwei_geren" onchange="chang_geren_danwei(this.options[this.options.selectedIndex].value)">
                        <option value="0" selected>单位基本信息</option>
                        <option value="1">个人基本信息</option>
                    </select>
                </td>
            </tr>
            <tr id="danwei_table" >
                <td class="label" style="text-align: left;">
                    公司 名称：
                    <input  type="text" name="company_name" size="20" value="" />
                </td>
                <td class="label" style="text-align: left;">
                    社会统一信用代码(组织机构代码)：
                    <input  type="text" name="jigouma" size="20" value="" />
                </td>
            </tr>
            <tr style="display: none" id="geren_table">
                <td class="label" style="text-align: left;">
                    个人 姓名：
                    <input  type="text" name="username" size="20" value="" />
                </td>
                <td class="label" style="text-align: left;">
                    身份证号码：
                    <input  type="text" name="cert_number" size="20" value="" />
                </td>
            </tr>
            <tr>
                <td style="text-align: left;width: 5%">
                    <input type="submit" value=" 检索 " class="button" style="margin-left: 15px"/>
                </td>
            </tr>
            </table>
    </form>
</div>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <?php if($danwei_geren==0):?>
        <tr>
            <th >单位名称</th>
            <th >统一社会信用代码</th>
            <th >行贿次数</th>
            <th >行贿数额</th>
            <th >录入人员</th>
            <th >审核人员</th>
            <th >行贿时间</th>
            <th >录入时间</th>
            <th >审核状态</th>
            <th width="150">操作</th>
        </tr>
        <?php foreach($info as $k => $v): ?>
        <tr class="tron">
            <td align="center"><?php echo $v['company_name'] ?></td>
            <td align="center"><?php echo $v['jigouma'] ?></td>
            <td align="center"><?php echo $v['xinhui_cishu'] ?></td>
            <td align="center"><?php echo $v['xinhui_money'] ?></td>
            <td align="center"><?php echo $v['input_name'] ?></td>
            <td align="center"><?php echo $v['exam_name'] ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['xinhui_time']) ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['input_time']) ?></td>
            <td align="center"><?php echo $v['status']==0?'待审核':($v['status']==1?'审核通过':'审核失败') ?></td>
            <td align="center">
                <a href="/index.php/admin/Information/sq_chaxun/information_id/<?php echo $v['information_id']; ?>">申请查询</a>　
            </td>
        </tr>
        <?php endforeach; endif; if($danwei_geren==1):?>
        <tr>
            <th >个人姓名</th>
            <th >身份证号码</th>
            <th >行贿次数</th>
            <th >行贿数额</th>
            <th >录入人员</th>
            <th >审核人员</th>
            <th >行贿时间</th>
            <th >录入时间</th>
            <th >审核状态</th>
            <th width="150">操作</th>
        </tr>
        <?php foreach($info as $k => $v): ?>
        <tr class="tron">
            <td align="center"><?php echo $v['username'] ?></td>
            <td align="center"><?php echo $v['cert_number'] ?></td>
            <td align="center"><?php echo $v['xinhui_cishu'] ?></td>
            <td align="center"><?php echo $v['xinhui_money'] ?></td>
            <td align="center"><?php echo $v['input_name'] ?></td>
            <td align="center"><?php echo $v['exam_name'] ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['xinhui_time']) ?></td>
            <td align="center"><?php echo date("Y-m-d",$v['input_time']) ?></td>
            <td align="center"><?php echo $v['status']==0?'待审核':($v['status']==1?'审核通过':'审核失败') ?></td>
            <td align="center">
                <a href="/index.php/admin/Information/sq_chaxun/information_id/<?php echo $v['information_id']; ?>">申请查询</a>　
            </td>
        </tr>
        <?php endforeach; endif; ?>
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
</script>