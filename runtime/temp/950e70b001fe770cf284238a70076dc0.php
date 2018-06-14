<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"E:\wamp\www\public/../application/admin\view\admin\b_edit.html";i:1521468944;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1495090428;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1495090428;}*/ ?>
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
    <span class="action-span"><a href="/index.php/admin/Admin/b_lst">单位列表</a></span>
    <span class="action-span1"><a href="#">修改单位/部门</a></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form name="main_form" method="POST" action="" enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
           
            <tr>
                <td class="label">输入单位：</td>
                <td>
                    <input type="text" size="25" name="b_name" id="b_name"  value="<?php echo $data['b_name'];?>" />
                </td>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " onclick="return check(this.form)" />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
        //检查form表单输入框
    function check(form) {
        if($("#b_name").val()==''|| $("#b_name").val()==null) {
            alert('输入的单位不能为空');
            return false;
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
        <div class="footer_right_right">服务热线：0377-66111182</div>
    </div>
</div>
</body>
</html>