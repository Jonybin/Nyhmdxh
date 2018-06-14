<?php
namespace app\admin\model;
use think\Model;
use think\db;
use think\View;
use think\Paginate;
use app\admin\model\Information as InformationModel;
class Chuzi_tongji extends Model
{
    protected $table = 'ny_chuzi_tongji';
    // 设置数据表主键
    protected $pk    = 'id';

    //获取处置结果统计
    public function get_chuzhi_count($where){
        $mouth = intval(date('m',time()));
        $info = Db::view('chuzi_tongji', '*')
            ->view('information', 'information_id,danwei_geren,xinhui_fenlei,company_name,username', 'chuzi_tongji.info_id = information.information_id')
            ->view('admin',['id'=>'uid','username'=>'name','company'=>'company'],'chuzi_tongji.cz_id = admin.id')
            ->where('chuzi_tongji.chuzhi_mouth',$mouth)
            ->where($where)
            ->paginate(10);
        return $info;
    }


    //获取处置的我excle表信息
    public function get_chuzhi_excle($where){
        $mouth = intval(date('m',time()));
        $info = Db::view('chuzi_tongji', '*')
            ->view('information', 'information_id,danwei_geren,xinhui_fenlei,company_name,username', 'chuzi_tongji.info_id = information.information_id')
            ->view('admin',['id'=>'uid','username'=>'name'],'chuzi_tongji.cz_id = admin.id')
            ->where('chuzi_tongji.chuzhi_mouth',$mouth)
            ->where($where)
            ->select();
        return $info;
    }

    //获取处置信息列表
    public function get_cz_list($cz_id, $chuzhi_jieguo) {

        /*
        $informationModel = new InformationModel();
        $data = self::where('cz_id', $cz_id)
                ->where('chuzhi_jieguo',$chuzhi_jieguo)
                ->where('status_chaxun',1)
                ->column('info_id');

        dump($data);
        $list = $informationModel::all($data);
        foreach($list as $key => $vlaue) {
        }
        dump($list);

        */

       $data = Db::view('chuzi_tongji', 'info_id, cz_id, chuzhi_jieguo')
                    ->view('information', '*', 'information.information_id=chuzi_tongji.info_id')
                    ->where('status', '=', 1)
                    ->where('cz_id', '=', $cz_id)
                    ->where('chuzhi_jieguo', '=', $chuzhi_jieguo)
                    ->where('status_chaxun', '=', '1')
                    ->paginate(2);
        return $data;
    }
}