<?php
namespace app\admin\model;

use think\Model;
use think\db;
use think\view;
use think\Paginator;

use app\admin\model\Admin as AdminModel;
use app\admin\model\Information as InformationModel;


class Info_tongji extends Model
{
    protected $table = 'ny_info_tongji';
    // 设置数据表主键
    protected $pk = 'tj_id';


    /**
     * [__construct description] 用来更新统计表
     */
    public function __construct() {
// echo '111';
        $company = AdminModel::where('admin_role',2)->column('Company','id');
        // $mouth = date('Y-m',time());
        foreach ($company as $key => $value) {
            //进行数量统计
            $geren = 0;  //个人
            $danwei = 0; //单位
            $xingwei = 0; //行贿行为
            $fanzui = 0; //行贿犯罪
            $count = 0;
            $info = InformationModel::where('input_name_id', $key)
                                    ->select();
            if($info){
                $time =time();
            }else{
                $time = 0;
            }
            // var_dump(date('Y-m',time()));exit;
            //对象转数组
            $data =  $this->object_to_array($info);
            // var_dump($data);
            foreach ($data as $data_key => $data_value) {
                $data = $data_value['data'];
                ($data['danwei_geren'] == 1) ? $geren++ : $danwei++ ;
                ($data['xinhui_fenlei'] == 0) ? $xingwei++ : $fanzui++ ;
                $count++;
            }
            //判断该单位否已经在表中，如果不存在返回值是空
            $exist = self::where('admin_id',$key)
                        ->select();
            //使用empty判空，已经存在的话就更新，不存在的话就创建
            if (!empty($exist)) {
                $array = [
                        'all_num' => $count,
                        'danwei_num' => $danwei,
                        'geren_num' => $geren,
                        'xingwei_num' => $xingwei,
                        'fanzui_num' => $fanzui,
                        'mouth' => $time,
                        'role_type' => '1',
                        ];
                self::save($array,['admin_id' => $key]);
            } else {
                $array = [
                        'admin_id' => $key,
                        'all_num' => $count,
                        'danwei_num' => $danwei,
                        'geren_num' => $geren,
                        'xingwei_num' => $xingwei,
                        'fanzui_num' => $fanzui,
                        'mouth' => $time,
                        'role_type' => 1
                        ];
                        $result = Db::table('ny_info_tongji')->insert($array);

            }

        }
    }


    /**
     * 对象转数组
     * object 转 array
     */
    function object_to_array($obj){
        $_arr=is_object($obj)?get_object_vars($obj):$obj;
        $arr = array();
        foreach($_arr as $key=>$val){
            $val=(is_array($val)) || is_object($val) ? $this->object_to_array($val) : $val;
            $arr[$key]=$val;
        }
        return $arr;
    }


    //向统计表里面插入记录
    /*
    *  废弃，因为只要访问Info_gongji模型类将会在构造方法中进行数据插入
    *
    public function add_num($adminId,$role_type,$danwei_geren,$xinhui_fenlei){
        $mouth = intval(date('m',time()));
        $info =Db::table('ny_info_tongji')
            ->where('admin_id',$adminId)
            ->where('role_type',$role_type)
            ->where('mouth',$mouth)
            ->count();
        if($info<1){
            $all_num= 1;
            $mouth=intval(date('m',time()));
            if($danwei_geren==0){
                $danwei_num= 1;
                $geren_num= 0;
            }else{
                $danwei_num= 0;
                $geren_num= 1;
            }
            if($xinhui_fenlei==0){
                $xingwei_num = 1;
                $fanzui_num = 0;
            }else{
                $fanzui_num = 1;
                $xingwei_num = 0;
            }
            $sql = 'INSERT INTO `ny_info_tongji`( `admin_id`, `all_num`, `danwei_num`, `geren_num`, `xingwei_num`, `fanzui_num`, `mouth`, `role_type`) VALUES ('.$adminId.','.$all_num.','.$danwei_num.','.$geren_num.','.$xingwei_num.','.$fanzui_num.','.$mouth.','.$role_type.')';
            Db::query($sql);
        }else{
            $infos =Db::table('ny_info_tongji')
                ->where('admin_id',$adminId)
                ->where('mouth',$mouth)
                ->find();
            $tj_id = $infos['tj_id'];
            $all_num= $infos['all_num']+1;
            $mouth=$infos['mouth'];
            $role_type = $infos['role_type'];
            if($danwei_geren==0){
                $danwei_num= $infos['danwei_num']+1;
                $geren_num= $infos['geren_num'];
            }else{
                $danwei_num= $infos['danwei_num'];
                $geren_num= $infos['geren_num']+1;
            }
            if($xinhui_fenlei==0){
                $xingwei_num = $infos['xingwei_num']+1;
                $fanzui_num = $infos['fanzui_num'];
            }else{
                $fanzui_num = $infos['fanzui_num']+1;
                $xingwei_num = $infos['xingwei_num'];
            }
            $sql="UPDATE `ny_info_tongji` SET `all_num`=$all_num,`danwei_num`=$danwei_num,`geren_num`=$geren_num,`xingwei_num`=$xingwei_num,`fanzui_num`=$fanzui_num,`mouth`=$mouth,`role_type`=$role_type WHERE `tj_id`=$tj_id";
            Db::query($sql);
        }
    }
    */


