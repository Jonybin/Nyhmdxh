<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"E:\wamp\www\public/../application/admin\view\allcount\cx_xji_num.html";i:1526018638;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\search.html";i:1525834204;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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



<h1><span class="action-span1">查询统计</span>
<script type="text/javascript">
    $("tr.tron").mouseover(function(){
        $(this).find("td").css("backgroundColor", "#DDEEF2");
    });
    $("tr.tron").mouseout(function(){
        $(this).find("td").css("backgroundColor", "#FFF");
    });
    function checkForm(form){
        var t1 = $('#xinhui_time').val();
        var t2 = $('#xinhui_time2').val();
        var my_d = new Date();
        // alert('8888');
        
       //  var y = my_d.getFullYear();
       // var  m= my_d.getMonth()+1;
       // var d= my_d.getDate();
       // var t =y+'-'+m+'-'+d;
       var d1 = new Date(t1.replace(/\-/g, "\/"));
       var d2 = new Date(t2.replace(/\-/g, "\/"));
       if(t2!==''){
        if(t1==''){
            alert('请选择开始时间');
                return false;
        }
            if(d1>my_d || d2>my_d){
                alert('无法超前查询');
                return false;
            }
            if(d1>d2){
                alert('开始时间不能大于结束时间');
                return false;
            }
       }
    }

    function showSite(str)
{
    var test = window.location.search;
    var now_i = window.location.href;
    if(test=="")
    {
        var url = now_i+'?tsize='+str;
    }else{
        var url = now_i+'&tsize='+str;
    }
    
    
    alert(url);
    if (str=="")
    {
        // document.getElementById("tsize").innerHTML="10";
        return;
    } 
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
</script>
<script type="text/javascript" charset="utf-8" src="/admin/Js/showdate.js"></script>
    <div class="form-div search_form_div">
    <form method="get" action="" name="search_form" onsubmit="return checkForm(this)">
        <input name="xinhui_time" value="<?php if(!empty($sta_t))echo $sta_t;?>" id="xinhui_time" style="margin-left:20%;" placeholder="查询时间" type="text" size="20" onclick="return Calendar('xinhui_time');" />
        <input type="text" name="xinhui_time2" value="<?php if(!empty($end_t))echo $end_t;?>" id="xinhui_time2" placeholder="结束时间" onclick="return Calendar('xinhui_time2');"/>
        <select id="diqu" name="diqu">
                                <option value="">地区</option>
                                <?php if($c_diqu ==1){
                                echo '<option value="1" selected="selected">总体</option>';
                            }else{
                                echo '<option value="1" >总体</option>';
                                } if(is_array($diqu) || $diqu instanceof \think\Collection): $i = 0; $__LIST__ = $diqu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dq): $mod = ($i % 2 );++$i;if($dq['b_name'] ==$c_diqu): ?>
                                            <option value="<?php echo $dq['b_name']; ?>" selected="selected"><?php echo $dq['b_name']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $dq['b_name']; ?>"><?php echo $dq['b_name']; ?></option>
                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <select id="danwei" name="danwei">
                                <option value="">单位</option>
                                <?php if($c_danwei!=1){
                                    if($c_danwei ==2){
                                        echo '<option value="2" selected="selected">总体</option>';
                                    }else{
                                        echo '<option value="2" >总体</option>';
                                        } 
                                    }else{
                                    echo '';
                                            }

                                if(is_array($danwei) || $danwei instanceof \think\Collection): $i = 0; $__LIST__ = $danwei;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dw): $mod = ($i % 2 );++$i;if($dw['b_name'] ==$c_danwei): ?>
                                            <option value="<?php echo $dw['b_name']; ?>" selected="selected"><?php echo $dw['b_name']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $dw['b_name']; ?>"><?php echo $dw['b_name']; ?></option>
                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <select name="tsize">
            <?php if($page_row == 10): ?>
                <option value="10" selected="selected">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            <?php elseif($page_row ==15): ?>
                <option value="10" >10</option>
                <option value="15" selected="selected">15</option>
                <option value="20">20</option>
            <?php elseif($page_row ==20): ?>
                <option value="10" >10</option>
                <option value="15" >15</option>
                <option value="20" selected="selected">20</option>
            <?php endif; ?>
                </select>
                <span>条/页</span>
        <input type="submit" value=" 检索 " class="button" style="margin-left: 15px"/>
        
    <span class="action-span"><a href="/index.php/admin/allcount/export_cx_xji_num">导出Excel表</a></span>
    </form>
</div>
</h1>
<!-- 列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">

        <tr>
            <th >查询单位</th>
            <th >查询次数</th>
            <th >查询结果次数</th>
            <th >处置次数</th>
            <th >操作</th>
        </tr>
        <?php if(is_array($info) || $info instanceof \think\Collection): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center">
                    <?php echo $v['username']; ?>
                </td>

                <td align="center">
                        <?php echo $v['find_num']; ?>
                </td>
                <td align="center">
                         <?php echo $v['find_re_num']; ?>

                </td>
                <td align="center">
                        <?php echo $v['chuzhi_num'];; ?>
                </td>
                
                <td align="center">
                       <a href="/index.php/admin/allcount/cx_num_chuzhi/id/<?php echo $v['chuzhi_ids']; ?>">
                        查看详情
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td align="center">总计</td>
            <td align="center"><?php echo $all_num; ?></td>
            <td align="center"><?php echo $re_num; ?></td>
            <td align="center"><?php echo $chuzhi_num; ?></td>
            <td align="center"><a href="/index.php/admin/allcount/cx_fenxi">分析图</a></td>
        </tr>
        <tr>
            <td align="right" nowrap="true" colspan="14" height="30"><?php echo $page; ?></td>
        </tr>

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

    function checkForm(form){
        var t1 = $('#time').val();
        var t2 = $('#time2').val();
        var my_d = new Date();
       var d1 = new Date(t1.replace(/\-/g, "\/"));
       var d2 = new Date(t2.replace(/\-/g, "\/"));
       if(t1!==''&&t2!==''){
            if(d1>my_d || d2>my_d){
                alert('无法超前查询');
                return false;
            }
            if(d1>d2){
                alert('开始时间不能大于结束时间');
                return false;
            }
       }else{
        alert('请选择查询时间段');
        return false;
       }
    }
</script>