<?php
namespace app\admin\model;
use think\Model;
use think\db;
use think\View;
use think\Paginate;
use app\admin\model\Chuzi_tongji as Chuzi_tongjiModel;
class Chuzi_tongjicount extends Model
{
    protected $table = 'ny_chuzi_tongjicount';
    // 设置数据表主键
    protected $pk    = 'id';

    public function __construct(){


    }
    //当是管理员打开页面时更新该表所有数据
    public function tongjicountUpdate() {
        $info = new Chuzi_tongjiModel();
        $dataObj = $info->where('status_chaxun', '=', 1)
                    ->order('cz_id','desc')
                    ->select();
        //将处置结果从对象转为数组
        $data = $this->obj_array($dataObj);
        // dump($data);
        Db::query('UPDATE ny_chuzi_tongjicount SET jieguo_count=0');
        foreach ($data as $data_key => $data_value) {
            $cz_id = $data_value['cz_id']; //获取该条信息的处置人员id
            $chuzhi_jieguo = $data_value['chuzhi_jieguo'];

            $countdata = self::where('cz_id', $cz_id)
                                ->where('chuzhi_jieguo', $chuzhi_jieguo)
                                ->select();
            $jieguo_count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();
            if (!empty($countdata)) {
                // $tongjicount = self::save(['jieguo_count' => 0]);
                //存在则更新
                $count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();
                $countdata_id = $countdata[0]['id'];
                $tongjicount = self::save(['jieguo_count' => $count],['id' => $countdata_id]);
            } else {

                //不存该统计则创建
                $jieguo_count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();


                $tongjicount = self::data([
                                'cz_id' => $cz_id,
                                'chuzhi_jieguo' => $chuzhi_jieguo,
                                'jieguo_count' => $jieguo_count
                                ])
                                ->isUpdate(false)
                                ->save();
            }

            // $countData = self::where('cz_id', $cz_id)

        }
    }

    //分局的数据(当是分局打开时，只更新该分局的数据)
    public function fenjuCount($where) {
        $info = new Chuzi_tongjiModel();
        $dataObj = $info->where('status_chaxun', '=', 1)
                    ->where($where)
                    ->order('cz_id','desc')
                    ->select();

        //将处置结果从对象转为数组
        $data = $this->obj_array($dataObj);
        Db::query('UPDATE ny_chuzi_tongjicount SET jieguo_count=0');
        foreach ($data as $data_key => $data_value) {
            $cz_id = $data_value['cz_id']; //获取该条信息的处置人员id
            $chuzhi_jieguo = $data_value['chuzhi_jieguo'];

            $countdata = self::where('cz_id', $cz_id)
                                ->where('chuzhi_jieguo', $chuzhi_jieguo)
                                ->select();
            $jieguo_count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();
            if (!empty($countdata)) {
                // $tongjicount = self::save(['jieguo_count' => 0]);
                //存在则更新
                $count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();
                $countdata_id = $countdata[0]['id'];
                $tongjicount = self::save(['jieguo_count' => $count],['id' => $countdata_id]);
            } else {

                //不存该统计则创建
                $jieguo_count = $info->where('cz_id', $cz_id)
                            ->where('chuzhi_jieguo', $chuzhi_jieguo)
                            ->where('status_chaxun', '=', 1)
                            ->count();


                $tongjicount = self::data([
                                'cz_id' => $cz_id,
                                'chuzhi_jieguo' => $chuzhi_jieguo,
                                'jieguo_count' => $jieguo_count
                                ])
                                ->isUpdate(false)
                                ->save();
            }
        }
    }
    //对象转数组
    public function obj_array($obj) {

        $data = array();
        foreach ($obj as $key => $value) {
            $data[$key] = $value->data;
        }
        return $data;
    }

    //查询输出
    public function get_chuzhi_count($where) {
        $data = array();
        $info = "";
        if ($where == 0) {
            $this->tongjicountUpdate();
            $info = self::order('cz_id', 'asc')
                    ->paginate(10);
        } else {
            $this->fenjuCount($where);
            $info = self::where($where)
              ->order('cz_id', 'asc')
              ->paginate(10);
        }

        return $info;
    }


    //导出Excel
    public function get_chuzhi_excle($where) {
        $data = array();
        $info = "";
        if ($where == 0) {
            $info = self::order('cz_id', 'asc')
                    ->select();
        } else {
            $info = self::where($where)
              ->order('cz_id', 'asc')
              ->select();
        }
        return $info;
    }

}









