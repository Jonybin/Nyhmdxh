<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;
use app\admin\model\Danwei as DanweiModel;
use app\admin\model\Role as RoleModel;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Admin_role as Admin_roleModel;
use app\admin\model\Realname as RealnameModel;

use app\admin\controller\Index;
class Admin extends Index
{
    //添加管理员
    public function add(){
        if(Request::instance()->isPost()) {
            $date['username']= Request::instance()->param('username');
            $date['password']= Request::instance()->param('password');
            $date['Company']= Request::instance()->param('Company');
            $date['admin_role']= Request::instance()->param('admin_role');
            $cpassword= Request::instance()->param('cpassword');
            $date['is_use']= Request::instance()->param('is_use');
            $date['ukey']= Request::instance()->param('ukey');
            $role_id = $_POST['role_id'];
            //字段验证
            $data = [
                'username'=>$date['username'],
                'password'=>$date['password'],
                'cpassword'=>$cpassword,
                'is_use'=>$date['is_use'],
                'Company'=>$date['Company'],
                'admin_role'=>$date['admin_role'],
            ];

            $validate =  \think\Loader::validate('Admin');

            if(!$validate->check($data)){
                $var = $validate->getError();
                 $this->error($var);
                exit;
            }
            $date['password'] = md5($date['password']);
            $AdminModel = new AdminModel;
            $Admin_roleModel = new Admin_roleModel;
            $query= $AdminModel->create($date);
            if($query){
                    foreach ($role_id as $k => $v) {
                        $info['admin_id'] = $query['id'];
                        $info['role_id'] = $v;
                        $Admin_roleModel->create($info);
                    }
                // $this->success('添加管理员成功','Admin/lst');
                $this->redirect('Admin/lst');
                exit;
            }else{
                $this->error('添加管理员失败');
            }
        }
        // 取出所有的角色
        $RoleModel = new RoleModel;
        $roleData = $RoleModel->select();
        $this->assign('roleData', $roleData);
        return $this->fetch();
    }
    //管理员列表
    public function lst(){
        $AdminModel = new AdminModel;
        $adminId = session('id');// 取出当前管理员的ID
        $where = array();
        if($adminId!=1){
            $where['id'] = array('eq',$adminId);
        }
        $key = '';
        $key = Request::instance()->param('keyword');
        if($key){
            $data = $AdminModel->where($where)->where('username','like','%'.$key.'%')->paginate(12,false,['query' => request()->param()]);
        }
        else{
             $data = $AdminModel->where($where)->paginate(12);
        }
        
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        $this->assign('keyword',$key);
        $this->assign('adminId',$adminId);
        return $this->fetch();
    }

    //修改管理员
    public function edit(){
        // 要修改的管理员的ID
        $id = Request::instance()->param('id');
        // 先判断是否有权修改
        $adminId = session('id');// 取出当前管理员的ID
        // 如果是普通管理员要修改其他管理员的信息提示无权
        if($adminId > 1 && $adminId != $id)
            $this->error('无权修改！');

        if(Request::instance()->isPost()) {
            //先清除先前的角色
            if($adminId==1) {
                $arModel = new Admin_roleModel;
                $arModel->where('admin_id', '=', $id)->delete();
                $role_id = $_POST['role_id'];
            }
            //修改管理员
            $date['id']= $id;
            $password= Request::instance()->param('password');
            $cpassword= Request::instance()->param('cpassword');
            $date['is_use']= Request::instance()->param('is_use');

            if(!empty($password)){
                if($password ==$cpassword){
                    $date['password'] = md5($password);
                }else{
                    $this->error('两次密码不一致');
                    exit;
                }
            }

            $AdminModel = new AdminModel;
            $Admin_roleModel = new Admin_roleModel;
            $role = $AdminModel->update($date);
            if($role){
                if($adminId==1) {
                    foreach ($role_id as $k => $v) {
                        $info['admin_id'] = $role['id'];
                        $info['role_id'] = $v;
                        $Admin_roleModel->create($info);
                    }
                }
                $this->redirect('admin/lst');
                exit;
            }else {
                $this->error('修改管理员失败');
            }

        }
        $AdminModel = new AdminModel;
        $data = $AdminModel->find($id);
        $this->assign('data', $data);

        // 取出所有的角色
        $roleModel = new RoleModel;
        $roleData = $roleModel->select();
        $this->assign('roleData', $roleData);
        // 取出当前管理员所在的角色的ID
        $arModel = new Admin_roleModel;
        $rid = $arModel->field('GROUP_CONCAT(role_id) role_id')->where(array('admin_id'=>array('eq', $id)))->find();
        $this->assign('rid', $rid['role_id']);

        $this->assign('adminId', $adminId);
        return $this->fetch();
    }

