<?php
namespace app\admin\controller;

use think\Controller;
use think\Session;
use think\Db;
use think\Request;
use app\admin\model\Realname as RealnameModel;
class Index extends Controller
{
    /*构造函数*/
    public function __construct()
    {
        // 先调用父类的构造函数
        parent::__construct();
        // 获取当前管理员的ID
        $adminId = session('id');

        // 验证登录
        if(!$adminId) {
            $url = "/index.php/admin/Login/Login";
            $this->redirect($url);
        }
        // 验证当前管理员是否有权限访问这个页面
        // 1. 先获取当前管理员将要访问的页面	 - TP带三个常量
        $request = Request::instance();
        // 查询数据库判断当前管理员有没有访问这个页面的权限
        $where = 'module_name="'.$request->module().'" AND controller_name="'.$request->controller().'" AND action_name="'.$request->action().'"';

        // 任何人只要登录了就可以进入后台
       if($request->controller() == 'Index') {
           return TRUE;
       }
        if($adminId == 1)
            $sql = 'SELECT COUNT(*) has FROM ny_privilege WHERE '.$where;
        else
            $sql = 'SELECT COUNT(a.role_id) has
			  FROM ny_role_privilege a
			   LEFT JOIN ny_privilege b ON a.pri_id=b.id
			   LEFT JOIN ny_admin_role c ON a.role_id=c.role_id
			    WHERE c.admin_id='.$adminId.' AND '.$where;


        $pri = Db::query($sql);
        if($pri[0]['has'] < 1)
            $this->error('无权访问！');

    }

    public function index()
    {

        return $this->fetch();
    }
    public function top()
    {
        return $this->fetch();
    }

    public function main(){
        $ip = getIP();
        $this->assign('ip',$ip);
        return $this->fetch();
    }

    public function menu(){
        $adminId = session('id');
        //取出当前管理员所拥有的前两级的权限
        // 取出当前管理员所有的权限
        if($adminId == 1)//为1的时候，是root用户
            $sql = 'SELECT * FROM ny_privilege where pri_name!="行贿信息管理" AND pri_name!="公告通报管理" AND pri_name!="修改密码" AND pri_name!="信息统计" AND pri_name!="(市)录入监管"  AND pri_name!="(市)查询监管"';
        else
            $sql = 'SELECT b.*
			  FROM ny_role_privilege a
			   LEFT JOIN ny_privilege b ON a.pri_id=b.id
			   LEFT JOIN ny_admin_role c ON a.role_id=c.role_id
			    WHERE c.admin_id='.$adminId;
        $pri = Db::query($sql);
        $btn = array();  // 放前两级的权限
        // 从所有的权限中取出前两级的权限
        // var_dump($pri);exit;
        foreach ($pri as $k => $v)
        {
            // 找顶级权限
            if($v['parent_id'] == 0)
            {
                // var_dump($v);
                // 再循环把这个顶级权限的子权限
                foreach ($pri as $k1 => $v1)
                {
                    if($v1['parent_id'] == $v['id'])
                    {
                        $v['children'][] = $v1;


                    }
                }
                $btn[] = $v;
            }
        }
        // foreach ($btn as $key => $value) {
        //     var_dump($value);
        // }exit;
        // var_dump($btn);
        $this->assign('btn', $btn);
        return $this->fetch();
    }
}
?>