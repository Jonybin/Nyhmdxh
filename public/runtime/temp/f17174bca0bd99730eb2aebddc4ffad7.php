<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\WWW\ny_xinhui\public/../application/admin\view\login\login.html";i:1492480376;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/admin/style_new/shouye.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/admin/Js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/Js/Syunew3.js"></script>
<script type="text/javascript" charset="utf-8" src="/admin/Js/Ukey.js"></script>
</head>
<body onload="load()">
<div id="onepics"><div class="onepic_wrap"><img src="/admin/images/shouye.jpg" class="wrap_pic"></div></div>

<div class="main">
    <div class="title_content">南阳市行贿“黑名单”信息平台管理</div>
    <div class="gonggao">
        <div class="gonggao_div">通知公告</div>
        <div id="gonggao_content">
            <div id="gonggao_content2">
                <ul id="express">
                    <?php foreach($info as $k =>$v): ?>
                    <li>
                        <div style="display:inline;">
                            <a href="/index.php/admin/login/gonggao_xiang/gg_id/<?php echo $v['gg_id']; ?>" target="_blank"><?php echo $v['gg_title']; ?></a>
                        </div>
                        <div style="float: right"><?php echo date('Y-m-d',$v['gg_time']); ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div id="gonggao_content3" style="display: none"></div>
    </div>
    <div class="login">
        <div class="login_div1">登录</div>
        <div class="login_div2">
            <form id="frmlogin" method="post" action="" name="frmlogin"   >
                <table class="login_table">

                    <tr>
                        <td class="left_td">管理员用户：</td>
                        <td>
                            <input id="UserName" type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td class="left_td">管理员密码：</td>
                        <td>
                            <input   type="password" name="pass" />
                        </td>
                        <input type="hidden" name="KeyID" type="text" id="KeyID" size="20" />
                        <input type="hidden" name="rnd" type="text" id="rnd" value="<?php echo $_SESSION['rnd'] ?>" />
                        <input type="hidden" name="return_EncData" type="text" id="return_EncData" value=""   />
                        <input type="hidden" id="Password" type="password" name="password" />
                    </tr>

                    <tr>
                        <td class="left_td">&nbsp;</td>
                        <td>
                            <input style="cursor:pointer;" type="button" name="Submit" value="开始登录" onclick="login_onclick()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    var win_height; //浏览器当前窗口可视区域高度
    var win_width; //浏览器当前窗口可视区域宽度
    var original_width = 1920; //图片原始尺寸，编辑可手填
    var original_height = 904; //图片原始尺寸，编辑可手填

    var pic_width, pic_height, pic_left ,pic_top; //裁剪适配后的图片显示尺寸和左边距、上边距

    OnePicAction();

    function OnePicAction(){
        win_height = $(window).height(); //浏览器当前窗口可视区域高度
        win_width = $(window).width(); //浏览器当前窗口可视区域宽度

        //裁剪图片
        if(Math.ceil(win_height * original_width / original_height) < win_width ){
            pic_width = win_width ;
            pic_height = Math.ceil(win_width * original_height / original_width);
            pic_left = 0;
            pic_top = - Math.ceil((pic_height - win_height) / 2);
        }else{
            pic_height = win_height;
            pic_width = Math.ceil(win_height * original_width / original_height);
            pic_left = - Math.ceil((pic_width - win_width) / 2);
            pic_top = 0;
        }
        $("#onepics .wrap_pic").css("width",pic_width+"px").css("height",pic_height+"px").css("margin-top",pic_top+"px").css("margin-left",pic_left+"px");

    }
    //浏览器大小变化时壹图处理
    window.onresize = function(){
        OnePicAction();
    }

    //js滚动条
    //获取id=demo,id=demo1,id=demo2的元素对象，并把id=demo1的内容赋值给id=demo2
    var demo=document.getElementById("gonggao_content");
    var demo1=document.getElementById("gonggao_content2");
    var demo2=document.getElementById("gonggao_content3");
    demo2.innerHTML=demo1.innerHTML;
    //给demo1,demo2加相同的高度
    demo1.style.height=demo.offsetHeight+"px";
    demo2.style.height=demo.offsetHeight+"px";
    //定时器，每隔50毫秒调用一次scrollup()函数，来实现文字的滚动
    var timer=window.setInterval("scrollup()",80);
    //定义函数
    function scrollup()
    {
        //如果demo滚上去的高度大于demo的高度，重新给demo赋值从0再开始滑动
        if(demo.scrollTop>=demo.offsetHeight)
        {
            demo.scrollTop=0;
        }else
        {
            demo.scrollTop++;
        }
    }
    //鼠标放上停止滚动，鼠标离开继续滚动
    demo.onmouseover=function(){
        //清除定时器
        clearInterval(timer);
    }
    demo.onmouseout=function(){
        //添加定时器
        timer=window.setInterval("scrollup()",50);
    }
</script>

</script>