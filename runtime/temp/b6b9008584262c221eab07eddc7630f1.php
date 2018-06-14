<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"E:\wamp\www\public/../application/admin\view\information\examine.html";i:1525510541;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1524818772;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<script type="text/javascript" charset="utf-8" src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.all.min.js"> </script>
<h1>
    <span class="action-span1">行贿信息审核</span>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="jiben_style" onclick="alert_xingwei(1)">行贿信息</span>
            <span class="tab-back" id="xingwei_style" onclick="alert_xingwei(2)">审核操作</span>
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
            <?php endif;?>
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td width="20%" >处置标准：</td>
                    <td width="80%">
                        <span style="color:#049ff1;font-size:15px"><?php echo $info['chuzhi_biaozhun']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td >处置期限：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php echo $info['chuzhi_qixian']; ?></span>个月
                    </td>
                </tr>
                <tr>
                    <td >处置时间段：</td>
                    <td>
                        <span style="color:#049ff1;font-size:15px"><?php if($info['status']==1): ?>
                                <?php echo date("Y-m-d",$qishi_time); ?>~<?php echo $daoqi_time; elseif($info['status']==0): ?>
                                无
                                <?php endif; ?>
                        </span>
                    </td>
                </tr>

            </table>

        </div>

        <!--审核操作-->

        <div id="xingwei_xinxi" style="display: none">
            <form name="main_form" method="POST" action="" enctype="multipart/form-data" >
                <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                    <input type="hidden" name="infoid" value="<?php echo $info['information_id'];  ?>"/>
                    <tr>
                        <td class="label">审核操作：</td>
                        <td>
                            <input type="radio" name="status" value="0" <?php if($info['status'] == 0) echo 'checked = "checked"';?> />待审核
                            <input type="radio" name="status" value="1" <?php if($info['status'] == 1) echo 'checked = "checked"';?> />审核通过
                            <input type="radio" name="status" value="2" <?php if($info['status'] == 2) echo 'checked = "checked"';?> />审核失败
                        </td>
                    </tr>

                </table>
                <table cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td align="center">
                            <input type="submit" style="cursor: pointer;" class="button" value="审核" onclick="return check(this.form)" />
                            <input type="reset" style="cursor: pointer;" class="button" value=" 重置 " />
                        </td>
                    </tr>
                </table>
            </form>
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

<script>


    function alert_xingwei(nav){
        if(nav==1) {
            $("#jiben_xinxi").show();
            $("#xingwei_xinxi").hide();
            $("#jiben_style").attr('class', 'tab-front');
            $("#xingwei_style").attr('class', 'tab-back');
        }else{
            $("#jiben_xinxi").hide();
            $("#xingwei_xinxi").show();
            $("#jiben_style").attr('class', 'tab-back');
            $("#xingwei_style").attr('class', 'tab-front');
        }
    }

</script>