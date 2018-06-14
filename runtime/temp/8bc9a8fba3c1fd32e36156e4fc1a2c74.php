<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"E:\wamp\www\public/../application/admin\view\admin\add.html";i:1498699878;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1524818772;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span"><a href="/index.php/admin/Admin/lst">管理员列表</a></span>
    <span class="action-span1"><a href="#">添加管理员</a></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form name="main_form" method="POST" action="" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
        	<tr>
                <td class="label">拥有权限：</td>
                <td>
                    <?php foreach ($roleData as $k => $v): ?>
                    <input type="checkbox" name="role_id[]" value="<?php echo $v['id']; ?>" /> <?php echo $v['role_name']; endforeach; ?>
                </td>
            </tr>
            <tr>
                <td class="label">所在单位：</td>
                <td>
                    <input  type="text" id="Company" name="Company" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">担任角色：</td>
                <td>
                    <input type="radio" name="admin_role" value="0"  />超管
                    <input type="radio" name="admin_role" value="1"  />审核
                    <input type="radio" name="admin_role" value="2"  />录入
                    <input type="radio" name="admin_role" value="3"  />查询
                    <input type="radio" name="admin_role" value="4"  />监管
                </td>
            </tr>
            <tr>
                <td class="label">账号：</td>
                <td>
                    <input  type="text" id="username" name="username" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">密码：</td>
                <td>
                    <input type="password" size="25" id="password" name="password" />
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type="password" size="25" id="cpassword" name="cpassword" />
                </td>
            </tr>
            <tr>
                <td class="label">是否启用：</td>
                <td>
                	<input type="radio" name="is_use" value="1" checked="checked" />启用
                	<input type="radio" name="is_use" value="0"  />禁用
                </td>
            </tr>
            <tr>
                <td class="label">Ukey密钥：</td>
                <td><input size="25" onblur="check_long()" id="ukey" name="ukey" style="width: 300px" />密钥为不超过32个的0-F的字符 例如：1234567890ABCDEF1234567890ABCDEF</td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 "  onclick="return check(this.form)"/>
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
        //检查form表单输入框
    function check(form) {
        if($("#Company").val()==''|| $("#Company").val()==null) {
            alert('所在单位不能为空');
            return false;
        }
        if($("#username").val()==''|| $("#username").val()==null) {
            alert('账号不能为空');
            return false;
        }
        if($("#password").val()==''|| $("#password").val()==null) {
            alert('密码不能为空');
            return false;
        }
        if($("#cpassword").val()==''|| $("#cpassword").val()==null) {
            alert('确认密码不能为空');
            return false;
        }
        if($("#password").val()!=$("#cpassword").val()) {
            alert('两次密码输入不一致');
            return false;
        }
        if($("#ukey").val()==''|| $("#ukey").val()==null) {
            alert('两次密码输入不一致');
            return false;
        }
    }

    function check_long(){
        if($("#ukey").val().length>32){
            alert('Ukey密钥长度不能超过32位');
        }
    }
</script>
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