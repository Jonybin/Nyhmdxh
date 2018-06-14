<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;
use app\admin\model\Gonggao as gonggaoModel;
use app\admin\model\Admin as AdminModel;

class Login extends Controller
{
    public function login(){
        srand((double)microtime()*1000000);
        $_SESSION['rnd'] =rand() . rand();//返回给客户端的随机数
        if(Request::instance()->isPost()){   //判断操作是否为post请求
            //判断登录的用户名 密码
            $usermodel = new AdminModel;
            $curr_admin = $usermodel
                ->where('username','=', input('username'))
                ->find();
            if(empty($curr_admin)){
                $this->error('用户名不存在');
                return;
            }else{
                if(md5(input('pass'))==$curr_admin['password']){
                    $Key = $curr_admin['ukey'];
                    $strData =input('rnd');
                    $m_StrEnc = StrEnc($strData,$Key);
                    $return_EncData = input('return_EncData');
                    if (strcasecmp(trim($m_StrEnc),trim($_POST['return_EncData']))!=0)
                    {
                        $this->error('该用户不是合法用户');
                    }
                    //判断用户有没有被禁用
                    if($curr_admin['is_use']==1) {
                        Session::set('id', $curr_admin['id']);
                        Session::set('company', $curr_admin['Company']);
                        Cookie::set('username', $curr_admin['username'], 3600 * 1);
                        Cookie::set('password', $curr_admin['password'], 3600 * 1);

                        $url = "/index.php/admin/index/index";
                        $this->redirect($url);
                    }else{
                        $this->error('该用户被禁用');
                    }
                }else{
                    echo '<script type="text/javascript">
                    alert("密码错误");
                     history.back(-1);
                    </script>';
                    // $this->error('密码错误');
                    return;
                }
            }
        }
        $gonggaoModel =new gonggaoModel;
        $info = $gonggaoModel->where('gg_status','=',0)->order('gg_time desc')->select();
        $this->assign('info',$info);
        return $this->fetch();
    }

    //退出
    public function tuichu(){
        Session::set('id','');
        Cookie::set('username','',60);
        Cookie::set('password','',60);
        // 清除think作用域
        Session::clear('think');
        $url="/index.php/admin/login/login";
        $this->redirect($url);
    }

    //公告详情页
    public function gonggao_xiang(){
        $gg_id =  Request::instance()->param('gg_id');
        $gonggaoModel = new gonggaoModel;
        $info = $gonggaoModel->where('gg_id','=',$gg_id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }


    //安装控件页面
    public function kongjian(){
        return $this->fetch();
    }

}
?>