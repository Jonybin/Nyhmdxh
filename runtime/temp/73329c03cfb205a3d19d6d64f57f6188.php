<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\wamp\www\public/../application/admin\view\login\login.html";i:1521422295;}*/ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>系统登录</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="generator" content="Web Page Maker">
    <link href="/admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        /*----------Text Styles----------*/
        .ws6 {font-size: 8px;}
        .ws7 {font-size: 9.3px;}
        .ws8 {font-size: 11px;}
        .ws9 {font-size: 12px;}
        .ws10 {font-size: 13px;}
        .ws11 {font-size: 15px;}
        .ws12 {font-size: 16px;}
        .ws14 {font-size: 19px;}
        .ws16 {font-size: 21px;}
        .ws18 {font-size: 24px;}
        .ws20 {font-size: 27px;}
        .ws22 {font-size: 29px;}
        .ws24 {font-size: 32px;}
        .ws26 {font-size: 35px;}
        .ws28 {font-size: 37px;}
        .ws36 {font-size: 48px;}
        .ws48 {font-size: 64px;}
        .ws72 {font-size: 96px;}
        .wpmd {font-size: 13px;font-family: 'Arial';font-style: normal;font-weight: normal;}
        /*----------Para Styles----------*/
        DIV,UL,OL /* Left */
        {
            margin-top: 0px;
            margin-bottom: 0px;
        }
    </style>

    <style type="text/css">
        div#container
        {
            position:relative;
            width: 1300px;
            margin-top: 0px;
            margin-left: auto;
            margin-right: auto;
            text-align:left;
        }
        body {
            text-align:center;
            margin:0;
            background-color: #0F1022;
        }
        img{
            vertical-align: top;
        }
    </style>
    <link href="/admin/style_new/shouye.css" rel="stylesheet" type="text/css" />
    <script src="/admin/Js/ac_activex.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8" src="/admin/Js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/admin/Js/Syunew3.js"></script>
    <script type="text/javascript" charset="utf-8" src="/admin/Js/Ukey.js"></script>
    <!-- <script src="/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/sweetalert/sweetalert.css"> -->
</head>

<body onload="load()">

<div id="container">
    <div id="image1" style="position:absolute; overflow:hidden; left:0px; top:2px; width:100%; height:750px; z-index:0">　</div>

    <div id="flash1" style="position:absolute; overflow:hidden; left:0px; top:-20px; width:1300px; height:150px; z-index:1">
        <script type="text/javascript">
            AC_RunFlashContent("id","flash1","width","1300","height","179","quality","high","autoplay","true","loop","true","wmode","window","codebase","http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab","pluginspage","http://www.macromedia.com/go/getflashplayer","src","/admin/images/002.swf");
        </script>
        <noscript>
            <object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" width=1300 height=179>
                <param name="movie" value="/admin/images/002.swf">
                <param name="quality" value="high">
                <param name="loop" value="true">
                <param name="wmode" value="window">
                <param name="autoplay" value="true">
                <!--[if !IE]>-->
                <object data="/admin/images/002.swf" width="1300" height="179" type="application/x-shockwave-flash">
                    <param name="pluginurl" value="http://www.macromedia.com/go/getflashplayer">
                    <param name="quality" value="high">
                    <param name="loop" value="true">
                    <param name="wmode" value="window">
                    <param name="autoplay" value="true">
                </object>
                <!--<![endif]-->
            </object>
        </noscript>
    </div>

    <div id="hr1" style="position:absolute; overflow:hidden; left:0px; top:130px; width:1300px; height:17px; z-index:2">
        <hr size=5 width=1300 color="#FFFFFF">
    </div>

    <div id="image2" style="position:absolute; overflow:hidden; left:416px; top:130px; width:412px; height:331px; z-index:3"><img src="/admin/images/danghui.png" alt="" title="" border=0 width=412 height=331></div>

    <div id="hr2" style="position:absolute; overflow:hidden; left:0px; top:750px; width:1300px; height:17px; z-index:4">
        <hr size=3 width=1300 color="#FFFFFF">
    </div>

    <div id="shape1" style="position:absolute; overflow:hidden; left:162px; top:420px; width:669px; height:301px; z-index:5">
        <img border=0 width="100%" height="100%" alt="" src="/admin/images/shape591360078.gif" style="z-index: 6;position: absolute;">
        <div id="gonggao_content" style="position:absolute;z-index: 7">
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

    <div id="shape2" style="position:absolute; overflow:hidden; left:88px; top:420px; width:78px; height:301px; z-index:6"><img border=0 width="100%" height="100%" alt="" src="/admin/images/shape591920437.gif"></div>

    <div id="text1" style="position:absolute; overflow:hidden; left:111px; top:420px; width:45px; height:275px; z-index:7">
        <div class="wpmd">
            <div style="line-height:2.00;"><font color="#FFFFFF" face="黑体" class="ws24">通&nbsp; 知&nbsp; 公&nbsp; 告</font>
            </div>
        </div>
    </div>
    <div id="shape4" style="position:absolute; overflow:hidden; left:848px; top:485px; width:364px; height:233px; z-index:8"><img border=0 width="100%" height="100%" alt="" src="/admin/images/shape592292984.gif"></div>

    <div id="shape3" style="position:absolute; overflow:hidden; left:848px; top:420px; width:364px; height:71px; z-index:9"><img border=0 width="100%" height="100%" alt="" src="/admin/images/shape592244328.gif"></div>

    <div id="text2" style="position:absolute; overflow:hidden; left:909px; top:420px; width:257px; height:70px; z-index:10">
        <div class="wpmd">
            <div style="line-height:2.00;"><font color="#FFFFFF" face="黑体" class="ws24">用&nbsp; 户&nbsp; 登&nbsp; 录</font></div>
        </div></div>

    <form id="frmlogin" method="post" action="" name="frmlogin"  onsubmit="return false" >
        <div id="text3" style="position:absolute; overflow:hidden; left:867px; top:510px; width:121px; height:149px; z-index:12">
            <div class="wpmd">
                <div align=center style="line-height:4.00;"><font color="#003366" face="黑体" class="ws18">用户名称：</font></div>
                <div align=center style="line-height:1.00;"><font color="#003366" face="黑体" class="ws18">用户密码：</font></div>
            </div>
        </div>
        <input name="username" id="UserName" type="text" style="position:absolute;width:200px;left:989px;top:540px;z-index:13">
        <input name="pass" type="password" style="position:absolute;width:200px;left:989px;top:600px;z-index:14">
        <input type="hidden" name="KeyID" type="text" id="KeyID" size="20" />
        <input type="hidden" name="rnd" type="text" id="rnd" value="<?php echo $_SESSION['rnd'] ?>" />
        <input type="hidden" name="return_EncData" type="text" id="return_EncData" value=""   />
        <input type="hidden" id="Password" type="password" name="password" />
        <input name="" type="button" style="position:absolute;left:990;top:660;z-index:15;cursor:pointer;width: 100px" value="提交登录" onclick="login_onclick()">
    </form>
</div>
<p><img src="/admin/images/beijingtu.jpg" alt="" title="" border=0 width=100% height=750></p>
<script type="text/javascript">
    // function submit(form){
    //     alert('');
    // }
</script>
</body>
</html>