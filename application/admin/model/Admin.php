<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Admin_role as Admin_roleModel;
class Admin extends Model
{
    protected $table = 'ny_admin';
    // 设置数据表主键
    protected $pk    = 'id';


    //删除管理员
    public function before_delete($id)
    {
        $info = false;

        // 把这个管理员所拥有的角色的数据也一起删除
        $Admin_roleModel = new Admin_roleModel;
        $rp = $Admin_roleModel->where(array('admin_id'=>array('eq', $id)))->delete();
        if($rp){
            $info = true;
        }
        //删除角色
        $AdminModel = new AdminModel;
        $ro = $AdminModel->where(array('id'=>array('eq', $id)))->delete();
        if($ro){
            $info = true;
        }

        return $info;
    }


    //返回company
    public function company_name($where)
    {
        $data = self::where('id', '=', $where)
                ->select();
        return $data;

    }
}