    //向统计表里减一条数据
    public function del_num($adminId,$role_type,$danwei_geren,$xinhui_fenlei,$mouth){
        $infos =Db::table('ny_info_tongji')
            ->where('admin_id',$adminId)
            ->where('mouth',$mouth)
            ->where('role_type',$role_type)
            ->find();
        $tj_id = $infos['tj_id'];
        $all_num= $infos['all_num']-1;
        $mouth=$infos['mouth'];
        $role_type = $infos['role_type'];
        if($danwei_geren==0){
            $danwei_num= $infos['danwei_num']-1;
            $geren_num= $infos['geren_num'];
        }else{
            $danwei_num= $infos['danwei_num'];
            $geren_num= $infos['geren_num']-1;
        }
        if($xinhui_fenlei==0){
            $xingwei_num = $infos['xingwei_num']-1;
            $fanzui_num = $infos['fanzui_num'];
        }else{
            $fanzui_num = $infos['fanzui_num']-1;
            $xingwei_num = $infos['xingwei_num'];
        }
        $sql="UPDATE `ny_info_tongji` SET `all_num`=$all_num,`danwei_num`=$danwei_num,`geren_num`=$geren_num,`xingwei_num`=$xingwei_num,`fanzui_num`=$fanzui_num,`mouth`=$mouth,`role_type`=$role_type WHERE `tj_id`=$tj_id";
        Db::query($sql);
    }



    //超级管理员查询数量的统计
    public function get_chaxun_count($where){
        $mouth = intval(date('m',time()));
        $info = Db::view('info_tongji', '*')
            ->view('chaxun', 'cx_username,chaxun_id', 'info_tongji.admin_id = chaxun.chaxun_id')
            ->view('admin','id,Company','info_tongji.admin_id = admin.id')
            ->where('role_type','0')
            ->where('mouth',$mouth)
            ->where($where)
            ->group('info_tongji.admin_id')
            ->paginate(10);
        return $info;
    }


    //获取Excel表的内容
    public function get_chaxun_excle($where){
        $mouth = intval(date('m',time()));
        $info = Db::view('info_tongji', '*')
            ->view('chaxun', 'cx_username,chaxun_id', 'info_tongji.admin_id = chaxun.chaxun_id')
            ->view('admin','id,Company','info_tongji.admin_id = admin.id')
            ->where('role_type','0')
            ->where('mouth',$mouth)
            ->where($where)
            ->group('info_tongji.admin_id')
            ->select();
        return $info;
    }
    //判断属于哪个部门（纪检委，法院，公安，检察院）
    public function get_c_lr($str){
        $res = '';
        if(strpos($str,'纪检委')){
            $res = '纪检委';
        }
        if(strpos($str,'法院')){
            $res = '法院';
        }
        if (strpos($str,'公安')) {
            $res = '公安';
        }
        if (strpos($str,'检察院')) {
            $res = '检察院';
        }
        return $res;
    }

   //录入数量的统计
    public function get_luru_count($where){
        $mouth = intval(date('m',time()));
		if(!empty($where) || $where =='0'){
			$info = '';
			if ($where == 0) {
			$info = self::where('role_type',1)
					->order('admin_id','desc')
					->paginate(10);
			} else {

			$info = self::where('role_type',1)
					->where('admin_id','=',$where)
					->order('admin_id','desc')
					->paginate(10);
			}
			$info2 = json_decode($info)->data;
			$info2 =  $this->object_to_array($info2);
			foreach ($info2 as $key => $value) {
				$company = AdminModel::where('id',$value['admin_id'])->value('username');
				$info2[$key]['Company'] = $company;
			}
			$info = [$info,$info2];
			return $info;
		}
		return [[], []];
        
    }
    //录入统计的excle表
    public function get_luru_excle($where){
        $mouth = intval(date('m',time()));

        $info = '';
        if ($where) {
        $info = self::where('role_type',1)
                ->order('admin_id','desc')
                ->select();
        } else {
        $info = self::where('role_type',1)
                ->where('admin_id',$where)
                ->order('admin_id','desc')
                ->select();
        }

        foreach ($info as $key => $value) {
            $company = AdminModel::where('id',$value['admin_id'])->value('username');
            $info[$key]['Company'] = $company;
        }

        return $info;
    }


    //查询统计详情
    public function get_cx_xiang($id,$mouth){
        $info = Db::view('chaxun', '*')
            ->view('information', '*', 'chaxun.info_id=information.information_id')
            ->where('chaxun.chaxun_id',$id)
            ->where('chaxun.chaxun_mouth',$mouth)
            ->paginate(10);
        return $info;
    }

    public function aaaa(){
        dump("调用的方法");
    }

}