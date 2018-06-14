<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"E:\wamp\www\public/../application/admin\view\admin\edit.html";i:1495381302;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span"><a href="/index.php/admin/Admin/lst">管理员列表</a></span>
    <span class="action-span1"><a href="#">修改管理员</a></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form name="main_form" method="POST" action="" enctype="multipart/form-data" >
    	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">
            <?php if($data['id'] > 1): if($adminId ==1): ?>
            <tr>
                <td class="label">所在角色：</td>
                <td>
                    <?php foreach ($roleData as $k => $v):
                    if(strpos(','.$rid.',', ','.$v['id'].',') !== FALSE)
                    $check = 'checked="checked"';
                    else
                    $check = '';
                    ?>
                    <input <?php echo $check; ?> type="checkbox" name="role_id[]" value="<?php echo $v['id']; ?>" /> <?php echo $v['role_name']; endforeach; ?>
                </td>
            </tr>
            <?php endif; endif; ?>
            <tr>
                <td class="label">账号：</td>
                <td>
                    <?php echo $data['username']; ?>
                    <input type="hidden" value="<?php echo $data['username']; ?>" name="edit_name" />
                </td>
            </tr>
            <tr>
                <td class="label">密码：</td>
                <td>
                    <input type="password" size="25" name="password" />
                    留空代表不修改密码
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type="password" size="25" name="cpassword" />
                </td>
            </tr>
            <?php if($data['id'] == 0): ?>
            <tr>
                <td class="label">是否启用</td>
                <td>
                	<input type="radio" name="is_use" value="1" <?php if($data['is_use'] == '1') echo 'checked="checked"'; ?> />启用
                	<input type="radio" name="is_use" value="0" <?php if($data['is_use'] == '0') echo 'checked="checked"'; ?> />禁用
                </td>
            </tr>
             <?php else :?>

                <input type="hidden" name="is_use" value="1" />


            <?php endif; ?>

            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " onclick="return check(this.form)" />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
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