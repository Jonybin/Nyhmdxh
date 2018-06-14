<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\WWW\ny_xinhui\public/../application/admin\view\index\menu.html";i:1492479513;}*/ ?>
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
</head>
<body class="menu_body" style="min-width: 160px;">
<div class="menu_main">
    <div class="menu_main_one">
        <div class="menu_main_one_img"></div>
        <div class="menu_main_one_text"></div>
    </div>
    <div class="menu_main_two">

        <?php $id_fu = 1;$id=0; foreach ($btn as $k => $v): ?>
        <div class="menu_div" id="panent_<?php echo $id_fu;?>" onclick='alert_zi("<?php echo $id_fu;?>")' >
            <div class="menu_div_two">
                <?php echo $v['pri_name']; ?>
            </div>
            <div class="youla"></div>
        </div>
        <!--子栏  start-->
        <div class="zi_menu" <?php if($id_fu!=1): echo "style='display:none'";endif; ?> >
            <?php $id++; $id_fu++; foreach ($v['children'] as $k1 => $v1): ?>
            <a href="/index.php/<?php echo $v1['module_name'].'/'.$v1['controller_name'].'/'.$v1['action_name']; ?>" target="main-frame">

                <div class="zi_menu_div"  id="zi_<?php echo $id;?>" onmouseover="qie_color(this)" onmouseout="qie_colors(this)"  onclick='is_img("<?php echo $id;?>")' >
                    <?php $id++; ?>
                    <div class="zi_menu_div_one">
                        <img src="/index/images/sanjiao_03.png" width="10px" height="16px" />
                    </div>
                    <div class="zi_menu_div_two">
                        <?php echo $v1['pri_name']; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>

        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="alert_kuang" style="display: none">

</div>
</body>
</html>