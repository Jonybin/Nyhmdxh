<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"E:\wamp\www\public/../application/admin\view\privilege\lst.html";i:1495090430;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
	<span class="action-span"><a href="/index.php/admin/Privilege/add">添加权限</a></span>
	<span class="action-span1"><a href="#">权限列表</a></span>
	<div style="clear:both"></div>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th >权限名称</th>
            <th >模块名称</th>
            <th >控制器名称</th>
            <th >方法名称</th>
            <th >上级权限的ID，0：代表顶级权限</th>
			<th width="100">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>
		<tr class="tron">
				<td><?php echo str_repeat('-', 8*$v['level']); ?><?php echo $v['pri_name']; ?></td>
				<td><?php echo $v['module_name']; ?></td>
				<td><?php echo $v['controller_name']; ?></td>
				<td><?php echo $v['action_name']; ?></td>
				<td><?php echo $v['parent_id']; ?></td>
		        <td align="center">
		        	<a href="/index.php/admin/Privilege/edit/id/<?php echo $v['id']; ?>" title="编辑">编辑</a> |
	                <a href="/index.php/admin/Privilege/delete/id/<?php echo $v['id']; ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
		        </td>
	        </tr>
		<?php endforeach; ?>
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