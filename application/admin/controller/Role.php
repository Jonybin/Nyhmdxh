<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;

use app\admin\model\Privilege as PriviModel;
use app\admin\model\Role as RoleModel;
use app\admin\model\Role_privilege as Ro_priModel;

use app\admin\controller\Index;
class Role extends Index
{
    //添加角色
    public function add(){
        if(Request::instance()->isPost()) {
            $rolemodel = new RoleModel;
            $ro_primodel = new Ro_priModel;
            $date['role_name']= Request::instance()->param('role_name');
            $pri_id= $_POST['pri_id'];
            $role = $rolemodel->create($date);
            if($role){
                
                if($pri_id ==null || empty($pri_id)){
                    $this->error('添加角色失败');
                }else{

                    foreach ($pri_id as $k => $v)
                    {   
                        $info['role_id']= $role['id'];
                        $info['pri_id']= $v;
                        $ro_primodel->create($info);
                    }
                // $this->success('添加角色成功','Role/lst');
                $this->redirect('Role/lst');
                exit;
                }
                
            }else {
                $this->error('添加角色失败');
            }
        }
        // 取出所有的权限
        $privilegemodel = new PriviModel;
        $priData = $privilegemodel->getTree();
        $this->assign('priData', $priData);

        return $this->fetch();
    }

    //查询角色
    public function lst(){
        $rolemodel = new RoleModel;

        $sql = "SELECT a.*,GROUP_CONCAT(c.pri_name) pri_name FROM ny_role a LEFT JOIN
ny_role_privilege b ON a.id=b.role_id LEFT JOIN ny_privilege c ON b.pri_id
            =c.id GROUP BY a.id";
        $data = Db::query($sql);
        $this->assign('data',$data);
        return $this->fetch();
    }

    //修改角色
    public function edit(){
        if(Request::instance()->isPost()) {
            //先清除原来的权限
            $ro_primodel = new Ro_priModel;
            $id= Request::instance()->param('id');
            $ro_primodel->where('role_id','=',$id)->delete();

            //修改角色  和重新添加权限
            $date['id']= Request::instance()->param('id');
            $date['role_name']= Request::instance()->param('role_name');
            $pri_id= $_POST['pri_id'];
            $rolemodel = new RoleModel;
            $role = $rolemodel->update($date);
            if($role){
                foreach ($pri_id as $k => $v)
                {
                    $info['role_id']= $role['id'];
                    $info['pri_id']= $v;
                    $ro_primodel->create($info);
                }
                // $this->success('修改角色成功','Role/lst');
                $this->redirect('Role/lst');
                exit;
            }else {
                $this->error('修改角色失败');
            }
        }
        //取出角色
        $rolemodel = new RoleModel;
        $id= Request::instance()->param('id');
        $data = $rolemodel->where('id','=',$id)->find();
        $this->assign('data', $data);

        // 取出所有的权限
        $privilegemodel = new PriviModel;
        $priData = $privilegemodel->getTree();
        $this->assign('priData', $priData);

        // 取出当前角色所拥有的权限的ID
        $ro_primodel = new Ro_priModel;
        $rpData = $ro_primodel->field('GROUP_CONCAT(pri_id) pri_id')->where(array('role_id'=>array('eq', $id)))->find();
        $this->assign('pri_id', $rpData['pri_id']);

        return $this->fetch();
    }

    //删除角色
    public function delete(){
        $rolemodel = new RoleModel;
        $id= Request::instance()->param('id');
        $info = $rolemodel->before_delete($id);
        if($info){
            // $this->success('删除角色成功','Role/lst');
            $this->redirect('Role/lst');
        }else{
            $this->error('删除角色失败');
        }
    }
}