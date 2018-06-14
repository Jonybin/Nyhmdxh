<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;

use app\admin\model\Privilege as PriviModel;
use app\admin\controller\Index;

class Privilege extends Index
{
    public function add(){
        $privilegemodel = new PriviModel;
        if(Request::instance()->isPost())
        {
            $date['parent_id']= Request::instance()->param('parent_id');
            $date['pri_name']= Request::instance()->param('pri_name');
            $date['module_name']= Request::instance()->param('module_name');
            $date['controller_name']= Request::instance()->param('controller_name');
            $date['action_name']= Request::instance()->param('action_name');

            //字段验证
            $data = [
                'pri_name'=>$date['pri_name'],
                'module_name'=>$date['module_name'],
                'controller_name'=>$date['controller_name'],
                'action_name'=>$date['action_name'],
                'parent_id'=>$date['parent_id'],
            ];

            $validate =  \think\Loader::validate('Privilege');
            if(!$validate->check($data)){
                $res = $validate->getError();
                $this->error($res);
                // dump($validate->getError());
                exit;
            }
            if($privilegemodel->create($date))
            {
                // $this->success('添加权限成功','Privilege/lst');
                $this->redirect('Privilege/lst');
                exit;
            }else {
                $this->error('添加权限失败');
            }
        }
        $parentData = $privilegemodel->getTree();
        $this->assign('parentData', $parentData);
        return $this->fetch();
    }

    //权限列表
    public function lst(){
        $privilegemodel = new PriviModel;
        $data = $privilegemodel->getTree();

        $this->assign(array(
            'data' => $data,
        ));
        return $this->fetch();
    }

    //权限修改
    public function edit(){
        $privilegemodel = new PriviModel;
        if(Request::instance()->isPost()) {
            $date['id'] = Request::instance()->param('id');
            $date['parent_id']= Request::instance()->param('parent_id');
            $date['pri_name']= Request::instance()->param('pri_name');
            $date['module_name']= Request::instance()->param('module_name');
            $date['controller_name']= Request::instance()->param('controller_name');
            $date['action_name']= Request::instance()->param('action_name');

            //字段验证
            $data = [
                'pri_name'=>$date['pri_name'],
                'module_name'=>$date['module_name'],
                'controller_name'=>$date['controller_name'],
                'action_name'=>$date['action_name'],
                'parent_id'=>$date['parent_id'],
            ];

            $validate =  \think\Loader::validate('Privilege');

            if(!$validate->check($data)){
                dump($validate->getError());
                exit;
            }
            if($privilegemodel->update($date))
            {
                // $this->success('修改权限成功','Privilege/lst');
                $this->redirect('Privilege/lst');
                exit;
            }else {
                $this->error('修改权限失败');
            }
        }
        $id= Request::instance()->param('id');
        $data = $privilegemodel->where('id','=',$id)->find();
        $this->assign('data',$data);

        $parentData = $privilegemodel->getTree();
        $children = $privilegemodel->getChildren($id);
        $this->assign(array(
            'parentData' => $parentData,
            'children' => $children,
        ));
        return $this->fetch();
    }

    //权限删除
    public function delete()
    {
        $privilegemodel = new PriviModel;
        $id = Request::instance()->param('id');
        if($privilegemodel->where('id',$id)->delete())
        {
            // $this->success('删除权限成功','Privilege/lst');
            $this->redirect('Privilege/lst');
            exit;
        }
        else
        {
            $this->error('删除权限失败');
        }
    }
}