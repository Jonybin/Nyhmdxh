<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\wamp\www\public/../application/admin\view\index\top.html";i:1525517729;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="/index/css/index.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="/index/css/fy_menu.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="/index/css/fy_menu2.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="/index/css/fy_menu3.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="/index/css/cw_menu.css" media="screen, projection"/>
    <script type="text/javascript" src="/index/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/index/js/menu.js"></script>
    <link href="/index/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
    <script src="/index/js/circle.js"></script>
    <script src="/index/js/jquery.circliful.min.js"></script>
    <style>
        .top_body a{
            color: #fff;
        }
        .top_body a div{
            color: #fff;
        }
        .top_left_right,.top_right_right{
            line-height: 60px;
        }
        .top_right,.top_right_right{
            width: auto;
            color: #fff;
        }
    </style>
</head>
<body class="top_body" style="background-color: #0F5286;color: #fff;" onload="load()">
<div class="top_left">
    <a href="/index.php/admin/index/index" target="main-frame"><div class="top_left_right">首页</div></a>
</div>
<div class="top_right">
    <div class="top_right_right">欢迎：<?php echo cookie('username'); ?> &nbsp;&nbsp;&nbsp;<a href="/index.php/admin/login/tuichu" target="_top" class="fix-submenu">退出</a></div>
</div>

<div class="alert_kuang" style="display: none">

</div>
</body>
</html>