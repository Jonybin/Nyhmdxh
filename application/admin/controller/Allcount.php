<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;
use app\admin\model\Info_tongji as info_tjModel;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Chuzi_tongji as Chuzi_tongjiModel;
use app\admin\model\Information as InfoModel;
use app\admin\model\Chuzi_tongjicount as Chuzi_tongjicountModel;
use app\admin\controller\Index;
class Allcount extends Index
{
    public $export_diqu='';
    public $export_danwei='';
    public $export_all='';
    public $infos='';
    public $finds='';
    public $data = array();
    public $adminId='';
    public $Company='';
    public $job='';
    public $danwei='';
    public $diqu='';
    public $sta_t='';
    public $end_t='';
    public $ad_info=array();
    public $end='';
    public $start='';
    public $mouth;
    public $keyword='';
    public $eachPage='10';
    public $page='';//分页代码

    //查询统计
    public function dw_dq_find()
    {
        $this->assign('c_danwei',$this->danwei);
        $this->assign('c_diqu',$this->diqu);
        $this->dws = Db::table('ny_c_dw')->field('b_name')->select();
        $this->diqu = Db::table('ny_c_diqu')->field('b_name')->select();
        $this->assign('diqu',$this->diqu);
        $this->assign('danwei',$this->dws);
        $this->assign('page_row',$this->eachPage);
        $this->assign('sta_t',$this->sta_t);
        $this->assign('end_t',$this->end_t);
        $this->assign('info',$this->data);
        // Session::set('chaxun_ex','');
        // Session::set('chaxun_ex',$this->data);
        //分页
        $this->page = $this->finds->render();
        $this->assign('page', $this->page);
        //获取当前月
        $this->mouth = intval(date('m',time()));
        $this->assign('mouth',$this->mouth);
    }
    protected function Get_user()
    {
        $this->adminId = session('id');
        $this->Company = session('company');
        $info_tjModel = new info_tjModel;
        $this->job = $info_tjModel->get_c_lr($this->Company);
        $AdminModel = new AdminModel();
        $this->ad_info = $AdminModel->where('id','=',$this->adminId)->find();
        
    }
    protected function Get_search()
    {
        $this->eachPage =Request::instance()->param('tsize');
        $this->danwei = Request::instance()->param('danwei');
        $this->diqu = Request::instance()->param('diqu');
        $this->sta_t = Request::instance()->param('xinhui_time');
        $this->end_t = Request::instance()->param('xinhui_time2');
        $this->keyword = Request::instance()->param('keyword');
        $this->eachPage = Request::instance()->param('tsize');
        if(empty($this->eachPage))$this->eachPage=10;
        $this->start = strtotime($this->sta_t);
        $this->end = strtotime($this->end_t);
       if(empty($this->end_t))
            {
                $this->end= time();
            }else{
                $this->end = strtotime($this->end_t);
            }
        
    }
    public function cx_count(){
        $this->Get_user();
        $this->Get_search();
        if ($this->ad_info['admin_role'] == 0) {//判断是否为超级管理员
            $danwei_s = $this->diqu.$this->danwei;
            $this->finds = Db::table('ny_c_cx')->alias('a')->field('a.id,a.adminId,finds,keyword,find_time,username')->join('ny_admin b','a.adminId=b.id')->where('a.keyword|b.username','like','%'.$this->keyword.'%')->where('b.username','like','%'.$danwei_s.'%')->paginate($this->eachPage,false,['query'=>request()->param()]);
            $exp_finds = Db::table('ny_c_cx')->alias('a')->field('a.id,a.adminId,finds,keyword,find_time,username')->join('ny_admin b','a.adminId=b.id')->where('a.keyword|b.username','like','%'.$this->keyword.'%')->where('b.username','like','%'.$danwei_s.'%')->select();
            Session::set('cx_export_infos','');
            Session::set('cx_export_infos',$exp_finds);
        }else{
            $this->danwei = '';
            $danwei_s = $this->diqu;
            $this->finds = Db::table('ny_c_cx')->alias('a')->field('a.id,a.adminId,finds,keyword,find_time,username')->join('ny_admin b','a.adminId=b.id')->where('a.keyword|b.username','like','%'.$this->keyword.'%')->where('b.username','like','%'.$this->job.'%')->where('b.username','like','%'.$danwei_s.'%')->paginate($this->eachPage,false,['query'=>request()->param()]);
            $exp_finds = Db::table('ny_c_cx')->alias('a')->field('a.id,a.adminId,finds,keyword,find_time,username')->join('ny_admin b','a.adminId=b.id')->where('a.keyword|b.username','like','%'.$this->keyword.'%')->where('b.username','like','%'.$this->job.'%')->where('b.username','like','%'.$danwei_s.'%')->select();
            Session::set('cx_export_infos','');
            Session::set('cx_export_infos',$exp_finds);
        }
        foreach ($this->finds as $key => $value) {
            $res = Db::table('ny_c_chuzhi')->where('chaxun_id',$value['id'])->select();
            $this->data[$key]['chuzhi_num'] = count($res);
            $this->data[$key]['username'] = $value['username'];
            $this->data[$key]['id'] = $value['id'];
            $this->data[$key]['keyword']= $value['keyword'];
            $this->data[$key]['find_num'] = count(explode(',',$value['finds']));
            $this->data[$key]['find_time'] = date('Y-m-h H:i:s',$value['find_time']);
        }
        $this->dw_dq_find();
        // $this->assign('info',$this->data);
        Session::set('chaxun_ex','');
        Session::set('chaxun_ex',$this->data);
        //获取当前月
        return $this->fetch();
    }
    public function cx_sq_chuzhi(){
        $chaxun_id = Request::instance()->param('id');
        $res = Db::table('ny_c_chuzhi')->where('chaxun_id',$chaxun_id)->paginate(8,false,['query'=>request()->param()]);
        $page = $res->render();
        $this->assign('info',$res);
        $this->assign('page',$page);
        return $this->fetch();
    }

    //导出查询Excel表
    public function export_cx(){
        $e_finds= session('cx_export_infos');
        foreach ($e_finds as $key => $value) {
            $res = Db::table('ny_c_chuzhi')->where('chaxun_id',$value['id'])->select();
            $data[$key]['username'] = $value['username'];
            $data[$key]['chuzhi_num'] = count($res);
            $data[$key]['keyword']= $value['keyword'];
            $data[$key]['find_num'] = count(explode(',',$value['finds']));
            $data[$key]['find_time'] = date('Y-m-h H:i:s',$value['find_time']);
        }
        $table_arr = array ('A' => '查询单位', 'B' => '处置数量', 'C' => '查询关键词	', 'D' => '查找结果数量', 'E' => '查找查询时间');
        $this->up_out( $data, $table_arr );
    }


