<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\wamp\www\public/../application/admin\view\information\add.html";i:1525511746;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<script type="text/javascript" charset="utf-8" src="/admin/Js/showdate.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.all.min.js"> </script>
<h1>

	<span class="action-span1">行贿信息录入</span>
</h1>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="jiben_style" onclick="alert_xingwei(1)">基本信息</span>
            <span class="tab-back" id="xingwei_style" onclick="alert_xingwei(2)">行为信息</span>
        </p>
    </div>
    <div id="tabbody-div">
	    <form name="main_form" method="POST" action="" enctype="multipart/form-data" onkeydown="if(event.keyCode==13){return false;}">
	        <!-- 基本信息 -->
			<div id="jiben_xinxi" style="display: block" class="list-div-xin">
				<div style="padding-left: 15px;color: red">备注：输入框后面带*号为必填项,不带为选填项</div>
				<table  cellspacing="1" cellpadding="3" >
					<tr >
						<td width="20%">单位/个人：</td>
						<td width="30%" >
							<select id="danwei_geren" name="danwei_geren" onchange="chang_geren_danwei(this.options[this.options.selectedIndex].value)">
								<option value="0" selected>单位基本信息</option>
								<option value="1">个人基本信息</option>
							</select>
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
						<td width="20%">行为/犯罪：</td>
						<td width="30%">
							<select id="xinhui_fenlei" name="xinhui_fenlei" onchange="chang_xingwei_fanzui(this.options[this.options.selectedIndex].value)">
								<option value="0" selected>行贿行为</option>
								<option value="1">行贿犯罪</option>
							</select>
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
					</tr>
				</table>
				<table  cellspacing="1" cellpadding="3" width="100%" id="danwei_table">
					<tr >
						<td width="20%">单位名称：</td>
						<td width="30%">
							<input size="30" type="text" name="company_name" value="" id="company_name" />
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
						<td width="20%">性质：</td>
						<td width="30%">
							<select id="nature" name="nature">
								<option value="">请选择公司性质</option>
								<option value="农、林、牧、渔业">农、林、牧、渔业</option>
								<option value="采矿业">采矿业</option>
								<option value="制造业">制造业</option>
								<option value="电力、热力、燃气及水生产和供应业">电力、热力、燃气及水生产和供应业</option>
								<option value="建筑业">建筑业</option>
								<option value="批发和零售业">批发和零售业</option>
								<option value="交通运输、仓储和邮政业">交通运输、仓储和邮政业</option>
								<option value="住宿和餐饮业">住宿和餐饮业</option>
								<option value="信息传输、软件和信息技术服务业">信息传输、软件和信息技术服务业</option>
								<option value="金融业">金融业</option>
								<option value="房地产业">房地产业</option>
								<option value="租赁和商务服务业">租赁和商务服务业</option>
								<option value="科学研究和技术服务业">科学研究和技术服务业</option>
								<option value="水利、环境和公共设施管理业">水利、环境和公共设施管理业</option>
								<option value="居民服务、修理和其他服务业">居民服务、修理和其他服务业</option>
								<option value="教育">教育</option>
								<option value="卫生和社会工作">卫生和社会工作</option>
								<option value="文化、体育和娱乐业">文化、体育和娱乐业</option>
								<option value="公共管理、社会保障和社会组织">公共管理、社会保障和社会组织</option>
								<option value="国际组织">国际组织</option>
							</select>
							<span style="color: red; font-size:22px">*</span>
						</td>
					</tr>
					<tr>
						<td >社会统一信用代码（组织机构代码）：</td>
						<td>
							<input size="20" type="text" name="jigouma" value="" id="jigouma" />
							<span style="color: red; font-size:22px">*</span>
						</td>
						<td >法定代表人姓名：</td>
						<td>
							<input size="20" type="text" name="boss_name" value="" id="boss_name" />
							<span style="color: red; font-size:22px">*</span>
						</td>
					</tr>
					<tr>
						<td >法定代表人身份证号码：</td>
						<td>
							<input size="30" type="text" name="boss_cert" value="" id="boss_cert" onchange="get_cert(this)" />
							<span style="color: red; font-size:22px">*</span>
						</td>
						<td >注册地：</td>
						<td>
							<input size="35" type="text" name="zuce_address" id="zuce_address" value="" />
						</td>
					</tr>
					<tr>
						<td >办公场所：</td>
						<td>
							<input size="35" type="text" name="office_address" value="" id="office_address" />
						</td>
					</tr>
				</table>
				<table  cellspacing="1" cellpadding="3" width="100%" id="geren_table" style="display: none" >
					<tr >
						<td width="20%" >个人姓名：</td>
						<td width="30%">
							<input size="20" type="text" name="username" value="" id="username" />
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
						<td width="20%" >年龄：</td>
						<td width="30%">
							<input size="10" type="text" name="age" value="0" id="age" />
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
					</tr>
					<tr>
						<td >性别：</td>
						<td>
							<input type="radio" name="sex" value="0" checked="checked"  />男
							<input type="radio" name="sex" value="1"  />女
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
						<td >文化程度：</td>
						<td>
							<select name="education" id="education">
								<option value="">选择文化程度</option>
								<option value="博士">博士</option>
								<option value="硕士">硕士</option>
								<option value="本科">本科</option>
								<option value="大专">大专</option>
								<option value="中专">中专</option>
								<option value="高中">高中</option>
								<option value="初中">初中</option>
								<option value="小学">小学</option>
							</select>
						</td>
					</tr>
					<tr>
						<td >身份证号码：</td>
						<td>
							<input size="30" type="text" name="cert_number" id="cert_number" value="" onchange="get_cert(this)" />
							<span style="color: red; font-size:22px;font-size: 22px">*</span>
						</td>
						<td >住所：</td>
						<td>
							<input size="35" type="text" name="address" value="" id="address" />
						</td>
					</tr>
					<tr>
						<td >所属单位：</td>
						<td>
							<input size="30" type="text" name="company" value="" id="company"/>
							<span style="color: red; font-size:22px"></span>
						</td>
						<td >社会统一信用代码（组织机构代码）：</td>
						<td>
							<input size="20" type="text" name="jigouma" value="" id="jigouma" />
							<span style="color: red; font-size:22px"></span>
						</td>
						
					</tr>
					<tr>
						<td >法定代表人姓名：</td>
						<td>
							<input size="20" type="text" name="boss_name" value="" id="boss_name" />
							<span style="color: red; font-size:22px"></span>
						</td>
						
						<td >法定代表人身份证号码：</td>
						<td>
							<input size="30" type="text" name="boss_cert" value="" id="boss_cert" onchange="get_cert(this)" />
							<span style="color: red; font-size:22px"></span>
						</td>
					</tr>
				</table>
				<table  cellspacing="1" cellpadding="3" width="100%"  >
					<tr>
						<td width="20%" >行贿次数：</td>
						<!-- 超过两年自动判决为三年以上 -->
						<td width="30%">
							<input size="10" type="text" name="xinhui_cishu" id="xinhui_cishu" value="" />
							<span style="color: red; font-size:22px">*</span>
						</td>
						<td >职务：</td>
						<td>
							<input size="20" type="text" name="position" value="" id="position"/>
						</td>
						
					</tr>
					<tr>
						<td >行贿时间：</td>
						<td>
							<input size="4" type="text" name="xinhui_time_y" value="" id="xinhui_time_y" />年
							<input size="4" type="text" name="xinhui_time_m" value="" id="xinhui_time_m" />月
							<span style="color: red; font-size:10px">*例如：2010年6月</span>
						</td>
						<td width="20%" >行贿数额：</td>
						<td width="30%">
							<input size="10" type="text" name="xinhui_money" id="xinhui_money" value="" onkeyup="this.value=this.value.replace(/[^\d]/g,'') "/>元
							<span style="color: red; font-size:22px">*</span>
						</td>

					</tr>
					<tr>
						<td >录入人员：</td>
						<td>
							<input  size="20" type="text" name="input_name" id="input_name" value="" />
							<span style="color: red; font-size:22px">*</span>
						</td>
						<td >审核人员：</td>
						<td>
							<input   size="20" type="text" name="exam_name" id="exam_name" value="" />
							<span style="color: red; font-size:22px">*</span>
						</td>
					</tr>
				</table>
				<table cellspacing="1" cellpadding="3" width="100%" style="display: none" id="fanzui_jiben">
					<tr>
						<td width="20%">刑期：</td>
						<td width="30%">
							<select id="xingqi" name="xingqi">
                                <option value="">请选择</option>
                                <option value="1">判处三年以上有期徒刑</option>
                                <option value="2">判处一年以上三年以下有期徒刑</option>
                                <option value="3">其他判决结果</option>
       						</select>
							<span style="color: red; font-size:22px">*</span>
						</td>
						<td width="20%" >判决文书编号：</td>
						<td width="30%">
							<input id="panjuewenshu_id"  name="panjuewenshu_id"/>
							<span style="color: red; font-size:22px">*</span>
						</td>
					</tr>
				</table>
			</div>

			<!-- 行为信息信息 -->
			<div id="xingwei_xinxi" style="display: none" class="list-div-xin">
				<table cellspacing="1" id="xinhui_xingwei" cellpadding="3" width="100%">
					<tr>
						<td width="20%" >行贿行为与情节：</td>
						<td width="80%">
							<textarea name="behavior_xingwei" style="width: 90%" rows="10"  id="behavior_xingwei" placeholder="请填写行贿行为的事实经过..."></textarea>
						</td>
					</tr>
				</table>
				<table  cellspacing="1" id="xinghui_fanzui" cellpadding="3" width="100%" style="display: none">
					<tr>
						<td width="20%">行贿犯罪与情节：</td>
						<td width="80%">
							<textarea name="behavior_fanzui" style="width: 90%" rows="10"   id="behavior_fanzui" placeholder="请填写行贿行为的事实经过..."></textarea>
						</td>
					</tr>
				</table>
				<table cellspacing="1" cellpadding="3" width="100%">
					<tr>
						<td width="20%" >添加附件：</td>
						<td width="80%">
							<input type="file" name="fujian_add" style="border: none"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="button" readonly  style="cursor: pointer;width:50px;text-align: center;"  value="提交" id="ajax_id" onclick="check(this.form)"/>
							<input type="reset" style="cursor: pointer;width:55px;height:24px;text-align: center;background: #fff"  value=" 重置 " />
						</td>
					</tr>
				</table>

				<table  id="input_submit" cellspacing="1"  cellpadding="3" width="100%" style="display: none"  >
					<tr>
						<td width="20%" >处置标准：</td>
						<td width="80%">
							<textarea   name="chuzhi_biaozhun" style="width: 90%" rows="6"  id="chuzhi_biaozhun" placeholder="请填写行贿行为的事实经过..."></textarea>
						</td>
					</tr>
					<tr>
						<td >处置期限：</td>
						<td>
							<input  name="chuzhi_qixian" id="chuzhi_qixian"/>月
						</td>
					</tr>
					<tr>
						<td>

						</td>
						<td>
							<input type="submit" style="cursor: pointer;width:55px;height:24px;text-align: center;background: #fff"  class="button" value="提交"  />
						</td>
					</tr>
				</table>
			</div>
	    </form>
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
	//text加插件
	/*UE.getEditor('behavior_xingwei', {
		"initialFrameWidth" : "90%",   // 宽
		"initialFrameHeight" : 250,      // 高
		"maximumWords" : 10000            // 最大可以输入的字符数量
	});
	UE.getEditor('behavior_fanzui', {
		"initialFrameWidth" : "90%",   // 宽
		"initialFrameHeight" : 250,      // 高
		"maximumWords" : 10000            // 最大可以输入的字符数量
	});*/
	//选择单位或者个人
	function chang_geren_danwei(obj){
		if(obj==0){
			$("#danwei_table").show();
			$("#geren_table").hide();
		}else{
			$("#danwei_table").hide();
			$("#geren_table").show();
		}
	}
	function chang_xingwei_fanzui(obj){
		if(obj==0){
			$("#xinhui_xingwei").show();
			$("#xinghui_fanzui").hide();
			$("#fanzui_jiben").hide();
		}else{
			$("#xinhui_xingwei").hide();
			$("#xinghui_fanzui").show();
			$("#fanzui_jiben").show();
		}
	}


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

	//身份证验证
	function get_cert(obj) {
		var cert_number = $(obj).val();
		if(!IsCertNum(cert_number)) {
			alert("身份证输入不规范!");
			$(obj).val('');
			$(obj).focus();
			return false;
		}
	}

	//身份证号码的正则表达式
	function IsCertNum(num){
		var reg=/^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;
		return(reg.test(num));
	}

	//检查form表单输入框
	function check(form) {
		if($("#danwei_geren").val()=='0'){
			if ($("#company_name").val()==''|| $("#company_name").val()==null){
				alert('单位名称不能为空');
				return false;
			}
			if ($("#nature").val()==''|| $("#nature").val()==null){
				alert('单位性质不能为空');
				return false;
			}
			if ($("#jigouma").val()==''|| $("#jigouma").val()==null){
				alert('组织机构码不能为空');
				return false;
			}
			if ($("#boss_name").val()==''|| $("#boss_name").val()==null){
				alert('法定人代表人姓名不能为空');
				return false;
			}
			
			if ($("#boss_cert").val()==''|| $("#boss_cert").val()==null){
				alert('法定代表人身份证不能为空');
				return false;
			}

		}else{
			if ($("#username").val()==''|| $("#username").val()==null){
				alert('个人姓名不能为空');
				return false;
			}
			if ($("#age").val()==''|| $("#age").val()==null){
				alert('年龄不能为空');
				return false;
			}
			
			if ($("#cert_number").val()==''|| $("#cert_number").val()==null){
				alert('身份证号码不能为空');
				return false;
			}

		}
		if ($("#xinhui_cishu").val()==''|| $("#xinhui_cishu").val()==null){
			alert('行贿次数不能为空');
			return false;
		}
		if ($("#xinhui_money").val()==''|| $("#xinhui_money").val()==null){
			alert('行贿数额不能为空');
			return false;
		}
		if ($("#xinhui_money").val() <=999 || $("#xinhui_money").val().length <=3 ){
			alert('行贿数额不能低于1000元');
			return false;
		}
		if ($("#xinhui_time_y").val()==''|| $("#xinhui_time_y").val()==null){
			alert('行贿时间年份不能为空');
			return false;
		}
		if ($("#xinhui_time_m").val()==''|| $("#xinhui_time_m").val()==null){
			alert('行贿时间月份不能为空');
			return false;
		}
		// if ($("#input_company").val()==''|| $("#input_company").val()==null){
		// 	alert('录入单位不能为空');
		// 	return false;
		// }
		if ($("#input_name").val()==''|| $("#input_name").val()==null){
			alert('录入人员不能为空');
			return false;
		}
		if ($("#exam_name").val()==''|| $("#exam_name").val()==null){
			alert('审核人员不能为空');
			return false;
		}

		if($("#xinhui_fenlei").val()=='0'){

		}else{

			if ($("#panjuewenshu_id").val()==''|| $("#panjuewenshu_id").val()==null){
				alert('判决文书编号不能为空');
				return false;
			}
			if ($("#xingqi").val()==''|| $("#xingqi").val()==null){
				alert('刑期不能为空');
				return false;
			}
		}

		//ajax获取处置结果与期限
			var xinhui_fl = $("#xinhui_fenlei").val();
			var xinhui_cishu = $("#xinhui_cishu").val();
			var xinhui_money = $("#xinhui_money").val();
			var xingqi = $("#xingqi").val();
			$.ajax({
				url: "/index.php/admin/information/ajax_info",
				type: "post",
				dataType: "json",
				data: "xinhui_fl="+xinhui_fl+"&xinhui_cishu="+xinhui_cishu+"&xinhui_money="+xinhui_money+"&xingqi="+xingqi,
				async: false,
				success: function (obj) {
					$("#chuzhi_biaozhun").val(obj.msg);
					$("#chuzhi_qixian").val(obj.cz_qi);

					$("#input_submit").show();
				}
			});

	}

</script>











