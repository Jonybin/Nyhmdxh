<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"E:\wamp\www\public/../application/admin\view\admin\b_lst.html";i:1521786689;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
	<span class="action-span"><a href="/index.php/admin/admin/b_add">添加单位</a></span>
	<span class="action-span1"><a href="#">单位列表</a></span>
	<div style="clear:both"></div>
</h1>
<!-- 搜索 -->
<!-- <div class="form-div search_form_div">
    <form method="GET" name="search_form">
		<p>
			角色名称：
	   		<input type="text" name="role_name" size="30" value="" />
		</p>
		<p><input type="submit" value=" 搜索 " class="button" /></p>
    </form>
</div> -->
<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th width="300">单位名称</th>
            <th >添加者</th>
			<th width="300">操作</th>
        </tr>
        <?php foreach($info as $v): ?>
        <tr>
            <th width="100"><?php echo $v['b_name'];?></th>
            <th ><?php echo $v['input_name'];?></th>
			<th>
					<a href="/index.php/admin/admin/b_edit/id/<?php echo $v['id']; ?>" title="编辑">修改</a>
					<?php if($adminId==1): ?>
	                <a href="/index.php/admin/Admin/b_del/id/<?php echo $v['id']; ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
					<?php endif; ?>
		        </th>
        </tr>
    <?php endforeach; ?>
		<tr><td align="right" nowrap="true" colspan="3" height="30"><?php echo $page; ?></td></tr>
	</table>
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
	$("tr.tron").mouseover(function(){
		$(this).find("td").css("backgroundColor", "#DDEEF2");
	});
	$("tr.tron").mouseout(function(){
		$(this).find("td").css("backgroundColor", "#FFF");
	});
</script>