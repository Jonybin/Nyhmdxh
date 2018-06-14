<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;

use app\admin\model\Privilege as PrivilegeModel;
use app\admin\model\Role_privilege as Role_privilegeModel;
use app\admin\model\Role as RoleModel;
use app\admin\model\Admin_role as Admin_roleModel;
class Role extends Model
{
    protected $table = 'ny_role';
    // 设置数据表主键
    protected $pk    = 'id';


    //视图查询角色权限表
    public function get_all_role(){
        $info = Db::view('role','id,role_name')
            ->view('role_privilege','pri_id,role_id','role_privilege.role_id=role.id')
            ->view('privilege','pri_name','role_privilege.pri_id=privilege.id')
            ->group('role.id')
            ->select();
        return $info;
    }


    //删除角色判断有没有管理员对应角色
    public function before_delete($id)
    {
        $info = false;
        // 先判断有没有管理员属性这个角色-要读管理员角色表
        $Admin_roleModel = new Admin_roleModel;
        $has = $Admin_roleModel->where(array('role_id'=>array('eq', $id)))->count();
        if($has > 0)
        {
            $this->error = '有管理员属于这个角色，无法删除！';
            return FALSE;
        }
        // 把这个角色所拥有的权限的数据也一起删除
        $Role_privilegeModel = new Role_privilegeModel;
        $rp = $Role_privilegeModel->where(array('role_id'=>array('eq', $id)))->delete();
        if($rp){
            $info = true;
        }
        //删除角色
        $RoleModel = new RoleModel;
        $ro = $RoleModel->where(array('id'=>array('eq', $id)))->delete();
        if($ro){
            $info = true;
        }

        return $info;
    }
}