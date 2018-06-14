

    //鼠标放上去高亮
    function qie_color(obj){
        $(obj).css('color','#fff');
    }
    function qie_colors(obj){
        $(obj).css('color','#d9d9d9');

    }

    //点击背景为一张蓝色的图
    function is_img(nav){
        for(var i=1;i<=27;i++){
            if(i==nav){
                if(nav==27){
                    $("#zi_"+nav).attr('class', 'menu_div2');
                }else {
                    $("#zi_" + nav).attr('class', 'zi_menu_div2');
                }
            }else{
                if(i==27){
                    $("#zi_"+i).attr('class', 'menu_div');
                }else {
                    $("#zi_" + i).attr('class', 'zi_menu_div');
                }
            }
        }
    }

    //弹出子集
    function alert_zi(nav){
        for(var i=1;i<=6;i++){
            if(i==nav){
                if($("#panent_" + nav).next().is(':hidden')) {
                    $("#panent_" + nav).next().slideToggle('fast');
                }else{
                    $("#panent_" + nav).next().slideUp();
                }
            }else{
                $("#panent_" + i).next().slideUp();
            }
        }
    }


    //日历
    

