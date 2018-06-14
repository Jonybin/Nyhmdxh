<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"E:\wamp\www\public/../application/admin\view\admin\lst.html";i:1521882073;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
	<span class="action-span1"><a href="#">管理员密码修改</a></span>
<div class="form-div search_form_div">
    <form method="get" action="" name="search_form">
        <input id="company_name" style="margin-left:60%;" placeholder="请输入查询条件" type="text" name="keyword" size="20" value="<?php if(!empty($keyword))echo $keyword;?>" onclick="a('我是宋相南')" />
        <input type="submit" value=" 检索 " class="button" style="margin-left: 15px"/>
        <?php if($adminId==1): ?><span class="action-span"><a href="/index.php/admin/Admin/add">添加管理员</a></span><?php endif; ?>
    </form>
</div>
	<div style="clear:both"></div>
</h1>


<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
            <th >单位名称</th>
			<th width="300">操作</th>
        </tr>
		<?php foreach ($data as $k => $v):  ?>
		<tr class="tron">
				<td align="center"><?php echo $v['username']; ?></td>
		        <td align="center">
					<a href="/index.php/admin/Admin/edit/id/<?php echo $v['id']; ?>" title="编辑">修改</a>
					<?php if($adminId==1): if($v['id'] > 1): ?>|
	                <a href="/index.php/admin/Admin/delete/id/<?php echo $v['id']; ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
					<?php endif; endif; ?>
		        </td>
		</tr>
		<?php endforeach; ?>
		<tr>
            <td align="center" nowrap="true" colspan="12" height="30"><?php echo $page; ?></td>
        </tr>
        <tr><td align="right" nowrap="true" colspan="3" height="30"></td></tr>

	</table>
</div>
<script>
	$("tr.tron").mouseover(function(){
		$(this).find("td").css("backgroundColor", "#DDEEF2");
	});
	$("tr.tron").mouseout(function(){
		$(this).find("td").css("backgroundColor", "#FFF");
	});

	// 为启用的td加一个事件
	$(".is_use").click(function(){
		// 先获取点击的记录的ID
		var id = $(this).attr("admin_id");
		if(id == 1)
		{
			alert("超级管理员不能修改是否启用！");
			return false;
		}
		var _this = $(this);

		$.ajax({
			url: "/index.php/admin/admin/get_isuse",
			type: "post",
			dataType: "json",
			data: "admin_id="+id,
			async: false,
			success: function (obj) {
				if(obj.code == 0){
					_this.html("禁用");
				}else{
					_this.html("启用");
				}
			}
		});
	});
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














