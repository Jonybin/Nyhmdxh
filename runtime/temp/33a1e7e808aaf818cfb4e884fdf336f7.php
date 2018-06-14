<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"E:\wamp\www\public/../application/admin\view\notice\edit_gg.html";i:1495090428;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1521612284;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1495090428;}*/ ?>
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



<script type="text/javascript" charset="utf-8" src="/admin/Js/showdate.js"></script>
<h1>
    <span class="action-span"><a href="/index.php/admin/notice/lst_gg">通知公告列表</a></span>
    <span class="action-span1"><a href="#">修改通知公告</a></span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form name="main_form" method="POST" action="" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <input type="hidden" name="gg_id" value="<?php echo $info['gg_id']; ?>" />
            <tr>
                <td class="label">公告标题：</td>
                <td>
                    <input style="width: 300px" type="text" id="gg_title" name="gg_title" value="<?php echo $info['gg_title'] ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">公告内容：</td>
                <td>
                    <textarea  name="gg_content" style="width: 90%" rows="10"  id="gg_content" placeholder="请填写行贿行为的事实经过..."><?php echo $info['gg_content'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">添加时间：</td>
                <td>
                    <input  type="text" id="gg_time" name="gg_time" value="<?php echo date('Y-m-d',$info['gg_time']); ?>" onclick="return Calendar('gg_time');"/>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示：</td>
                <td>
                    <input type="radio" name="gg_status" value="0" <?php if($info['gg_status']==0): echo 'checked="checked"'; endif;?> />显示
                    <input type="radio" name="gg_status" value="1"  <?php if($info['gg_status']==1): echo 'checked="checked"'; endif;?> />隐藏
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " onclick="return check(this.form)" />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    function check(){
        if($("#gg_title").val()==''|| $("#gg_title").val()==null) {
            alert('公告标题不能为空');
            return false;
        }
        if($("#gg_content").val()==''|| $("#gg_content").val()==null) {
            alert('公告内容不能为空');
            return false;
        }
        if($("#gg_time").val()==''|| $("#gg_time").val()==null) {
            alert('添加时间不能为空');
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