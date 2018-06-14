<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"E:\wamp\www\public/../application/admin\view\privilege\edit.html";i:1495090430;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
    <span class="action-span"><a href="/index.php/admin/Privilege/lst">权限列表</a></span>
    <span class="action-span1"><a href="#">修改权限</a></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form name="main_form" method="POST" action="" enctype="multipart/form-data" >
    	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">
			<tr>
				<td class="label">上级权限：</td>
				<td>
					<select name="parent_id">
						<option value="0">顶级权限</option>
                        <?php foreach ($parentData as $k => $v): if($v['id'] == $data['id'] || in_array($v['id'], $children)) continue ; ?>
                        <option <?php if($v['id'] == $data['parent_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['level']).$v['pri_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
				</td>
			</tr>
            <tr>
                <td class="label">权限名称：</td>
                <td>
                    <input  type="text" id="pri_name" name="pri_name" value="<?php echo $data['pri_name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">模块名称：</td>
                <td>
                    <input  type="text" id="module_name" name="module_name" value="<?php echo $data['module_name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">控制器名称：</td>
                <td>
                    <input  type="text" id="controller_name" name="controller_name" value="<?php echo $data['controller_name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">方法名称：</td>
                <td>
                    <input  type="text" id="action_name" name="action_name" value="<?php echo $data['action_name']; ?>" />
                </td>
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
    //检查form表单输入框
    function check(form) {
        if($("#pri_name").val()==''|| $("#pri_name").val()==null) {
            alert('权限名称不能为空');
            return false;
        }
        if($("#module_name").val()==''|| $("#module_name").val()==null) {
            alert('模板名称不能为空');
            return false;
        }
        if($("#controller_name").val()==''|| $("#controller_name").val()==null) {
            alert('控制器名称不能为空');
            return false;
        }
        if($("#action_name").val()==''|| $("#action_name").val()==null) {
            alert('控制器名称不能为空');
            return false;
        }
    }
</script>