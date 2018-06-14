<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\wamp\www\public/../application/admin\view\allcount\cx_num.html";i:1522219757;s:64:"E:\wamp\www\public/../application/admin\view\\layout\header.html";i:1525517747;s:64:"E:\wamp\www\public/../application/admin\view\\layout\footer.html";i:1521789418;}*/ ?>
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
<h1>
    
    <span class="action-span1">(横向)查询统计</span>
    <div class="form-div search_form_div">
    <form method="post" action="" name="search_form" onsubmit="return checkForm(this)">
        <input name="time" value="<?php if(!empty($sta_t))echo $sta_t;?>" id="time" style="margin-left:40%;" placeholder="开始时间" type="text" size="20" onclick="return Calendar('time');" />
        <input type="text" name="time2" value="<?php if(!empty($end_t))echo $end_t;?>" id="time2" placeholder="结束时间" onclick="return Calendar('time2');"/>
        <select id="nature" name="danwei">
                                <option value="">请选择单位</option>
            <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $val['b_name']; ?>"><?php echo $val['b_name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <input type="submit" value=" 检索 " class="button" style="margin-left: 15px"/>
        <span class="action-span"><a href="/index.php/admin/allcount/export_xji_num">导出Excel表</a></span>
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
            <th >时间段</th>
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
                        <?php echo $v['sta_time']; ?>-<?php echo $v['end_time']; ?>
                </td>
                <td align="center">
                       <a href="/index.php/admin/allcount/cx_num_chuzhi/id/<?php echo $v['chuzhi_ids']; ?>">
                        查看详情
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

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