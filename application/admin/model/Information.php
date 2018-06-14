<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;

use app\admin\model\Information as InformationModel;
use app\admin\model\Examine as ExamineModel;
use app\admin\model\Realname as RealnameModel;

class Information extends Model
{
    protected $table = 'ny_information';
    // 设置数据表主键
    protected $pk    = 'information_id';

    //录入人员查询自己录入信息的详细信息
    public function get_info($information_id,$adminId){
        $info =Db::table('ny_information')
            ->where('information_id',$information_id)
            ->where('input_name_id',$adminId)
            ->find();
        return $info;
    }

    //查询人员查询信息的详细信息
    public function get_info_xiang($information_id){
        $info =Db::table('ny_information')
            ->where('information_id',$information_id)
            ->find();
        return $info;
    }

    //录入的信息列表
    public function get_all_info($where){
        $info = Db::table('ny_information')
           ->where($where)
            ->order("input_time desc")
            ->paginate(5);
        return $info;
    }

    //所有人录入的信息列表
    public function get_allpeople_info(){
        $info = Db::table('ny_information')
            ->order("input_time desc")
            ->paginate(13);
        return $info;
    }
    //异议复核信息列表
    public function get_all_yihe($adminId){
        $info = Db::view('information', 'information_id,username,company_name,danwei_geren')
            ->view('edit_del', '*', 'information.information_id = edit_del.info_id')
            ->where('information.input_name_id', $adminId)
            ->order("edit_del.sq_time desc")
            ->paginate(5);
        return $info;
    }
    //修改与删除列表
    public function get_all_editdel($adminId){
        $info = Db::view('edit_del', '*')
            ->view('information', 'information_id,username,company_name,danwei_geren', 'edit_del.info_id = information.information_id')->where('shenhe_status','1')
            ->where('edit_del.root_id', $adminId)
            ->order("edit_del.sq_time desc")
            ->paginate(5);
        return $info;
    }
    //审核修改与删除列表
    public function get_all_shenhe_editdel($adminId){
        $info = Db::view('edit_del', '*')
            ->view('information', 'information_id,username,company_name,danwei_geren', 'edit_del.info_id = information.information_id')->where('shenhe_status','0')
            ->where('edit_del.shenhe_id', $adminId)
            ->order("edit_del.sq_time desc")
            ->paginate(5);;
        return $info;
    }

    //得到所有的申请查询的信息
    public function get_all_sqchaxun($admin)
    {
        /*$sql ='select a.*,b.* from ny_information as a left join ny_chaxun as b on a.information_id = b.info_id where b.chaxun_id='.$admin;
        $info = Db::query($sql);*/
        $info = Db::view('information', '*')
            ->view('chaxun', '*', 'information.information_id = chaxun.info_id')
            ->where('chaxun.chaxun_id', $admin)
            ->order("chaxun.chaxun_time desc")
            ->paginate(5);
        return $info;
    }
    //查询出处置申请的列表
    public function get_all_czlst($admin){
        $info = Db::view('information', '*')
            ->view('chuzi_tongji', '*', 'information.information_id = chuzi_tongji.info_id')
            ->where('chuzi_tongji.cz_id', $admin)
            ->order("chuzi_tongji.chuzhi_time desc")
            ->paginate(5);

        return $info;
    }

    //审核处置申请的列表数据
    public function get_all_shcz($admin){
        $info = Db::view('information', '*')
            ->view('chuzi_tongji', '*', 'information.information_id = chuzi_tongji.info_id')
            ->where('chuzi_tongji.sh_id', $admin)
            ->order("chuzi_tongji.chuzhi_time desc")
            ->paginate(10);
        return $info;
    }

    //得到所有的申请查询审核的信息
    public function get_all_shchaxun($admin){
        $info = Db::view('information','*')
            ->view('chaxun','*','information.information_id = chaxun.info_id')
            ->where('chaxun.shenghe_id',$admin)
            -> order("chaxun.chaxun_time desc")
            ->paginate(5);
        return $info;
    }

    //获取处置信息详情
    public function get_cz_xiang($id){
        $info = Db::view('information','*')
            ->view('chuzi_tongji','*','information.information_id = chuzi_tongji.info_id')
            ->where('chuzi_tongji.id',$id)
            ->find();
        return $info;
    }


}

// SELECT ny_information.* ny_chuzi_tongji.chuzhi_jieguo FROM ny_information
