<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"E:\wamp\www\public/../application/admin\view\allcount\lr_count_xiang.html";i:1498708834;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span1">录入统计</span>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="jiben_style" onclick="alert_xingwei(1)">信息详情展示</span>
        </p>
    </div>
    <div id="tabbody-div">
        <div id="jiben_xinxi" class="list-div-xin">
            <?php foreach($info as $k =>$v): if($v['danwei_geren']==0): ?>
            <table cellspacing='1' cellpadding='3'  >
                <tr>
                    <td width="20%">单位名称：</td>
                    <td width="30%">
                        <span style="color:#049ff1;font-size: 15px"><?php echo $v['company_name']; ?></span>
                    </td>
                    <td width="20%">性质：</td>
                    <td width="30%">
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['nature']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >社会统一信用码（组织机构代码）：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['jigouma']; ?></span>
                    </td>
                    <td >法定人代表姓名：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['boss_name']; ?></span>
                    </td>
                </tr>
            </table>
            <?php else: ?>
            <table cellspacing='1' cellpadding='3'>
                <tr>
                    <td width="20%">个人姓名：</td>
                    <td width="30%">
                        <span style="color: #049ff1"><?php echo $v['username']; ?></span>
                    </td>
                    <td width="20%">身份证号码：</td>
                    <td width="30%">
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['cert_number']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >所在单位：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['company']; ?></span>
                    </td>
                    <td >职务：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['position']; ?></span>
                    </td>
                </tr>
            </table>
            <?php endif;if($v['xinhui_fenlei']==0): ?>
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td  width="20%">行贿行为与情节：</td>
                    <td  width="80%">
                        <span style="color:#049ff1;font-size:15px"> <?php echo $v['behavior_xingwei']; ?></span>
                    </td>
                </tr>
            </table>
            <?php else:?>
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td width="20%" >行贿犯罪与事实经过：</td>
                    <td width="80%">
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['behavior_fanzui']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >判决文书编号：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['panjuewenshu_id']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >刑期：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['xingqi']; ?></span>个月
                    </td>
                </tr>
            </table>
            <?php endif;?>
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td width="20%" >附件：</td>
                    <td width="30%">
                        <span style="color:#049ff1;font-size:15px"><a style="color:#049ff1;font-size:15px" href="/uploads/<?php echo $v['fujian_add']; ?>"><?php echo $v['fujian_add'];?></a>*</span>
                    </td>
                    <td width="20%" >是否审核：</td>
                    <td width="30%">
                        <span style="color:#049ff1;font-size:15px"><?php echo $v['status']==0?'待审核':($v['status']==1?'审核通过':'审核失败');  ?></span>
                    </td>
                </tr>
            </table>
            <div style="width: 100%;height: 20px;background: #fff"></div>
            <?php endforeach; ?>
            <?php echo $page; ?>
        </div>

    </div>
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