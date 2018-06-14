<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;
use app\admin\model\Gonggao as gonggaoModel;
use app\admin\model\Tongbao as tongbaoModel;

use app\admin\controller\Index;
class Notice extends Index
{
    /*
     * 通知公告管理操作
     * */

    //通知公告列表
    public function lst_gg(){
        $gonggaoModel = new gonggaoModel;

        //获取所有的通知公告信息
        $info = $gonggaoModel->get_all_gg();
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }
    //通知公告添加
    public function add_gg(){
        if(Request::instance()->isPost()) {
            $gonggaoModel = new gonggaoModel;
            $adminId = session('id');
            $date['gg_title'] =  Request::instance()->param('gg_title');
            $date['gg_content'] =  Request::instance()->param('gg_content');
            $date['gg_time'] =  strtotime(Request::instance()->param('gg_time'));
            $date['gg_status'] =  Request::instance()->param('gg_status');
            $date['add_id'] =  $adminId;

            $query = $gonggaoModel->create($date);
            if($query){
                // $this->success('添加通知公告成功','notice/lst_gg');
                $this->redirect('Notice/lst_gg');
            }else{
                $this->error('添加通知公告失败');
            }
        }
        return $this->fetch();
    }

    //通知公告删除
    public function del_gg(){
        $gg_id =  Request::instance()->param('gg_id');
        $gonggaoModel = new gonggaoModel;
        $query = $gonggaoModel->where('gg_id','=',$gg_id)->delete();
        if($query){
            // $this->success('通知公告删除成功','notice/lst_gg');
            $this->redirect('Notice/lst_gg');

        }else{
            $this->error('通知公告删除失败');
        }
    }

    //通知公告修改
    public function edit_gg(){
        if(Request::instance()->isPost()) {
            $gonggaoModel = new gonggaoModel;
            $adminId = session('id');
            $date['gg_id'] =  Request::instance()->param('gg_id');
            $date['gg_title'] =  Request::instance()->param('gg_title');
            $date['gg_content'] =  Request::instance()->param('gg_content');
            $date['gg_time'] =  strtotime(Request::instance()->param('gg_time'));
            $date['gg_status'] =  Request::instance()->param('gg_status');
            $date['add_id'] =  $adminId;

            $query = $gonggaoModel->update($date);
            if($query){
                // $this->success('修改通知公告成功','notice/lst_gg');
                $this->redirect('Notice/lst_gg');

            }else{
                $this->error('修改通知公告失败');
            }
        }
        $gg_id =  Request::instance()->param('gg_id');
        $gonggaoModel = new gonggaoModel;
        $info = $gonggaoModel->where('gg_id','=',$gg_id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

    /*
     *
     * 系统通报管理操作
     *
     * */

    //系统通报列表
    public function lst_tb(){
        $tongbaoModel = new tongbaoModel;

        //获取所有的通知公告信息
        $info = $tongbaoModel->get_all_tb();
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }

    //系统通报添加
    public function add_tb(){
        if(Request::instance()->isPost()) {
            $tongbaoModel = new tongbaoModel;
            $adminId = session('id');
            $date['tb_title'] =  Request::instance()->param('tb_title');
            $date['tb_content'] =  Request::instance()->param('tb_content');
            $date['tb_time'] =  strtotime(Request::instance()->param('tb_time'));
            $date['tb_status'] =  Request::instance()->param('tb_status');
            $date['add_id'] =  $adminId;

            $query = $tongbaoModel->create($date);
            if($query){
                // $this->success('添加系统通报成功','notice/lst_tb');
                $this->redirect('Notice/lst_tb');

            }else{
                $this->error('添加系统通报失败');
            }
        }
        return $this->fetch();
    }

    //通知公告删除
    public function del_tb(){
        $tb_id =  Request::instance()->param('tb_id');
        $tongbaoModel = new tongbaoModel;
        $query = $tongbaoModel->where('tb_id','=',$tb_id)->delete();
        if($query){
            // $this->success('系统通报删除成功','notice/lst_tb');
                $this->redirect('Notice/lst_tb');

        }else{
            $this->error('系统通报删除失败');
        }
    }

    //系统通报修改
    public function edit_tb(){
        if(Request::instance()->isPost()) {
            $tongbaoModel = new tongbaoModel;
            $adminId = session('id');
            $date['tb_id'] =  Request::instance()->param('tb_id');
            $date['tb_title'] =  Request::instance()->param('tb_title');
            $date['tb_content'] =  Request::instance()->param('tb_content');
            $date['tb_time'] =  strtotime(Request::instance()->param('tb_time'));
            $date['tb_status'] =  Request::instance()->param('tb_status');
            $date['add_id'] =  $adminId;
            $query = $tongbaoModel->update($date);
            if($query){
                // $this->success('修改系统通报成功','notice/lst_tb');
                $this->redirect('Notice/lst_tb');

            }else{
                $this->error('修改系统通报失败');
            }
        }
        $tb_id =  Request::instance()->param('tb_id');
        $tongbaoModel = new tongbaoModel;
        $info = $tongbaoModel->where('tb_id','=',$tb_id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
}