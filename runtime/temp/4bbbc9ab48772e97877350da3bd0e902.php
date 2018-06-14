<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"E:\wamp\www\public/../application/admin\view\allcount\cx_count_xiang.html";i:1523862547;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span1">处置信息详情</span>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="jiben_style" onclick="alert_xingwei(1)">信息详情展示</span>
        </p>
    </div>
    <div id="tabbody-div">
            <div id="jiben_xinxi" class="list-div-xin">
                <?php if($info['danwei_geren']==0): ?>
                <table cellspacing='1' cellpadding='3'  >
                    <tr>
                        <td width="20%">单位名称：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size: 15px"><?php echo $info['company_name']; ?></span>
                        </td>
                        <td width="20%">性质：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['nature']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >社会统一信用码（组织机构代码）：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['jigouma']; ?></span>
                        </td>
                        <td >法定人代表姓名：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['boss_name']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >法定人身份证号码：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['boss_cert']; ?></span>
                        </td>
                        <td >注册地：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['zuce_address']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >办公场所：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['office_address']; ?></span>
                        </td>
                        <td ></td>
                        <td>
                        </td>
                    </tr>
                </table>
                <?php else: ?>
                <table cellspacing='1' cellpadding='3'>
                    <tr>
                        <td width="20%">个人姓名：</td>
                        <td width="30%">
                            <span style="color: #049ff1"><?php echo $info['username']; ?></span>
                        </td>
                        <td width="20%" >年龄：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['age']; ?>岁</span>
                        </td>
                    </tr>
                    <tr>
                        <td >性别：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['sex']==0?'男':'女';  ?></span>
                        </td>
                        <td >文化程度：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['education']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >身份证号码：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['cert_number']; ?></span>
                        </td>
                        <td >住所：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['address']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >所在单位：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['company']; ?></span>
                        </td>
                        <td >职务：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['position']; ?></span>
                        </td>
                    </tr>
                </table>
                <?php endif;?>
                <table cellspacing='1' cellpadding='3'>
                    <tr>
                        <td width="20%">行贿数额：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['xinhui_money']; ?></span>元
                        </td>
                        <td width="20%">行贿次数：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['xinhui_cishu']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >行贿时间：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo date("Y-m-d",$info['xinhui_time']); ?></span>
                        </td>
                        <td >信息录入时间：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo date("Y-m-d",$info['input_time']); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >录入单位：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['input_company']; ?></span>
                        </td>
                        <td >录入人员：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['input_name']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >审核人员：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['exam_name']; ?></span>
                        </td>
                        <td ></td>
                        <td>
                        </td>
                    </tr>
                </table>

                <?php if($info['xinhui_fenlei']==0): ?>
                <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td  width="20%">行贿行为与情节：</td>
                        <td  width="80%">
                            <span style="color:#049ff1;font-size:15px"> <?php echo $info['behavior_xingwei']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >附件：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><a style="color:#049ff1;font-size:15px" href="/uploads/<?php echo $info['fujian_add']; ?>"><?php echo $info['fujian_add'];?></a>*</span>
                        </td>
                    </tr>
                </table>
            </br>
                <?php else:?>
                <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td width="20%" >行贿犯罪与事实经过：</td>
                        <td width="80%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['behavior_fanzui']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >附件：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><a style="color:#049ff1;font-size:15px" href="/uploads/<?php echo $info['fujian_add']; ?>"><?php echo $info['fujian_add'];?></a>*</span>
                        </td>
                    </tr>
                    <tr>
                        <td >判决文书编号：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['panjuewenshu_id']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >刑期：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['xingqi']; ?></span>个月
                        </td>
                    </tr>
                </table>
            </br>

                <?php endif;?>
                <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td width="20%" >相应处置标准：</td>
                        <td width="80%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['chuzhi_biaozhun']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >相应处置期限：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['chuzhi_qixian']; ?></span>个月
                        </td>
                    </tr>
                    <tr>
                        <td >处置时间段：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo date("Y-m-d",$qishi_time); ?>~<?php echo $daoqi_time; ?></span>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                </table>
                <!-- 申请处置信息 -->
            </br></hr>
                <table cellspacing='1' cellpadding='3'>
                    <tr>
                         <td width="20%">申请处置结果：</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['chuzhi_jieguo']; ?></span>
                        </td>
                        <td width="20%">申请处置人</td>
                        <td width="30%">
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['cz_name']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td >申请处置时间：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo date("Y-m-d",$info['chuzhi_time']); ?></span>
                        </td>
                        <td >处置审核状态：</td>
                        <td>
                            <span style="color:#049ff1;font-size:15px"><?php echo $info['status_chaxun']==0?'等待审核':($info['status_chaxun']==1?'审核通过':'审核失败');  ?></span>
                        </td>
                    </tr>
                                      
                </table>
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