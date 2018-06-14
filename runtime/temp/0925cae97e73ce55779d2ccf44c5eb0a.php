<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"E:\wamp\www\public/../application/admin\view\information\do_lu_ex.html";i:1525569829;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<script type="text/javascript" charset="utf-8" src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.all.min.js"> </script>
<h1>
    <span class="action-span1">审核修改/删除/异议</span>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="jiben_style" onclick="alert_xingwei(1)">申请信息</span>
            <span class="tab-back" id="xingwei_style" onclick="alert_xingwei(2)">审核操作</span>
        </p>
    </div>
    <div id="tabbody-div">

        <div id="jiben_xinxi" style="display: block">
            <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td class="label">申请人单位/姓名：</td>
                    <td>
                        <?php echo $info['sq_username'] ?>
                        <span class="required">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">申请事由：</td>
                    <td>
                        <?php echo $info['sq_shiyou'] ?>
                        <span class="required">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">申请时间：</td>
                    <td>
                        <?php echo date('Y-m-d',$info['sq_time']); ?>
                        <span class="required">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">修改/删除/异议：</td>
                    <td>
                        <?php if($info['is_edit_del']==0):echo'修改'; elseif($info['is_edit_del']==1):echo '删除';else:echo '异议'; endif; ?>
                        <span class="required">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">附件：</td>
                    <td>
                        <a href="/sq_uploads/<?php echo $info['sq_fujian']; ?>"><?php echo $info['sq_fujian']; ?></a>
                        <span class="required"><a href="/uploads/"></a>*</span>
                    </td>
                </tr>
            </table>
        </div>

        <!--审核操作-->

        <div id="xingwei_xinxi" style="display: none">
            <form name="main_form" method="POST" action="" enctype="multipart/form-data" >
                <table class="table_content" cellspacing="1" cellpadding="3" width="100%">
                    <input type="hidden" name="sq_id" value="<?php echo $info['sq_id']; ?>"/>
                    <tr>
                        <td class="label">审核操作：</td>
                        <td>
                            <?php if($is_root ==1): ?>
                            <input type="radio" name="status_sq" value="0" <?php if($info['status_sq'] == 0) echo 'checked = "checked"';?> />待审核
                            <input type="radio" name="status_sq" value="1" <?php if($info['status_sq'] == 1) echo 'checked = "checked"';?> />审核通过
                            <input type="radio" name="status_sq" value="2" <?php if($info['status_sq'] == 2) echo 'checked = "checked"';?> />审核失败
                            <?php else: ?>
                            <input type="radio" name="shenhe_status" value="0" <?php if($info['shenhe_status'] == 0) echo 'checked = "checked"';?> />待审核
                            <input type="radio" name="shenhe_status" value="1" <?php if($info['shenhe_status'] == 1) echo 'checked = "checked"';?> />审核通过
                            <input type="radio" name="shenhe_status" value="2" <?php if($info['shenhe_status'] == 2) echo 'checked = "checked"';?> />审核失败
                            <?php endif; ?>
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