    public function cx_count_xiang(){
        $id = Request::instance()->param('id');
        $info  = Db::table('ny_information')->alias('a')->join('ny_chuzi_tongji b','a.information_id = b.info_id')->where('b.info_id',$id)->find();
        $qishi_time = $info['input_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);
        // var_dump($info);
        // $mouth = date("m",time());
        // $Info_tongji = new info_tjModel;
        // $info = $Info_tongji->get_cx_xiang($id,$mouth);
        // 获取分页显示
        // $page = $finds->render();
        // 模板变量赋值
        $this->assign('info', $info);
        // $this->assign('page', $page);
        return $this->fetch();
    }
    //查询监管横向所有单位的查询统计
    //纪检委具有县级查询监管
    public function cx_num(){
        $company = session('company');
        $dw= explode('纪检委', $company);
        $dw_n= $dw[0];
        if(Request::instance()->param('time')){
            $danwei = Request::instance()->param('danwei');
            $time = Request::instance()->param('time');
            $time2 = Request::instance()->param('time2');
            $start = strtotime($time);
            $end = strtotime($time2);
            $this->assign('sta_t',$time);
            $this->assign('end_t',$time2);
            $finds = Db::table('ny_c_cx')->alias('a')->field(['a.id','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time','username'])->join('ny_admin b','a.adminId=b.id')->where('find_time',['>=',$start],['<=',$end])->where('username','like','%'.$danwei.'%')->where('username','like','%'.$dw_n.'%')->group('username')->order('find_time')->paginate(15,false,['query'=>request()->param()]);
        }else{
            $finds = Db::table('ny_c_cx')->alias('a')->field(['a.id','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time','username'])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$dw_n.'%')->group('username')->order('find_time')->paginate(15,false,['query'=>request()->param()]);
        }
        $page = $finds->render();
        $data=array();
        foreach ($finds as $key => $value) {
            
            $arr =explode(',', $value['chaxun_id']);
            $chuzhi_num =0;
            $nofind_num = 0;
            $chuzhi_a=array();
            $chuzhi_i='';
            foreach ($arr as $key => $val) {
                $res = Db::table('ny_c_cx')->field('finds')->where('id',$val)->find();
                if(empty($res['finds']) ||$res['finds'] ==null){
                    $nofind_num+=1;
                }
                $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$val)->find();
                if(!empty($find) ||!$find ==null){
                    $chuzhi_num+=1;
                    $chuzhi_a[]=$val;//取得有处置的id结果的
                }
            }
            $data[$key]['username']=$value['username'];
            $data[$key]['chuzhi_num']=$chuzhi_num;
            $data[$key]['find_num']=$value['a_num'];
            $data[$key]['find_re_num']= $value['a_num']-$nofind_num;
            foreach ($chuzhi_a as $k => $v) {
                $chuzhi_i = $v.'_'.$chuzhi_i;
            }
            $data[$key]['chuzhi_ids']=$chuzhi_i;
            $data[$key]['sta_time']=date('Y-m-j',$value['sta_time']);
            $data[$key]['end_time']=date('Y-m-j',$value['end_time']);
        }
        $dws = Db::table('ny_danwei')->field('b_name')->where('b_name','like','%'.$dw_n.'%')->where('sta','=',0)->select();
        $this->assign('data',$dws);
        $this->assign('info',$data);
        $this->assign('page',$page);
        return $this->fetch();
    }
    //县级（横向）查询统计的详情方法
    public function cx_num_chuzhi(){
        $cha_id = Request::instance()->param('id');
        if($cha_id){
            $cha_id = rtrim($cha_id,'_');
            $arr = explode('_', $cha_id);
            foreach ($arr as $key => $value) {
                $info[$key] = Db::table('ny_c_chuzhi')->alias('a')->field('inf_id,sq_name,cz_res,cz_time,keyword,finds,find_time,username')->join('ny_c_cx b','a.chaxun_id = b.id')->join('ny_admin c','c.id=b.adminId')->where('chaxun_id',$value)->find();
            }
            foreach ($info as $k => $val) {
                $info[$k]['finds']=count(explode(',', $val['finds']));
            }
        }else{
            $info =[];
        }
        
        $this->assign('info',$info);
        $this->assign('page','');
        return $this->fetch();
    }
    //查询监管(市)纵向所有单位的查询情况统计
    public function cx_xji_num(){
        $adminId = session('id');
        //判断是否为超
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $all_fos = array();
        $eachPage =Request::instance()->param('tsize');
        $danwei = Request::instance()->param('danwei');
        $diqu = Request::instance()->param('diqu');
        $danwei_s='';
        $sta_t = Request::instance()->param('xinhui_time');
        $end_t = Request::instance()->param('xinhui_time2');
        $start = strtotime($sta_t);
        $end = strtotime($end_t);
        if(empty($end_t))
            {
                $end= time();
            }else{
                $end = strtotime($end_t);
            }
        $this->assign('sta_t',$sta_t);
        $this->assign('end_t',$end_t);
        if(empty($eachPage))$eachPage=10;
        Session::set('export_cx_end','');
        Session::set('export_cx_end',$end);
        Session::set('export_cx_start','');
        Session::set('export_cx_start',$start);//导出表格时间缓存
            // $danwei = 1;//不是超管，前台不显示单位信息
            // $Company = session('company');
            // $job = $info_tjModel->get_c_lr($Company);
            // $danwei_s = $diqu;
            // $all_fos = Db::table('ny_danwei')->where('b_name','like','%'.$job.'%')->where('b_name','like','%'.$danwei_s.'%')->paginate($eachPage,false,['query'=>request()->param()]);
        if($diqu == 1){
            $all_fos = Db::table('ny_c_diqu')->paginate($eachPage,false,['query'=>request()->param()]);
            $e_fos = Db::table('ny_c_diqu')->select();
            Session::set('export_cx_all_fos','');
            Session::set('export_cx_all_fos',$e_fos);//地区，为了导出录入的Excel
        }elseif($danwei == 2){
            $all_fos = Db::table('ny_c_dw')->paginate($eachPage,false,['query'=>request()->param()]);
            $e_fos = Db::table('ny_c_dw')->select();
            Session::set('export_cx_all_fos','');
            Session::set('export_cx_all_fos',$e_fos);//地区，为了导出录入的Excel
        }else{
            $danwei_s = $diqu.$danwei;
            Session::set('export_cx_danwei_s','');
            Session::set('export_cx_danwei_s',$danwei_s);
            $finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->join('ny_admin b','a.adminId=b.id')->where('find_time',['>=',$start],['<=',$end])->where('username','like','%'.$danwei_s.'%')->group('username')->order('find_time')->paginate($eachPage,false,['query'=>request()->param()]);
            $cx_finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->join('ny_admin b','a.adminId=b.id')->where('find_time',['>=',$start],['<=',$end])->where('username','like','%'.$danwei_s.'%')->group('username')->order('find_time')->select();
            Session::set('export_cx_finds','');
            Session::set('export_cx_finds',$cx_finds);//地区，为了导出录入的Excel
            $page = $finds->render();
        }
        //这里判断是否是检索总体数据
        if($all_fos){//是
            $page = $all_fos->render();
            $i = 0;
            foreach ($all_fos as $k => $val) {  
                $finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->where('find_time',['>=',$start],['<=',$end])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$val['b_name'].'%')->group('username')->order('find_time')->paginate($eachPage,false,['query'=>request()->param()]);
            // var_dump($finds);
                $chuzhi_num =0;
                $nofind_num = 0;
                $a_num = 0;
                $chuzhi_a=array();
                $chuzhi_i='';
                foreach ($finds as $key => $value) {
                    $chuzhi_a =array();
                    $arr =explode(',', $value['chaxun_id']);
                    foreach ($arr as $key => $a_val) {
                        $res = Db::table('ny_c_cx')->field('finds')->where('id',$a_val)->find();
                        if(empty($res['finds']) ||$res['finds'] ==null){
                            $nofind_num+=1;
                            // $no_find+=1;//总的没有结果的次数
                            }
                        $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$a_val)->find();
                        if(!empty($find) ||$find !=null){
                            $chuzhi_num+=1;
                            // $chuzhi_all_num+=1;//取得查询处置次数
                            $chuzhi_a[]=$a_val;//取得有处置的id结果的
                            }
                    }
                    foreach ($chuzhi_a as $k => $v) {
                        $chuzhi_i = $v.'_'.$chuzhi_i;
                    }
                    $a_num +=$value['a_num'];
                    // $all_num+=$value['a_num'];//统计总的查询次数
                }
                $data[$i]['username'] = $val['b_name'];
                $data[$i]['chuzhi_num'] = $chuzhi_num;//处置数
                $data[$i]['chuzhi_ids'] = $chuzhi_i;
                $data[$i]['find_num'] = $a_num;//总数
                $data[$i]['find_re_num'] = $a_num - $nofind_num;
                $i++;
            
                }
        }else{//不是的话
             $data=array();
            foreach ($finds as $key => $value) {
                $arr =explode(',', $value['chaxun_id']);
                $chuzhi_num =0;
                $nofind_num = 0;
                $chuzhi_a=array();
                $chuzhi_i='';
                foreach ($arr as $key => $val) {
                    $res = Db::table('ny_c_cx')->field('finds')->where('id',$val)->find();
                    if(empty($res['finds']) ||$res['finds'] ==null){
                        $nofind_num+=1;
                    }
                    $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$val)->find();
                    if(!empty($find) ||!$find ==null){
                        $chuzhi_num+=1;
                        $chuzhi_a[]=$val;//取得有处置的id结果的
                    }
                }
                $data[$key]['username']=$value['username'];
                $data[$key]['chuzhi_num']=$chuzhi_num;
                $data[$key]['find_num']=$value['a_num'];
                $data[$key]['find_re_num']= $value['a_num']-$nofind_num;
                foreach ($chuzhi_a as $k => $v) {
                    $chuzhi_i = $v.'_'.$chuzhi_i;
                }
                $data[$key]['chuzhi_ids']=$chuzhi_i;
            }
        }
        ///z总计统计
        $all_num = 0;
        $re_num = 0;
        $no_find  = 0;
        $chuzhi_all_num = 0;
        $fin_num_all = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->where('find_time',['>=',$start],['<=',$end])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$danwei_s.'%')->group('username')->order('find_time')->select();
        foreach ($fin_num_all as $key => $value) {
            $arr =explode(',', $value['chaxun_id']);
            foreach ($arr as $key => $val) {
                    $res = Db::table('ny_c_cx')->field('finds')->where('id',$val)->find();
                    if(empty($res['finds']) ||$res['finds'] ==null){
                        $no_find+=1;//总的没有结果的次数
                    }
                    $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$val)->find();
                    if(!empty($find) ||!$find ==null){
                        $chuzhi_all_num+=1;
                    }
                }
            $all_num +=$value['a_num'];

        }
        $re_num = $all_num - $no_find;
        // $all_num = 0;
        // $re_num = 0;
        // $chuzhi_num = 0;
        // foreach ($data as $k_n => $v_n) {
        //     $all_num += $v_n['find_num'];
        //     $re_num += $v_n['find_re_num'];
        //     $chuzhi_num += $v_n['chuzhi_num'];
        // }
        // Session::set('cx_xji_num','');
        // Session::set('cx_xji_num',$data);
        $this->assign('c_danwei',$danwei);
        $this->assign('chuzhi_num',$chuzhi_all_num);
        $this->assign('all_num',$all_num);
        $this->assign('re_num',$re_num);
        $this->assign('c_diqu',$diqu);
        $dws = Db::table('ny_c_dw')->field('b_name')->order('id')->select();
        $diqu = Db::table('ny_c_diqu')->field('b_name')->order('id')->select();
        $this->assign('diqu',$diqu);
        $this->assign('danwei',$dws);
        $this->assign('info',$data);
        $this->assign('page',$page);
        $this->assign('page_row',$eachPage);
        return $this->fetch();
    }
    public function export_cx_xji_num(){
        $end = session('export_cx_end');
        $start = session('export_cx_start');
        $danwei_s = session('export_cx_danwei_s');
        $finds = session('export_cx_finds');
        $all_fos = session('export_cx_all_fos');
        if(empty($finds) && empty($all_fos))return $this->error('操作错误'); 
        // if($export_diqu){
        //     $infos = Db::table('ny_c_diqu')->select();
        // }elseif ($export_danwei) {
        //     $infos = Db::table('ny_c_dw')->select();
        // }elseif($export_all){
        //     $finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->join('ny_admin b','a.adminId=b.id')->group('username')->order('find_time')->select();
        // }else{
        //     return $this->error('操作错误');
        // }
        //这里判断是否是检索总体数据
        if($all_fos){//是
            $i = 0;
            foreach ($infos as $k => $val) {  
                $finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->where('find_time',['>=',$start],['<=',$end])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$val['b_name'].'%')->group('username')->order('find_time')->select();
            // var_dump($finds);
                $chuzhi_num =0;
                $nofind_num = 0;
                $a_num = 0;
                $chuzhi_a=array();
                $chuzhi_i='';
                foreach ($finds as $key => $value) {
                    $chuzhi_a =array();
                    $arr =explode(',', $value['chaxun_id']);
                    foreach ($arr as $key => $a_val) {
                        $res = Db::table('ny_c_cx')->field('finds')->where('id',$a_val)->find();
                        if(empty($res['finds']) ||$res['finds'] ==null){
                            $nofind_num+=1;
                            // $no_find+=1;//总的没有结果的次数
                            }
                        $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$a_val)->find();
                        if(!empty($find) ||$find !=null){
                            $chuzhi_num+=1;
                            // $chuzhi_all_num+=1;//取得查询处置次数
                            $chuzhi_a[]=$a_val;//取得有处置的id结果的
                            }
                    }
                    foreach ($chuzhi_a as $k => $v) {
                        $chuzhi_i = $v.'_'.$chuzhi_i;
                    }
                    $a_num +=$value['a_num'];
                    // $all_num+=$value['a_num'];//统计总的查询次数
                }
                $data[$i]['username'] = $val['b_name'];
                $data[$i]['chuzhi_num'] = $chuzhi_num;//处置数
                $data[$i]['chuzhi_ids'] = $chuzhi_i;
                $data[$i]['find_num'] = $a_num;//总数
                $data[$i]['find_re_num'] = $a_num - $nofind_num;
                $i++;
            
                }
        }else{//不是的话
             $data=array();
             $j = 0;
            foreach ($finds as $key => $value) {
                $arr =explode(',', $value['chaxun_id']);
                $chuzhi_num =0;
                $nofind_num = 0;
                $chuzhi_a=array();
                $chuzhi_i='';
                foreach ($arr as $key => $val) {
                    $res = Db::table('ny_c_cx')->field('finds')->where('id',$val)->find();
                    if(empty($res['finds']) ||$res['finds'] ==null){
                        $nofind_num+=1;
                    }
                    $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$val)->find();
                    if(!empty($find) ||!$find ==null){
                        $chuzhi_num+=1;
                        $chuzhi_a[]=$val;//取得有处置的id结果的
                    }
                }
                $data[$j]['username']=$value['username'];
                $data[$j]['chuzhi_num']=$chuzhi_num;
                $data[$j]['find_num']=$value['a_num'];
                $data[$j]['find_re_num']= $value['a_num']-$nofind_num;
                $j++;
            }
        }
        ///z总计统计
        $all_num = 0;
        $re_num = 0;
        $no_find  = 0;
        $chuzhi_all_num = 0;
        $fin_num_all = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->where('find_time',['>=',$start],['<=',$end])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$danwei_s.'%')->group('username')->order('find_time')->select();
        foreach ($fin_num_all as $key => $value) {
            $arr =explode(',', $value['chaxun_id']);
            foreach ($arr as $key => $val) {
                    $res = Db::table('ny_c_cx')->field('finds')->where('id',$val)->find();
                    if(empty($res['finds']) ||$res['finds'] ==null){
                        $no_find+=1;//总的没有结果的次数
                    }
                    $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$val)->find();
                    if(!empty($find) ||!$find ==null){
                        $chuzhi_all_num+=1;
                    }
                }
            $all_num +=$value['a_num'];

        }
        $re_num = $all_num - $no_find;
        $data[$j]['username'] = '总计';
        $data[$j]['chuzhi_num'] = $chuzhi_all_num;
        $data[$j]['find_num'] = $all_num;
        $data[$j]['find_re_num'] = $re_num;
        $table_arr = array ('A' => '查询单位', 'B' => ' 处置次数', 'C' => '查找次数', 'D' => '有结果次数  ');
        $this->up_out($data, $table_arr );
    }
    //个人录入统计
    public function lr_count(){
        $info_tjModel = new info_tjModel;
        $adminId = session('id');
        //判断是否为超
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $where = array();
        if ($ad_info['admin_role'] == 0) {  //超管
            $where = 0;
        }else{
   //          $Company = session('company');
   //          var_dump($Company);
   //          $cx_info = $AdminModel->where('Company','=',$Company)->where('admin_role','=','2')->select();
   //          var_dump($cx_info);
			// if(!empty($cx_info )){
			// 	$cx_id =  json_decode($cx_info)->id;
			// 	$where = $cx_id;
			// }
            $where= $adminId;
        }

        $info = $info_tjModel->get_luru_count($where);

        // dump($info);
        // 获取分页显示
		if(!empty($info['0'])){
			$page = $info['0']->render();
        if(strlen($info[1]['0']['mouth'])>5){
            $info[1]['0']['mouth']=date('Y-m',$info[1]['0']['mouth']);
        }else{
             $info[1]['0']['mouth']='暂未录入';
        }

			// 模板变量赋值
			$this->assign('info', $info[1]);
		}else{
			$page = '';
			// 模板变量赋值
			$this->assign('info', []);
		}
        
        $this->assign('page', $page);

        //获取当前月
        $mouth = intval(date('m',time()));
        $this->assign('mouth',$mouth);
        return $this->fetch();
    }
    //
    //县级录入记录
    public function lr_xji_count(){
        $adminId = session('id');
        //判断是否为超级管理员
        $info_tjModel = new info_tjModel;
        $AdminModel = new AdminModel();
        $InfoModel = new InfoModel;
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $where = array();
        $danwei='';
        $diqu='';
        $eachPage =Request::instance()->param('tsize');
        if(empty($eachPage))$eachPage=10;
        if ($ad_info['admin_role'] == 0) {  //超管能查看所有地方的录入信息
            $InfoModel = new InfoModel;
            $sta_t = Request::instance()->param('xinhui_time');
            $end_t = Request::instance()->param('xinhui_time2');
            $start = strtotime($sta_t);
            if(empty($end_t))
            {
                $end= time();
            }else{
                $end = strtotime($end_t);
            }
            $diqu = Request::instance()->param('diqu');
            $danwei = Request::instance()->param('danwei');
            $danwei_s = $diqu.$danwei;
            Session::set('export_count_danwei_s','');
            Session::set('export_count_danwei_s',$danwei_s);
            Session::set('export_count_start','');
            Session::set('export_count_start',$start);
            Session::set('export_count_end','');
            Session::set('export_count_end',$end);
            $this->assign('sta_t',$sta_t);
            $this->assign('end_t',$end_t);
            $info = Db::table('ny_information a')->join('ny_admin b','a.input_name_id=b.id')->field('b.username UN,a.*')->where('input_time',['>=',$start],['<=',$end])->where('input_company','like','%'.$danwei_s.'%')->where('status','=',1)->order('input_time')->paginate($eachPage,false,['query'=>request()->param()]);//这里要求在录入时，录入单位必须给定，不能随便填写。
        }else{

        $Company = session('company');
        $info_tjModel = new info_tjModel;
        $job = $info_tjModel->get_c_lr($Company);
        $InfoModel = new InfoModel;
        $sta_t = Request::instance()->param('xinhui_time');
        $end_t = Request::instance()->param('xinhui_time2');
        $diqu = Request::instance()->param('diqu');
        $danwei =1;
        $danwei_s = $diqu;
        if(!empty($sta_t))
        {
            if(empty($end_t))
            {
                $end= time();
            }else{
                $end = strtotime($end_t);
            }
        }
        $start = strtotime($sta_t);
        $end = strtotime($end_t);
        Session::set('export_count_danwei_s','');
        Session::set('export_count_danwei_s',$danwei_s);
        Session::set('export_count_start','');
        Session::set('export_count_start',$start);
        Session::set('export_count_end','');
        Session::set('export_count_end',$end);
        $this->assign('sta_t',$sta_t);
        $this->assign('end_t',$end_t);
        $info = Db::table('ny_information a')->join('ny_admin b','a.input_name_id=b.id')->field('b.username UN,a.*')->where('input_company','like','%'.$job)->where('input_company','like','%'.$danwei_s.'%')->where('input_time',['>=',$start],['<=',$end])->where('status','=',1)->order('input_time')->paginate($eachPage,false,['query'=>request()->param()]);//这里要求在录入时，录入单位必须给定，不能随便填写。
            
        }

        $page = $info->render();
        $data = array();
        foreach ($info as $key => $value) {
            if($value['xinhui_fenlei']=='0'){
                $value['xinhui_fenlei'] = '行贿行为';
            }else{
                $value['xinhui_fenlei']='行贿犯罪';
            }
            $value['xinhui_time'] = date("Y-m-d",$value['xinhui_time']);
            $value['input_time'] = date("Y-m-d",$value['input_time']);
            $data[] = $value;
        }
        $this->assign('c_danwei',$danwei);
        $this->assign('c_diqu',$diqu);
        // Session::set('lr_xji_count','');
        // Session::set('lr_xji_count',$data);
        $dws = Db::table('ny_c_dw')->field('b_name')->where('type','=',1)->order('id')->select();
        $diqu = Db::table('ny_c_diqu')->field('b_name')->order('id')->select();
        $this->assign('diqu',$diqu);
        if($danwei ==1){
            $dws = '';
        }
        $this->assign('danwei',$dws);
        $this->assign('info', $data);
        $this->assign('page', $page);
        $this->assign('page_row', $eachPage);
        //获取当前月
        $mouth = intval(date('m',time()));
        $this->assign('mouth',$mouth);
        return $this->fetch();
    }
    //录入记录导出
    public function export_lr_xji_count(){

    }
    //县级录入统计
    public function lr_xji_num(){
        $info_tjModel = new info_tjModel;
        $adminId = session('id');
        $Company = session('company');
        $diqu = Request::instance()->param('diqu');
        $danwei = Request::instance()->param('danwei');
        $sta_t = Request::instance()->param('xinhui_time');
        $end_t = Request::instance()->param('xinhui_time2');
        $start = strtotime($sta_t);
        $end = strtotime($end_t);
        $this->assign('sta_t',$sta_t);
        $this->assign('end_t',$end_t);
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $eachPage =Request::instance()->param('tsize');
        Session::set('export_lr_export_end','');
        Session::set('export_lr_export_end',$end);
        Session::set('export_lr_export_start','');
        Session::set('export_lr_export_start',$start);
        if(empty($eachPage))$eachPage=10;
        $danwei_s = '';
        //判断是否为超级管理员
        if ($ad_info['admin_role'] != 0) {
            $danwei = 1;//不是超管，前台不显示单位信息
            $job = $info_tjModel->get_c_lr($Company);
            $danwei_s = $diqu.$job;
            $all_fos = Db::table('ny_danwei')->where('b_name','like','%'.$danwei_s.'%')->paginate($eachPage,false,['query'=>request()->param()]);
            $export_fos = Db::table('ny_danwei')->where('b_name','like','%'.$danwei_s.'%')->select();
            Session::set('export_lr_export_fos','');
            Session::set('export_lr_export_fos',$export_fos);
        }else{
            //是超管
            if($diqu == 1){
                $all_fos = Db::table('ny_c_diqu')->paginate($eachPage,false,['query'=>request()->param()]);
                $export_fos = Db::table('ny_c_diqu')->select();//这里是用来导出数据使用
                Session::set('export_lr_export_fos','');
                Session::set('export_lr_export_fos',$export_fos);
            }elseif ($danwei==2) {
                $all_fos = Db::table('ny_c_dw')->where('type','=',1)->paginate($eachPage,false,['query'=>request()->param()]);
                $export_fos = Db::table('ny_c_dw')->where('type','=',1)->select();
                Session::set('export_lr_export_fos','');
                Session::set('export_lr_export_fos',$export_fos);
            }else{
                $danwei_s = $diqu.$danwei;
                 $all_fos = Db::table('ny_danwei')->where('b_name','like','%'.$danwei_s.'%')->paginate($eachPage,false,['query'=>request()->param()]);
                 $export_fos = Db::table('ny_danwei')->where('b_name','like','%'.$danwei_s.'%')->select();
                 Session::set('export_lr_export_fos','');
                Session::set('export_lr_export_fos',$export_fos);

            }
            
        }
        Session::set('export_lr_export_danwei_s','');
        Session::set('export_lr_export_danwei_s',$danwei_s);
        
        // $where = array();
        $page = $all_fos->render();
        $i = 0;
        foreach ($all_fos as $al_k => $al_v) {
            $geren = 0;  //个人
            $danwei_n = 0; //单位
            $xingwei = 0; //行贿行为
            $fanzui = 0; //行贿犯罪
            $count = 0;
            $company = AdminModel::where('admin_role',2)->where('Company','like','%'.$al_v['b_name'].'%')->column('Company','id');
  //             87 => string '南阳市纪检委' (length=18)
  // 88 => string '南阳市纪检委' (length=18)
  // 89 => string '南阳市纪检委' (length=18)
  // 260 => string '南阳市纪检委' (length=18)
            foreach ($company as $k => $v) {
                if($end){
                    $info = Db::table('ny_information')->where('input_name_id', $k)
                                    ->where('input_time',['>=',$start],['<=',$end])->select();
                }else{
                    $info = Db::table('ny_information')->where('input_name_id', $k)->select();
                    }
                
                // var_dump($info);exit;
                foreach ($info as $data_key => $data_value) {
                // 
                // var_dump($data_value);exit;
                // $data = $data_value['data'];
                ($data_value['danwei_geren'] == 1) ? $geren++ : $danwei_n++ ;
                ($data_value['xinhui_fenlei'] == 0) ? $xingwei++ : $fanzui++ ;
                $count++;
                }

            }
            $data[$i]['danwei_id'] = $al_k;
            $data[$i]['Company'] = $al_v['b_name'];
            $data[$i]['all_num'] = $count;
            $data[$i]['geren_num'] = $geren;
            $data[$i]['danwei_num'] = $danwei_n;
            $data[$i]['xingwei_num'] = $xingwei;
            $data[$i]['fanzui_num'] = $fanzui;
            $i++;
            
        }
        //总计模块
        $sum_lr = 0;
        $sum_danwei = 0;
        $sum_geren = 0;
        $sum_xw = 0;
        $sum_fz = 0;
        $company = AdminModel::where('admin_role',2)->where('Company','like','%'.$danwei_s.'%')->column('Company','id');
        foreach ($company as $k => $v) {
            if($end){
                    $info = Db::table('ny_information')->where('input_name_id', $k)
                                    ->where('input_time',['>=',$start],['<=',$end])->select();
                }else{
                    $info = Db::table('ny_information')->where('input_name_id', $k)->select();
                    }
            foreach ($info as $data_key => $data_value) {
                ($data_value['danwei_geren'] == 1) ? $sum_geren++ : $sum_danwei++ ;
                ($data_value['xinhui_fenlei'] == 0) ? $sum_xw++ : $sum_fz++ ;
                $sum_lr++;
                }
        }
        $this->assign('c_danwei',$danwei);
        $this->assign('c_diqu',$diqu);
        $this->assign('page', $page);
        $this->assign('info',$data);
        $dws = Db::table('ny_c_dw')->field('b_name')->where('type','=',1)->order('id')->select();
        $diqu = Db::table('ny_c_diqu')->field('b_name')->order('id')->select();
        if($danwei==1){
            $dws = '';
        }
        // var_dump($danwei);
        $this->assign('sum_lr',$sum_lr);
        $this->assign('sum_danwei',$sum_danwei);
        $this->assign('sum_geren',$sum_geren);
        $this->assign('sum_xw',$sum_xw);
        $this->assign('sum_fz',$sum_fz);
        $this->assign('diqu',$diqu);
        $this->assign('danwei',$dws);
        $this->assign('page_row', $eachPage);
        return $this->fetch();
    }
    //打印出录入统计的都数据。
    public function export_xji_num(){

        // $export_all = session('export_lr_all');
        // $export_danwei = session('export_lr_danwei');
        // $export_diqu = session('export_lr_diqu');
        // if($export_diqu){
        //     $infos = Db::table('ny_c_diqu')->select();
        // }elseif ($export_danwei) {
        //     $infos = Db::table('ny_c_dw')->where('type','=',1)->select();
        // }elseif($export_all){

        //     $infos = Db::table('ny_danwei')->select();
        // }else{
        //     return $this->error('操作错误');
        // }
        $danwei_s = session('export_lr_export_danwei_s');
        $infos = session('export_lr_export_fos');
        $start = session('export_lr_export_start');
        $end = session('export_lr_export_end');
        if(empty($infos))return $this->error('操作错误');
        //遍历所有数据，以便打印出来
        $i=0;
        foreach ($infos as $al_k => $al_v) {
            $geren = 0;  //个人
            $danwei_n = 0; //单位
            $xingwei = 0; //行贿行为
            $fanzui = 0; //行贿犯罪
            $count = 0;
            $company = AdminModel::where('admin_role',2)->where('Company','like','%'.$al_v['b_name'].'%')->column('Company','id');
  //             87 => string '南阳市纪检委' (length=18)
  // 88 => string '南阳市纪检委' (length=18)
  // 89 => string '南阳市纪检委' (length=18)
  // 260 => string '南阳市纪检委' (length=18)
            foreach ($company as $k => $v) {
                $info = Db::table('ny_information')->where('input_name_id', $k)->where('input_time',['>=',$start],['<=',$end])->select();            
                // var_dump($info);exit;
                foreach ($info as $data_key => $data_value) {
                // 
                // var_dump($data_value);exit;
                // $data = $data_value['data'];
                ($data_value['danwei_geren'] == 1) ? $geren++ : $danwei_n++ ;
                ($data_value['xinhui_fenlei'] == 0) ? $xingwei++ : $fanzui++ ;
                $count++;
                }

            }
            $data[$i]['Company'] = $al_v['b_name'];
            $data[$i]['all_num'] = $count;
            $data[$i]['geren_num'] = $geren;
            $data[$i]['danwei_num'] = $danwei_n;
            $data[$i]['xingwei_num'] = $xingwei;
            $data[$i]['fanzui_num'] = $fanzui;
            $i++;
            
        }
        //总共录入数量统计
        $sum_lr = 0;
        $sum_danwei = 0;
        $sum_geren = 0;
        $sum_xw = 0;
        $sum_fz = 0;
        $company = AdminModel::where('admin_role',2)->where('Company','like','%'.$danwei_s.'%')->column('Company','id');
        foreach ($company as $k => $v) {
            if($end){
                    $info = Db::table('ny_information')->where('input_name_id', $k)
                                    ->where('input_time',['>=',$start],['<=',$end])->select();
                }else{
                    $info = Db::table('ny_information')->where('input_name_id', $k)->select();
                    }
            foreach ($info as $data_key => $data_value) {
                ($data_value['danwei_geren'] == 1) ? $sum_geren++ : $sum_danwei++ ;
                ($data_value['xinhui_fenlei'] == 0) ? $sum_xw++ : $sum_fz++ ;
                $sum_lr++;
                }
        }
        $data[$i]['Company'] = '总计';
        $data[$i]['sum_lr'] = $sum_lr;
        $data[$i]['sum_danwei'] = $sum_danwei;
        $data[$i]['sum_geren'] = $sum_geren;
        $data[$i]['sum_xw'] = $sum_xw;
        $data[$i]['sum_fz'] = $sum_fz;
        $table_arr = array ('A' => '录入管理员单位', 'B' => '录入总数量', 'C' => '  单位数量', 'D' => '个人数量', 'E' => '行贿行为数量','F'=>'行贿犯罪数量');
        $this->up_out( $data, $table_arr );
    }
    //录入记录的详细信息
    public function lr_xji_xiang(){
        $adminId = session('id');
        //接受信息ID
        $information_id = Request::instance()->param('id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info_xiang($information_id);
        $qishi_time = $info['input_time'];
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        return $this->fetch();
    }
    //录入统计的详细信息
    public function lr_xji_num_count(){
        // $dws = Db::table('ny_danwei')->field('b_name')->where('sta','=',0)->select();
        // $this->assign('data',$dws);
        $dq= Request::instance()->param('dq');
        $sta_t = Request::instance()->param('xinhui_time');
        $end_t = Request::instance()->param('xinhui_time2');
        $danwei = Request::instance()->param('danwei');
        $start = strtotime($sta_t);
        $end = strtotime($end_t);
        $this->assign('sta_t',$sta_t);
        $this->assign('end_t',$end_t);
        $InfoModel = new InfoModel;
        $company = AdminModel::where('admin_role',2)->field('username','id')->where('Company','like','%'.$dq.'%')->column('username','id');
        $info = "";
        $i = 0;
        foreach ($company as $k => $v) {
            $geren = 0;  //个人
            $danwei_n = 0; //单位
            $xingwei = 0; //行贿行为
            $fanzui = 0; //行贿犯罪
            $count = 0;
            if($end){
                    $info = Db::table('ny_information')->where('input_name_id', $k)
                                    ->where('input_time',['>=',$start],['<=',$end])->paginate(10,false,['query'=>request()->param()]);
                }else{
                    $info = Db::table('ny_information')->where('input_name_id', $k)->paginate(10,false,['query'=>request()->param()]);
                    }
            foreach ($info as $data_key => $data_value) {
                // 
                // var_dump($data_value);exit;
                // $data = $data_value['data'];
                ($data_value['danwei_geren'] == 1) ? $geren++ : $danwei_n++ ;
                ($data_value['xinhui_fenlei'] == 0) ? $xingwei++ : $fanzui++ ;
                $count++;
                }
        $data[$i]['input_id'] = $k;
        $data[$i]['Company'] = $v;
        $data[$i]['all_num'] = $count;
        $data[$i]['geren_num'] = $geren;
        $data[$i]['danwei_num'] = $danwei_n;
        $data[$i]['xingwei_num'] = $xingwei;
        $data[$i]['fanzui_num'] = $fanzui;
        $i++;
        }
        $sum_lr = 0;
        $sum_danwei = 0;
        $sum_geren = 0;
        $sum_xw = 0;
        $sum_fz = 0;
        foreach ($data as $sum_k => $sum_v) {
        $sum_lr+=$sum_v['all_num'];
        $sum_danwei+=$sum_v['danwei_num'];
        $sum_geren+=$sum_v['geren_num'];
        $sum_xw+=$sum_v['xingwei_num'];
        $sum_fz+=$sum_v['fanzui_num'];
    }
    // var_dump($data);exit;
        // if(Request::instance()->isPost()){
        //     $sta_t = Request::instance()->param('xinhui_time');
        //     $end_t = Request::instance()->param('xinhui_time2');
        //     $danwei = Request::instance()->param('danwei');
        //     $start = strtotime($sta_t);
        //     $end = strtotime($end_t);
        //     $this->assign('sta_t',$sta_t);
        //     $this->assign('end_t',$end_t);
        //     $info = $InfoModel
        //             ->where('input_name_id','=',$id)->where('input_time',['>=',$start],['<=',$end])->where('input_name','like','%'.$danwei.'%')
        //             ->order('input_time', 'desc')
        //             ->paginate(8);
        // }else{
        //     $info = $InfoModel
        //             ->where('input_name_id','=',$id)
        //             ->order('input_time', 'desc')
        //             ->paginate(8);
        // }
        // $page= $info->render();
        // $data = array();
            // var_dump($info);exit;
        // foreach ($data as $key => $value) {
        //     foreach ($value as $k => $val) {
        //         if($val['xinhui_fenlei']=='0'){
        //             $val['xinhui_fenlei'] = '行贿行为';
        //         }else{
        //                 $val['xinhui_fenlei']='行贿犯罪';
        //             }
        //             $val['xinhui_time'] = date("Y-m-d",$val['xinhui_time']);
        //             $val['input_time'] = date("Y-m-d",$val['input_time']);
        //     }
            
        //     $data[] = $value;
        // }
        $this->assign('sum_lr',$sum_lr);
        $this->assign('sum_danwei',$sum_danwei);
        $this->assign('sum_geren',$sum_geren);
        $this->assign('sum_xw',$sum_xw);
        $this->assign('sum_fz',$sum_fz);
        Session::set('infos','');
        Session::set('infos',$data);
        // $this->assign('page',$page);
        $this->assign('info',$data);
        return $this->fetch();
    }
    public function lr_count_xiang(){
        $id = Request::instance()->param('id');

        $type = Request::instance()->param('type');
        $mouth = date("m",time());
        $InfoModel = new InfoModel;
        $info = "";
        /*使用if来判读是什么类型
            0 代表所有
            1 代表个人
            2 代表单位
            3 代表行贿行为
            4 代表行贿犯罪
        */
        if ($type == "0") {
            $info = $InfoModel
                    ->where('input_name_id','=',$id)
                    ->order('input_time', 'desc')
                    ->paginate(3);
        } elseif ($type == "1") {
            $info = $InfoModel
                    ->where('input_name_id','=',$id)
                    ->where('danwei_geren','=','1')
                    ->order('input_time', 'desc')
                    ->paginate(3);
        } elseif ($type == "2") {
            $info = $InfoModel
                    ->where('input_name_id','=',$id)
                    ->where('danwei_geren','=','0')
                    ->order('input_time', 'desc')
                    ->paginate(3);
        } elseif ($type == "3") {
            $info = $InfoModel
                    ->where('input_name_id','=',$id)
                    ->where('xinhui_fenlei','=','0')
                    ->order('input_time', 'desc')
                    ->paginate(3);
        } elseif ($type == "4") {
            $info = $InfoModel
                    ->where('input_name_id','=',$id)
                    ->where('xinhui_fenlei','=','1')
                    ->order('input_time', 'desc')
                    ->paginate(3);
        }

        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }
    public function lr_sum(){
        $company = session('company');
        $dw= explode('纪检委', $company);
        $dw_n= $dw[0];
        $info = Db::table('ny_info_tongji')->alias('a')->field('tj_id,admin_id,all_num,danwei_num,geren_num,xingwei_num,fanzui_num,mouth,Company')->join('ny_admin b', 'a.admin_id = b.id')->order('mouth desc')->where('b.Company','like',$dw_n.'%')->group('b.Company')->paginate(20);
        $page = $info->render();
        $data = array();
        foreach ($info as $key => $value) {
            if(strlen($value['mouth']) >5){
            $data[$key]['mouth']=date('Y-m',$value['mouth']);
            }else{
            $data[$key]['mouth']='暂未录入';
            }
            $data[$key]['admin_id']=$value['admin_id'];
            $data[$key]['all_num']=$value['all_num'];
            $data[$key]['danwei_num']=$value['danwei_num'];
            $data[$key]['geren_num']=$value['geren_num'];
            $data[$key]['xingwei_num']=$value['xingwei_num'];
            $data[$key]['fanzui_num']=$value['fanzui_num'];
            $data[$key]['username']=$value['Company'];
            
        }
        Session::set('data','');
        Session::set('data',$data);
        $this->assign('page', $page);
        $this->assign('info',$data);
        // var_dump($info);exit;
        return $this->fetch();
    }
    //导出录入excle表
    public function export_lr(){
        $info_tjModel = new info_tjModel;
        $adminId = session('id');
        //判断是否为超级管理员
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();

        $where = array();
        if ($ad_info['admin_role'] == 0) {  //超管
            $where = 0;
        }else{
            $Company = session('company');
            $cx_info = $AdminModel->where('Company','=',$Company)->where('admin_role','=','2')->find();
            $cx_id =  json_decode($cx_info)->id;
            $where = $cx_id;
        }

        $list =$info_tjModel->get_luru_excle($where);

        /*
        $mouth = intval(date('m',time()));
        $mouth_2 = $mouth+1;
        */
        $info = array();

        // exit();
        foreach ($list as $k=>$v){
            $info[$k]['Company'] = $v['Company'];
            $info[$k]['all_num'] = $v['all_num'];
            $info[$k]['danwei_num'] = $v['danwei_num'];
            $info[$k]['geren_num'] = $v['geren_num'];
            $info[$k]['xingwei_num'] = $v['xingwei_num'];
            $info[$k]['fanzui_num'] = $v['fanzui_num'];
        }
        $table_arr = array ('A' => '录入管理员单位', 'B' => '录入数量	', 'C' => '单位数量', 'D' => '个人数量	', 'E' => '行贿行为数量', 'F' => '行贿犯罪数量');
        $this->up_out( $info, $table_arr );
    }
    // public function export_xji_num(){
    //     $list = session('lr_xji_num');
    //     $table_arr = array ('A' => '录入id', 'B' => '录入管理员单位', 'C' => '录入总数量', 'D' => '  单位数量', 'E' => '个人数量', 'F' => '行贿行为数量','G'=>'行贿犯罪数量');
    //     $this->up_out( $list, $table_arr );
    // }
    public function export_xji_lr(){
     //这里用session保存了，要生成Excel的数据
        $danwei_s = session('export_count_danwei_s');
        $start = session('export_count_start');
        $end = session('export_count_end');
        $info = Db::table('ny_information a')->join('ny_admin b','a.input_name_id=b.id')->field('b.username UN,a.*')->where('input_time',['>=',$start],['<=',$end])->where('input_company','like','%'.$danwei_s.'%')->where('status','=',1)->order('input_time')->select();//
        $data = array();
        foreach ($info as $key => $value) {
            if($value['xinhui_fenlei']=='0'){
                $value['xinhui_fenlei'] = '行贿行为';
            }else{
                $value['xinhui_fenlei']='行贿犯罪';
            }
            $value['xinhui_time'] = date("Y-m-d",$value['xinhui_time']);
            $value['input_time'] = date("Y-m-d",$value['input_time']);
            $data[] = $value;
        }
        // exit();
        $info = array();
        foreach ($data as $k=>$v){
            $info[$k]['input_company'] = $v['input_company'];
            $info[$k]['input_name'] = $v['input_name'];
            $info[$k]['username'] = $v['username'];
            $info[$k]['xinhui_fenlei'] = $v['xinhui_fenlei'];
            $info[$k]['xinhui_money'] = $v['xinhui_money'];
            $info[$k]['xinhui_cishu'] = $v['xinhui_cishu'];
            $info[$k]['xinhui_time'] = $v['xinhui_time'];
            $info[$k]['input_time'] = $v['input_time'];
        }
        $table_arr = array ('A' => '录入单位', 'B' => '录入姓名  ', 'C' => '行贿人', 'D' => '行贿性质  ', 'E' => '行贿金额', 'F' => '行贿次数','G'=>'行贿时间','H'=>'录入时间');
        $this->up_out( $info, $table_arr );
    }
    
    //处置统计
    public function cz_count(){
        $chuzi_tongjicountModel = new Chuzi_tongjicountModel;
        $Chuzi_tongjiModel  = new Chuzi_tongjiModel;
        $adminId = session('id');
        //判断是否为超级管理员

        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $where = array();

        if($ad_info['admin_role']==0 || $ad_info['admin_role']==4){  //超管
            $where = 0;
        }else{
            $Company = session('company');
            $cx_info = $AdminModel->where('Company','=',$Company)->where('admin_role','=','3')->find();
            $cx_id =  $cx_info['id'];
            $where['cz_id'] = array('eq', $cx_id);
        }
        $info = $chuzi_tongjicountModel->get_chuzhi_count($where);
        // 获取分页显示
        $page = $info->render();
        $info = $info->toArray();
        foreach ($info['data'] as $key => $value) {
            $id_name = $AdminModel->company_name($value['cz_id']);
            $id_name = $id_name[0]->toArray()['Company'];
            $info['data'][$key]['id_name'] = $id_name;
        }
        // 模板变量赋值
        $this->assign('info', $info['data']);
        $this->assign('page', $page);

        //获取当前月
        $mouth = intval(date('m',time()));
        $this->assign('mouth',$mouth);
        return $this->fetch();
    }

    //导出处置Excel表
    public function export_cz(){
        $chuzi_tongjicountModel = new Chuzi_tongjicountModel;
        $Chuzi_tongjiModel  = new Chuzi_tongjiModel;
        $adminId = session('id');
        //判断是否为超级管理员
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        $where = array();

        if($ad_info['admin_role']==0 || $ad_info['admin_role']==4){  //超管
            $where = 0;
        }else{

            $Company = session('company');
            $cx_info = $AdminModel->where('Company','=',$Company)->where('admin_role','=','3')->find();
            $cx_id =  $cx_info['id'];
            $where['cz_id'] = array('eq', $cx_id);
        }
        $list = $chuzi_tongjicountModel->get_chuzhi_excle($where);
        // $list = $Chuzi_tongjiModel->get_chuzhi_excle($where);
        foreach ($list as $key => $value) {
            $id_name = $AdminModel->company_name($value['cz_id']);
            $id_name = $id_name[0]->toArray()['Company'];
            $list[$key]['danwei_name'] = $id_name;
        }
        $mouth = intval(date('m',time()));
        $mouth_2 = $mouth+1;
        $info = array();

        foreach ($list as $k=>$v){
            $info[$k]['danwei_name'] = $v['danwei_name'];
            $info[$k]['chuzhi_jieguo'] = $v['chuzhi_jieguo'];
            $info[$k]['jieguo_count'] = $v['jieguo_count'];
        }
        // dump($info);
        $table_arr = array ('A' => '处置单位', 'B' => '处置结果', 'C' => '总计');
        $this->up_out( $info, $table_arr );
    }

    //处置列表页
    public function cz_count_list() {
        $id = Request::instance()->param('id');
        $InfoModel = new InfoModel;
        $info = $InfoModel->get_cz_xiang($id);
        if($info['xinhui_fenlei']==0){
            $qishi_time = $info['input_time'];
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }else{
            $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);
        $this->assign('info',$info);
        return $this->fetch();



    }
    //处置结果详情
    public function cz_count_xiang(){
        $cz_id = Request::instance()->param('cz_id');
        $chuzhi_jieguo = Request::instance()->param('chuzhi_jieguo');

        $InfoModel = new Chuzi_tongjiModel;
        $info = $InfoModel->get_cz_list($cz_id,$chuzhi_jieguo);
        $page = $info->render();
        $this->assign('info', $info);
        $this->assign('page', $page);
        /*
        $id = Request::instance()->param('id');
        $InfoModel = new InfoModel;
        $info = $InfoModel->get_cz_xiang($id);
        if($info['xinhui_fenlei']==0){
            $qishi_time = $info['input_time'];
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }else{
            $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);
        $this->assign('info',$info);
        */
        return $this->fetch();
    }
    /****
    *
    *   生成审批表        
    *
    *
    */
    public function out_shenpi(){
        $bools = vendor('PHPWord.PhpWord');
        $PHPWord = new \PHPWord();
        $id = Request()->instance()->param('info_id');
        $info = Db::view('information','*')->where('information_id='.intval($id))->find();
        if($info['danwei_geren']==0){
            $company=$info['company_name'];
        }else{
            $company = $info['company'];
        }
        
        if($info['xinhui_fenlei']==0){
            $detail= $info['behavior_xingwei'];
        }else{
            $detail = $info['behavior_fanzui'];
        }
        $chuzhi_biaozhun= $info['chuzhi_biaozhun'];
        $qi_xian = $info['chuzhi_qixian'];
        $res = $info['xingqi'];
        require '/static/admin_an/template/template3.php';
        $objWriter = \PHPWord_IOFactory::createWriter( $PHPWord, 'Word2007');
        $filename = date ( 'Y-m-j_H_i_s' ) . '.docx';
        //这个地方写死啦 后期在这里改
        ob_end_clean();//清除缓冲区,避免乱码
        $objWriter->save (__ROOT__.'/upload/phpword/'.$filename );
        header ( 'content-Type:application/vnd.ms-word;charset=utf-8' );
        header ( 'Content-Disposition:attachment;filename="' . $filename . '"' );
        header ( 'Cache-Control:max-age=0' );
        $objWriter->save ( 'php://output' );
    }

    /**
     * 导出excle通用
     * Enter description here ...
     * @param unknown_type $members_info
     * @param unknown_type $table_arr
     */

    protected function up_out($members_info, $table_arr) {
        Vendor('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        foreach ( $table_arr as $key => $val ) {
            //设置表格宽度
            $objPHPExcel->getActiveSheet ()->getColumnDimension ( $key )->setWidth (20);
            //设置表格第一行标题
            $objPHPExcel->getActiveSheet ()->setCellValue ( $key . '1', "$val" );
        }
        foreach ( $members_info as $key => $val ) {
            if (is_array ( $val )) {
                //把这个数组中键和值反转一下
                $arr2 = array_flip ( $table_arr );
                //把第一个数组值作为键，第二个数组值作为值，组合新数组
                $arr3 = array_combine ( $arr2, $val );
                $key = $key + 2;
                //循环导出
                foreach ( $arr3 as $k => $v ) {
                    $objPHPExcel->getActiveSheet ()->setCellValue ( $k . $key, $v );
                }
            }
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename = date ( 'Y-m-j_H_i_s' ) . '.xls';
        $objWriter->save (__ROOT__.'/upload/phpexcel/'.$filename );
        ob_end_clean();//清除缓冲区,避免乱码
        header ( 'content-Type:application/vnd.ms-excel;charset=utf-8' );
        header ( 'Content-Disposition:attachment;filename="' . $filename . '"' );
        header ( 'Cache-Control:max-age=0' );
        $objWriter->save ( 'php://output' );
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
    function lr_fenxi(){
        $all_fos = Db::table('ny_c_dw')->where('type','=',1)->select();
        $total = 0;//全部单位的录入总数
        $i = 0;//记录总多少单位
        foreach ($all_fos as $key => $value) {//单位
            $num_dw = 0;//一个单位的录入数量
            $diqu = Db::table('ny_c_diqu')->select();
            $j = 0;//记录多少地区
            foreach ($diqu as $d_k => $d_v) {//地区
                $count = 0;
            //纪检委//、、、、、、、、南阳市
                $like = $d_v['b_name'].$value['b_name'];
                $company = AdminModel::where('admin_role',2)->where('Company','like','%'.$like.'%')->column('Company','id');
                //南阳市-----纪检委录入123456
                foreach ($company as $k => $v) {
                $info = Db::table('ny_information')->where('input_name_id', $k)->select();
                // var_dump($info);exit;
                $n = count($info);
                $count +=$n;
                $num_dw +=$n;
                $total += $n;
            }
            $d_q[$i][$j]['diqu_num'] = $count;
            $d_q[$i][$j]['diqu'] = $d_v['b_name'];
            $d_q[$i][$j]['danwei'] = $value['b_name'];
            $j++;

        }
        $d_w[$i]['danwei'] = $value['b_name'];
        $d_w[$i]['danwei_num'] = $num_dw;
        $i++;
    }
        // var_dump($d_w,$d_q);var_dump($total);exit;
        foreach ($d_w as $k => $val) {
            $rate = ($val['danwei_num']/$total)*100;
            $res[$k] = '{name:'."'".$val['danwei'].'('.$val['danwei_num'].')'."'".',y:'.$rate.',drilldown:'."'".$val['danwei']."'".'}';
        }
        $str = implode(',', $res);
        $this->assign('str',$str);//录入单位占比
        // {
        //         name: 'Chrome',
        //         id: 'Chrome',
        //         data: [
        //             [
        //                 'v40.0',
        //                 5
        //             ],
        //             [
        //                 'v41.0',
        //                 4.32
        //             ],
                   
        //         ]
        //     },

        foreach ($d_q as $k => $v) {
            $dw_num = $d_w[$k]['danwei_num'];
            $data_r = array();
            foreach ($v as $v_k => $v_v) {
                if($dw_num){
                    $rate = ($v_v['diqu_num']/$dw_num)*100;
                }else{
                    $rate =0;
                }
                
                $data_r[$v_k] = '['."'".$v_v['diqu']."'".','.$rate.']';
            }
            $data = implode(',', $data_r);
            $dir[$k] = '{name:'."'".$d_w[$k]['danwei']."',id:'".$d_w[$k]['danwei']."',data:[".$data.']}'; 
        }
        $dir = implode(',',$dir);
        $this->assign('dir',$dir);

    //     {
    //     name: '东京',
    //     data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    // }, {
    //     name: '纽约',
    //     data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    // }, {
    //     name: '伦敦',
    //     data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
    // }, {
    //     name: '柏林',
    //     data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
    // }
        foreach ($d_q as $key => $value) {
            $da_r = array();
            $diqu_name = array();
            foreach ($value as $n_k => $n_v) {
                $da_r[$n_k] = $n_v['diqu_num'];
                $diqu_name[$n_k] = "'".$n_v['diqu']."'";
            }
            $da = implode(',', $da_r);
            $fir[$key] = '{name:'."'".$d_w[$key]['danwei']."',data:[".$da.']}';
        }
        $fir = implode(',', $fir);
        $dq_name = implode(',', $diqu_name);
        $this->assign('fir',$fir);
        $this->assign('diqu_name',$dq_name);
        // var_dump($dq_name);
        return $this->fetch();
    }

    public function cx_fenxi(){
        $all_fos = Db::table('ny_c_dw')->where('type','=',0)->select();
        $j=0;
        $above_num = 0;//总查询次数
        foreach ($all_fos as $key => $value) {
            $diqu = Db::table('ny_c_diqu')->select();
            $i=0;
            $total = 0;//单位数量查询统计
            $chuzhi_tot = 0;//处置数量统计
            $ll = $value['b_name'];
            foreach ($diqu as $d_k => $d_v) {
                $a_num = 0;
                $like = $d_v['b_name'];
                $like = $like.$ll;
                $finds = Db::table('ny_c_cx')->alias('a')->field(['username','group_concat(a.id)'=>'chaxun_id','count(a.adminId)'=>'a_num','keyword','min(find_time)'=>'sta_time','max(find_time)'=>'end_time'])->join('ny_admin b','a.adminId=b.id')->where('username','like','%'.$like.'%')->group('username')->order('find_time')->select();
                $chuzhi_num =0;
                // $nofind_num = 0;
                foreach ($finds as $k => $f_v) {
                    $arr =explode(',', $f_v['chaxun_id']);
                    foreach ($arr as $a_k => $a_val) {
                        $find = Db::table('ny_c_chuzhi')->where('chaxun_id',$a_val)->find();
                        if(!empty($find) ||$find !=null){
                            $chuzhi_num+=1;
                            $chuzhi_tot+=1;
                            }
                    }
                    $a_num +=$f_v['a_num'];
                    $total +=$f_v['a_num'];
                }
                $d_q[$j][$i]['all_num'] = $a_num;
                $d_q[$j][$i]['dq_name'] = $d_v['b_name'];
                $d_q[$j][$i]['chuzhi_num'] = $chuzhi_num;
                $i++;
            }
            
            $d_w[$j]['num'] = $total;
            $d_w[$j]['dw_name'] = $ll;
            $d_w[$j]['chuzhi_num'] = $chuzhi_tot;
            $j++;
        }
    //     {
    //     name: '东京',
    //     data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    // },
        foreach ($d_q as $key => $value) {
            $d_r = array();
            $diqu_name = array();
            foreach ($value as $k => $v) {
                $d_r[$k] = $v['all_num'];
                $diqu_name[$k] = "'".$v['dq_name']."'";
            }
            $da = implode(',', $d_r);
            $sir[$key] = '{name:'."'".$d_w[$key]['dw_name']."',data:[".$da.']}';
        }
        $sir = implode(',', $sir);
        $dq_name = implode(',', $diqu_name);
        $this->assign('sir',$sir);
        $this->assign('dq_name',$dq_name);
        return $this->fetch();
    }
}