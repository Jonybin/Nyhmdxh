<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"D:\WWW\ny_xinhui\public/../application/admin\view\information\sq_chaxun.html";i:1492229963;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\header.html";i:1492479625;s:69:"D:\WWW\ny_xinhui\public/../application/admin\view\\layout\footer.html";i:1492159624;}*/ ?>
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



<script type="text/javascript" charset="utf-8" src="/public/admin/Js/showdate.js"></script>
<h1>

    <span class="action-span1">申请查询</span>
</h1>
<form name="main_form" method="POST" action="" enctype="multipart/form-data">
    <div  class="list-div-xin">
        <table cellspacing="1" cellpadding="3" width="100%">
        <tr>
            <td width="20%">申请查询的个人或单位：</td>
            <td width="80%">
                <input  type="text"  value="<?php if($info['danwei_geren']==0): echo $info['company_name'];else: echo $info['username'];endif;?>" />
                <input type="hidden" name="info_id" value="<?php echo $info['information_id'] ?>"/>
            </td>
            <input type="hidden" name="danwei_geren" value="<?php echo $info['danwei_geren'] ?>" />
            <input type="hidden" name="xinhui_fenlei" value="<?php echo $info['xinhui_fenlei'] ?>" />
        </tr>
        <tr>
            <td>单位/姓名：</td>
            <td>
                <input  type="text" id="username" name="username" value="" />
            </td>
        </tr>
        <tr>
            <td>联系电话：</td>
            <td>
                <input  size="25" id="phone" name="phone" />
            </td>
        </tr>
        <tr>
            <td>查询事由：</td>
            <td>
                <textarea name="chaxun_shiyou"  style="width: 90%" rows="10"  id="chaxun_shiyou" placeholder="请填写查询事由..."></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="99" align="center">
                <input type="submit" class="button" value=" 确定 "  onclick="return check(this.form)"/>
                <input type="reset" class="button" value=" 重置 " />
            </td>
        </tr>
    </table>
    </div>
</form>
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
    function check(form) {
        if ($("#username").val()==''|| $("#username").val()==null){
            alert('单位/姓名不能为空');
            return false;
        }
        if ($("#phone").val()==''|| $("#phone").val()==null){
            alert('联系电话不能为空');
            return false;
        }
        if ($("#chaxun_shiyou").val()==''|| $("#chaxun_shiyou").val()==null){
            alert('申请事由不能为空');
            return false;
        }
    }
</script>