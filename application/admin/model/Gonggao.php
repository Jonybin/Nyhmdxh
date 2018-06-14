<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;
class Gonggao extends Model
{
    protected $table = 'ny_gonggao';
    // 设置数据表主键
    protected $pk = 'gg_id';

    //得到所有的通知公告信息
    public function get_all_gg(){
        $info = Db::table('ny_gonggao')
            ->order("gg_time desc")
            ->paginate(5);
        return $info;
    }
}