    public function delete(){
        $AdminModel = new AdminModel;
        $id= Request::instance()->param('id');
        $info = $AdminModel->before_delete($id);
        if($info){
            // $this->success('删除管理员成功','Admin/lst');
            $this->redirect('Admin/lst');
        }else{
            $this->error('删除管理员失败');
        }
    }

    //ajax修改管理员的状态
    public function get_isuse(){
        //ajax参数
        $admin_id =  Request::instance()->param('admin_id');
        // 超级管理员不能修改
        if($admin_id==1){
            return false;
        }
        // 不能修改别人的启用状态,除非是超级管理员
        $myId = session('id');
        if($admin_id != $myId && $myId > 1) {
            return FALSE;
        }
        $AdminModel = new AdminModel;
        $info = $AdminModel->where('id','=',$admin_id)->find();
        // 判断如果当前是启用的就修改为禁用
        if($info['is_use'] == 1){
            $date['id'] = $admin_id;
            $date['is_use'] = 0;
            $AdminModel->update($date);
            echo json_encode(array("code" => 0));
        }else{
            $date['id'] = $admin_id;
            $date['is_use'] = 1;
            $AdminModel->update($date);
            echo json_encode(array("code" => 1));
        }

    }
    public function real(){
        $rnModel = new RealnameModel;
        $adminId = session('id');// 取出当前管理员的ID
        $rn = $rnModel->where('admin_id','=',$adminId)->find();
        if(Request::instance()->isPost()) {
            $date['admin_id'] =  Request::instance()->param('admin_id');
            $date['realname'] =  Request::instance()->param('realname');
            if(!empty($rn)){
                $rnModel->where('admin_id','=',$adminId)->delete();
            }
            $info = $rnModel->create($date);
            if($info){
                // $this->success('管理员实名成功','Index/index');
                $this->redirect('Index/index');
            }else{
                $this->error('管理员实名失败');
            }
        }
        $this->assign('rn',$rn);
        $this->assign('adminId',$adminId);
        return $this->fetch();
    }
    public function b_lst(){
        $adminId = session('id');
        $DanweiModel = new DanweiModel();
        $info = Db::table('ny_danwei')->where('sta=0')->paginate(10);
        // var_dump($info);
        $page = $info->render();
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('adminId',$adminId);
        return $this->fetch();
    }
    public function b_edit(){
        $id = Request::instance()->param('id');
        // 先判断是否有权修改
        $adminId = session('id');// 取出当前管理员的ID
        // 如果是普通管理员要修改其他管理员的信息提示无权
        if($adminId > 1 && $adminId != $id){

            $this->error('无权修改！');
        }
        if(Request::instance()->isPost()){
            $data['b_name'] = Request::instance()->param('b_name');
            $data['time'] = time();
            $DanweiModel = new DanweiModel();
            // var_dump($data);
            $res = $DanweiModel->where('id','=',$id)->update($data);
            // var_dump($res);
            if($res){
            $this->redirect('admin/b_lst');
             }else{
                $this->error('更新失败了');
             }
        }
        
        $info = Db::table('ny_danwei')->find($id);
        $this->assign('data',$info);
        return $this->fetch();
    }
    public function b_del(){
        $DanweiModel = new DanweiModel;
        $id= Request::instance()->param('id');
        $info = $DanweiModel->where('id','=',$id)->delete();
        if($info){
            // $this->success('删除管理员成功','Admin/lst');
            $this->redirect('Admin/b_lst');
        }else{
            $this->error('删除单位失败');
        }
    }
    public function b_add(){
        if(Request::instance()->isPost()){
             $adminId = session('id');
            $AdminModel = new AdminModel();
            $username  = $AdminModel->field('username')->where('id','=',$adminId)->find();
            // var_dump($username->username);exit;
            $data['b_name'] = Request::instance()->param('b_name');
            $data['input_name'] = $username->username;
            $data['time'] = time();
            $DanweiModel = new DanweiModel();
            $info = $DanweiModel->where('b_name','=',$data['b_name'])->find();
            if($info){
                $this->error('已经存在改单位了');
            }else{
                $res = $DanweiModel->save($data);
                if($res){
                    $this->redirect('admin/b_lst');
                }else{
                    $this->error('添加失败');
                }
            }
            
        }
        return $this->fetch();
    }
    public function company(){
        return $this->fetch();
    }
    public function add_com(){
        return $this->fetch();
    }
}