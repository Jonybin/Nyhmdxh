<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;
class Tongbao extends Model
{
    protected $table = 'ny_tongbao';
    // 设置数据表主键
    protected $pk = 'tb_id';

    //得到所有的通知公告信息
    public function get_all_tb(){
        $info = Db::table('ny_tongbao')
            ->order("tb_time desc")
            ->paginate(5);
        return $info;
    }
}