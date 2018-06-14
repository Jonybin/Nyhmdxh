<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;
use think\Request;
use think\Controller;
use think\File;
use think\db;
use app\admin\model\Information as InfoModel;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Chaxun as ChaxunModel;
use app\admin\model\Edit_del as EditdelModel;
use app\admin\model\Info_tongji as info_tjModel;
use app\admin\model\Chuzi_tongji as Chuzi_tongjiModel;
use app\admin\controller\Index;

class Information extends Index
{
    /*
     *
     * 录入人员的相关操作
     *
     * */
    //录入信息
    public function add(){
        $dws = Db::table('ny_danwei')->field('b_name')->where('sta','=',0)->select();
        $this->assign('data',$dws);
        if(Request::instance()->isPost()) {   //判断操作是否为post请求
            // 取出当前管理员的ID,获得录入人员的id
            $adminId = session('id');
            //获取审核人的id
            $Company = session('company');
            $adminmodel = new AdminModel;
            $where['Company'] =$Company;
            $where['admin_role'] =1;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();
            //录入信息
            if(empty($exam_name_id) ||$exam_name_id =='null'){
                $this->error('审核单位不存在,请联系管理员','information/add',5);
                exit;
            }
            $infomodel = new InfoModel;

            $date['danwei_geren'] =  Request::instance()->param('danwei_geren');
            $date['xinhui_fenlei'] =  Request::instance()->param('xinhui_fenlei');

            //单位行贿
            $date['company_name'] =  Request::instance()->param('company_name');
            $date['nature'] =  Request::instance()->param('nature');
            $date['jigouma'] =  Request::instance()->param('jigouma');
            $date['boss_name'] =  Request::instance()->param('boss_name');
            $date['boss_cert'] =  Request::instance()->param('boss_cert');
            $date['zuce_address'] =  Request::instance()->param('zuce_address');
            $date['office_address'] =  Request::instance()->param('office_address');
            //个人行贿
            $date['username'] = Request::instance()->param('username');
            $date['age'] = Request::instance()->param('age');
            $date['sex'] = Request::instance()->param('sex');
            $date['education'] = Request::instance()->param('education');
            $date['cert_number'] = Request::instance()->param('cert_number');
            $date['address'] = Request::instance()->param('address');
            $date['company'] = Request::instance()->param('company');
            $date['position'] = Request::instance()->param('position');

            $date['xinhui_cishu'] =  Request::instance()->param('xinhui_cishu');
            $date['xinhui_money'] =  Request::instance()->param('xinhui_money');
            $year =  Request::instance()->param('xinhui_time_y');
            $month =  Request::instance()->param('xinhui_time_m');
            $y = $year.'-'.$month;
            $date['xinhui_time'] = strtotime($y);
            $date['input_time'] =  time();
            $date['input_mouth'] =  date("m",time());
            $date['input_company'] =  $Company;
            $date['input_name_id'] = $adminId;
            $date['exam_name_id'] = $exam_name_id['id'];
            $date['input_name'] =  Request::instance()->param('input_name');
            $date['exam_name'] =  Request::instance()->param('exam_name');

            //行贿行为
            $date['behavior_xingwei'] =  Request::instance()->param('behavior_xingwei');
            $file = request()->file('fujian_add');
            $date['fujian_add']='';
            //行贿犯罪
            $date['behavior_fanzui'] =  Request::instance()->param('behavior_fanzui');
            $date['panjuewenshu_id'] =  Request::instance()->param('panjuewenshu_id');
            $date['xingqi'] =  Request::instance()->param('xingqi');
            if($date['xingqi'] == 1){
                $date['xingqi']='判处三年以上有期徒刑';
            }elseif ($date['xingqi'] == 2) {
                $date['xingqi']='判处一年以上三年以下有期徒刑';
            }else{
                $date['xingqi']='其他判决结果';
            }
            //处置结果与期限
            $date['chuzhi_biaozhun'] =  Request::instance()->param('chuzhi_biaozhun');
            $date['chuzhi_qixian'] =  Request::instance()->param('chuzhi_qixian');

            //文件上传
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $date['fujian_add'] = $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit;
                }
            }

            $query = $infomodel->create($date);

            //页面跳转方法
            $this->redirect('Information/my_info');

        }
        return $this->fetch();
    }

    //
    /**
     * [my_info 录入的信息列表]
     **************************
     *申请过修改或者删除的信息，在信息操作列表展示，2018-5-5之后不再我的录入信息中展示
     *
     */
    public function my_info(){

        $infomodel = new InfoModel;
        $adminId = session('id');// 取出当前管理员的ID
        //分页
        $where = array();
        $where['input_name_id'] = array('eq', $adminId);
        $where['is_shenqing'] = 0;
        $info  = $infomodel->get_all_info($where);
        // 获取分页显示
        $page = $info->render();

        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }

    //录入信息详情页
    public function lu_xiang(){
        // 取出当前管理员的ID
        $adminId = session('id');
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info($information_id,$adminId);
        if($info['xinhui_fenlei']==0){
            $qishi_time = $info['exam_time'];
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }else{
            $qishi_time = strtotime("+".$info['xingqi']." months", $info['exam_time']);
            $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        }
        $info['exam_time'] = date('Y-n-j H:i:s',$info['exam_time']);
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        return $this->fetch();
    }
    public function sq_yiyi(){
        $adminId = session('id');
        if(Request::instance()->isPost()) {
            $EditdelModel  = new EditdelModel;
            //获取超管ID
            $Company = session('company');
            $adminmodel = new AdminModel;
            $limit['Company']=$Company;
            $limit['admin_role'] = 1;
            $shenhe_id = $adminmodel->field('id')->where($limit)->find();
            $where['admin_role'] =0;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();

            $date_info['sq_username'] = Request::instance()->param('sq_username');
            $date_info['sq_time'] = time();
            $date_info['sq_phone'] = Request::instance()->param('sq_phone');
            $date_info['sq_shiyou'] = Request::instance()->param('sq_shiyou');
            $date_info['info_id'] = Request::instance()->param('info_id');
            $file = request()->file('sq_fujian');
            $date_info['sqren_id'] = $adminId;
            $date_info['shenhe_id'] = $shenhe_id['id'];
            $date_info['root_id'] =$exam_name_id['id'];
            $date_info['status_sq'] =0;
            $date_info['is_edit_del'] =2;

            //文件上传
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'sq_uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $date_info['sq_fujian'] = $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit;
                }
            }
            $query = $EditdelModel->create($date_info);
            if($query){
                $infoModel = new InfoModel();
                $arr['information_id'] = Request::instance()->param('info_id');
                $arr['is_shenqing'] = 1;//修改操作--在信息id那里把申请状态设为，修改
                $res = $infoModel->update($arr);
                if($res){
                    $this->redirect('Information/my_info');
                }
            }
            


        }
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info($information_id,$adminId);
        $this->assign('info',$info);
        return $this->fetch();
    }
    //申请修改录入信息
    public function sq_edit(){
        // 取出当前管理员的ID
        $adminId = session('id');
        if(Request::instance()->isPost()) {
            $EditdelModel  = new EditdelModel;
            //获取超管ID
            $Company = session('company');
            $adminmodel = new AdminModel;
            $limit['Company']=$Company;
            $limit['admin_role'] = 1;
            $shenhe_id = $adminmodel->field('id')->where($limit)->find();
            $where['admin_role'] =0;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();

            $date_info['sq_username'] = Request::instance()->param('sq_username');
            $date_info['sq_time'] = time();
            $date_info['sq_phone'] = Request::instance()->param('sq_phone');
            $date_info['sq_shiyou'] = Request::instance()->param('sq_shiyou');
            $date_info['info_id'] = Request::instance()->param('info_id');
            $file = request()->file('sq_fujian');
            $date_info['sqren_id'] = $adminId;
            $date_info['shenhe_id'] = $shenhe_id['id'];
            $date_info['root_id'] =$exam_name_id['id'];
            $date_info['status_sq'] =0;
            $date_info['is_edit_del'] =0;

            //文件上传
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'sq_uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $date_info['sq_fujian'] = $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit;
                }
            }
            $query = $EditdelModel->create($date_info);
            if($query){
                $infoModel = new InfoModel();
                $arr['information_id'] = Request::instance()->param('info_id');
                $arr['is_shenqing'] = 1;//修改操作--在信息id那里把申请状态设为，修改
                $res = $infoModel->update($arr);
                if($res){
                    $this->redirect('Information/my_info');
                }
            }
            


        }
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info($information_id,$adminId);
        $this->assign('info',$info);
        return $this->fetch();
    }

    //申请删除录入信息
    public function sq_del(){
        // 取出当前管理员的ID
        $adminId = session('id');
        if(Request::instance()->isPost()) {
            $EditdelModel  = new EditdelModel;
            //获取超管ID
            $Company = session('company');
            $adminmodel = new AdminModel;
            $limt['Company']=$Company;
            $limit['admin_role'] = 1;
            $shenhe_id = $adminmodel->field('id')->where($limit)->find();
            $where['admin_role'] =0;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();
            $date_info['sq_username'] = Request::instance()->param('sq_username');
            $date_info['sq_time'] = time();
            $date_info['sq_phone'] = Request::instance()->param('sq_phone');
            $date_info['sq_shiyou'] = Request::instance()->param('sq_shiyou');
            $date_info['info_id'] = Request::instance()->param('info_id');
            $file = request()->file('sq_fujian');
            $date_info['sqren_id'] = $adminId;
            $date_info['shenhe_id'] = $shenhe_id['id'];
            $date_info['root_id'] =$exam_name_id['id'];//超级管理员的id
            $date_info['status_sq'] =0;
            $date_info['is_edit_del'] =1;

            //文件上传
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'sq_uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $date_info['sq_fujian'] = $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit;
                }
            }
            $query = $EditdelModel->create($date_info);
            if($query){
                $arr['information_id'] = Request::instance()->param('info_id');
                $arr['is_shenqing'] = 2;//修改操作--在信息id那里把申请状态设为，修改
                $res = Db::table('information')->update($arr);
                if($res){
                    $this->redirect('Information/my_info');
                }
            }else {
                $this->error('申请删除失败');
            }

        }
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info($information_id,$adminId);
        $this->assign('info',$info);
        return $this->fetch();
    }

    //异议复核信息列表
    public function yihe_lst(){
        $infomodel = new InfoModel;
        $adminId = session('id');// 取出当前管理员的ID
        //分页
        $info  = $infomodel->get_all_yihe($adminId);
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }

    //修改录入信息
    public function edit(){
        // 取出当前管理员的ID
        $adminId = session('id');
        if(Request::instance()->isPost()) {   //判断操作是否为post请求

            //修改信息
            $infomodel = new InfoModel;

            $date['danwei_geren'] =  Request::instance()->param('danwei_geren');
            $date['xinhui_fenlei'] =  Request::instance()->param('xinhui_fenlei');

            //单位行贿
            $information_id =  Request::instance()->param('information_id');
            $date['company_name'] =  Request::instance()->param('company_name');
            $date['nature'] =  Request::instance()->param('nature');
            $date['jigouma'] =  Request::instance()->param('jigouma');
            $date['boss_name'] =  Request::instance()->param('boss_name');
            $date['boss_cert'] =  Request::instance()->param('boss_cert');
            $date['zuce_address'] =  Request::instance()->param('zuce_address');
            $date['office_address'] =  Request::instance()->param('office_address');
            //个人行贿
            $date['username'] = Request::instance()->param('username');
            $date['age'] = Request::instance()->param('age');
            $date['sex'] = Request::instance()->param('sex');
            $date['education'] = Request::instance()->param('education');
            $date['cert_number'] = Request::instance()->param('cert_number');
            $date['address'] = Request::instance()->param('address');
            $date['company'] = Request::instance()->param('company');
            $date['position'] = Request::instance()->param('position');

            $date['xinhui_cishu'] =  Request::instance()->param('xinhui_cishu');
            $date['xinhui_money'] =  Request::instance()->param('xinhui_money');
            $date['xinhui_time'] =  strtotime(Request::instance()->param('xinhui_time'));
            $date['input_time'] =  time();
            $date['input_mouth'] =  date("m",time());
            $date['input_company'] =  Request::instance()->param('input_company');
            $date['input_name_id'] = $adminId;
            $date['exam_name_id'] = Request::instance()->param('exam_name_id');
            $date['input_name'] =  Request::instance()->param('input_name');
            $date['exam_name'] =  Request::instance()->param('exam_name');

            //行贿行为
            $date['behavior_xingwei'] =  Request::instance()->param('behavior_xingwei');
            $file = request()->file('fujian_add');
            $date['fujian_add']=Request::instance()->param('fujian_add');
            //行贿犯罪
            $date['behavior_fanzui'] =  Request::instance()->param('behavior_fanzui');
            $date['panjuewenshu_id'] =  Request::instance()->param('panjuewenshu_id');
            $date['xingqi'] =  Request::instance()->param('xingqi');
            if($date['xingqi']==1){
                $date['xingqi'] = '判处三年以上有期徒刑';
            }elseif ($date['xingqi'] ==2) {
                $date['xingqi'] ='判处一年以上三年以下有期徒刑';
            }else{
                $date['xingqi']='其他判决结果';
            }

            //处置结果与期限
            $date['chuzhi_biaozhun'] =  Request::instance()->param('chuzhi_biaozhun');
            $date['chuzhi_qixian'] =  Request::instance()->param('chuzhi_qixian');
            //文件上传
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $date['fujian_add'] = $info->getSaveName();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit;
                }
            }

            $infomodel->where('information_id','=',$information_id)->delete();
            $query = $infomodel->create($date);

            //页面跳转方法
            $this->redirect('Information/my_info');

        }
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->get_info($information_id,$adminId);
        $this->assign('info',$info);
        return $this->fetch();
    }

    //删除录入信息
    public function del(){
        $adminId = session('id');// 取出当前管理员的ID
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $date = $infomodel->where('information_id',$information_id)->find();
        $mouth = intval(date("m",$date['input_time']));
        $query = $infomodel->where('information_id',$information_id)->delete();

        $this->redirect('Information/my_info');

    }

    //ajax获取处置期限
    public function ajax_info(){
        //ajax参数
        $xinhui_fl =  Request::instance()->param('xinhui_fl');
        $xinhui_cishu =  Request::instance()->param('xinhui_cishu');
        $xinhui_money =  Request::instance()->param('xinhui_money');
        $xingqi =  Request::instance()->param('xingqi');
        if($xinhui_fl == 0){
            if($xinhui_cishu>=2){
                $chuzhi_jieguo = '行贿数额在10万元以上或有两次以上行贿行为记录的，处置期限为最后一次行贿行为信息录入之日1年';
                $chuzhi_qixian = '12';
            }else {
                if ($xinhui_money > 100000) {
                    $chuzhi_jieguo = '行贿数额在10万元以上或有两次以上行贿行为记录的，处置期限为最后一次行贿行为信息录入之日1年';
                    $chuzhi_qixian = '12';
                } elseif ($xinhui_money > 50000) {
                    $chuzhi_jieguo = '行贿数额在5万元以上10万元以下的，处置期限为9个月';
                    $chuzhi_qixian = '9';
                } else {
                    $chuzhi_jieguo = '有其他行贿行为记录的，处置期限为6个月';
                    $chuzhi_qixian = '6';
                }
            }
        }else{
            if($xinhui_cishu>=2){
                $chuzhi_jieguo = '因行贿犯罪被判处三年以上有期徒刑或有两次以上行贿犯罪记录的，处置期限为自刑罚执行完毕之日起3年';
                $chuzhi_qixian = '36';
            }else{
                    if ($xingqi == 1) {
                        $chuzhi_jieguo = '因行贿犯罪被判处三年以上有期徒刑或有两次以上行贿犯罪记录的，处置期限为自刑罚执行完毕之日起3年';
                        $chuzhi_qixian = '36';
                    } elseif ($xingqi == 2) {
                        $chuzhi_jieguo = '因行贿犯罪被判处一年以上三年以下有期徒刑的，处置期限为自刑罚执行完毕之日起2年';
                        $chuzhi_qixian = '24';
                    } else {
                        $chuzhi_jieguo = '有其他行贿犯罪判决结果的，处置期限为自刑罚执行完毕之日起1年';
                        $chuzhi_qixian = '12';
                    }
            }
        }
        echo json_encode(array( "msg" => $chuzhi_jieguo,'cz_qi'=> $chuzhi_qixian));
    }


    /*
     *
     * 查询人员的相关操作
     *
     * */

    //查询列表
    public function lists(){

        //查询录入的信息
        $infomodel = new InfoModel;
        $where = array();
        $adminId = session('id');
        $keyword =  Request::instance()->param('keyword');
        $reasons =  Request::instance()->param('reasons');
        // $info = Db::table('ny_information')->select();
        //判断关键词是否存在， 如果不存在则是一个而不可查询的条件
        if(empty($keyword)){
            $where['status'] = -3;
        }else{
            $where['status'] = 1;
        }
       // 首次打开无关键字时，屏蔽表单展示
        if(!empty($keyword)) {
            $this->assign('condition', '1');
        } else {
            $this->assign('condition', 'n');
        }
        $data = array();
            
         if (!empty($keyword) && !empty($reasons)) {
            $whereOr = '';
            $where_1 = '';
            $where_2 = '';
            $where_1['username'] = array('like', "%$keyword%");
            $where_2['xinhui_money'] = array('like', "%$keyword%");
            $whereOr['cert_number'] = array('like', "%$keyword%");
            $whereOr['xinhui_cishu'] = array('like', "%$keyword%");
            $where_2['company_name'] = array('like', "%$keyword%");
            $where_2['input_name'] = array('like', "%$keyword%");
            $where_2['exam_name'] = array('like', "%$keyword%");
            $whereOr['jigouma'] = array('like', "%$keyword%");
            $where_2['boss_name'] = array('like', "%$keyword%");
            $info = Db::table('ny_information')
                        ->where('status','=',1)
                        ->where(function($query) use ($where_1, $whereOr, $where_2){
                            $query->where($where_1)
                                ->whereOr($whereOr)
                                ->whereOr($where_2);
                            })
                        ->order("input_time desc")
                        ->paginate(2,false,['query' => request()->param()]);
            $data['keyword'] = $keyword;
            $data['reasons'] = $reasons;
            $data['adminId'] = $adminId;
            // $de = json_encode($info);
            $find = '';
            foreach ($info as $key => $value) {
                $find .= ','.$value['information_id'];
            }
            $data['finds'] = ltrim($find,',');
            $data['find_time'] = time();
            $res = Db::table('ny_c_cx')->insertGetId($data);
            Session::set('chaxun_id','');
            Session::set('chaxun_id',$res);
            // var_dump(session('chaxun_id'));exit;
            // 获取分页显示false,['query' => request()->param()]
            $page = $info->render();
            // 模板变量赋值
            // var_dump($info);
            //exit;
            $this->assign('info', $info);
            $this->assign('page', $page);
            $this->assign('keyword', $keyword);
            $this->assign('reasons', $reasons);
        }





        return $this->fetch();
    }

    //查询信息
    public function lists_l(){

        //查询录入的信息
        $infomodel = new InfoModel;
        $where = array();
        $adminId = session('id');
        $keyword =  Request::instance()->param('keyword');
        // $info = Db::table('ny_information')->select();
        //判断关键词是否存在， 如果不存在则是一个而不可查询的条件
        if(empty($keyword)){
            $where['status'] = -3;
        }else{
            $where['status'] = 1;
        }
       // 首次打开无关键字时，屏蔽表单展示
        if(!empty($keyword)) {
            $this->assign('condition', '1');
        } else {
            $this->assign('condition', 'n');
        }
        $data = array();
            
         if (!empty($keyword)) {
            $whereOr = '';
            $where_1 = '';
            $where_2 = '';
            $where_1['username'] = array('like', "%$keyword%");
            $where_2['xinhui_money'] = array('like', "%$keyword%");
            $whereOr['cert_number'] = array('like', "%$keyword%");
            $whereOr['xinhui_cishu'] = array('like', "%$keyword%");
            $where_2['company_name'] = array('like', "%$keyword%");
            $where_2['input_name'] = array('like', "%$keyword%");
            $where_2['exam_name'] = array('like', "%$keyword%");
            $whereOr['jigouma'] = array('like', "%$keyword%");
            $where_2['boss_name'] = array('like', "%$keyword%");
            $info = Db::table('ny_information')
                        ->where('status','=',1)
                        ->where(function($query) use ($where_1, $whereOr, $where_2){
                            $query->where($where_1)
                                ->whereOr($whereOr)
                                ->whereOr($where_2);
                            })
                        ->order("input_time desc")
                        ->paginate(2,false,['query' => request()->param()]);
            $data['keyword'] = $keyword;
            $data['adminId'] = $adminId;
            // $de = json_encode($info);
            $find = '';
            foreach ($info as $key => $value) {
                $find .= ','.$value['information_id'];
            }
            $data['finds'] = ltrim($find,',');
            $data['find_time'] = time();
            $res = Db::table('ny_c_cx')->insertGetId($data);
            Session::set('chaxun_id','');
            Session::set('chaxun_id',$res);
            // var_dump(session('chaxun_id'));exit;
            // 获取分页显示false,['query' => request()->param()]
            $page = $info->render();
            // 模板变量赋值
            // var_dump($info);
            //exit;
            $this->assign('info', $info);
            $this->assign('page', $page);
            $this->assign('keyword', $keyword);
        }





        return $this->fetch();
    }

    //申请查询
    public function sq_chaxun(){
        if(Request::instance()->isPost()) {
            $adminId = session('id');// 取出当前管理员的ID
            $ChaxunModel = new ChaxunModel;
            //获取审核人的id
            $Company = session('company');
            $adminmodel = new AdminModel;
            $where['Company'] =$Company;
            $where['admin_role'] =1;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();

            $danwei_geren = Request::instance()->param('danwei_geren');
            $xinhui_fenlei = Request::instance()->param('xinhui_fenlei');
            $date_info['cx_username'] = Request::instance()->param('username');
            $date_info['chaxun_time'] = time();
            $date_info['chaxun_mouth'] = date("m",time());
            $date_info['phone'] = Request::instance()->param('phone');
            $date_info['chaxun_shiyou'] = Request::instance()->param('chaxun_shiyou');
            $date_info['info_id'] = Request::instance()->param('info_id');
            $date_info['chaxun_id'] = $adminId;
            $date_info['shenghe_id'] =$exam_name_id['id'];
            $date_info['status_chaxun'] =0;

            $query = $ChaxunModel->create($date_info);
            if ($query) {
                //统计表，向统计表里面一条数据
                $info_tjModel = new info_tjModel;
                $role_type = 0;
                $info_tjModel ->add_num($adminId,$role_type,$danwei_geren,$xinhui_fenlei);

                // $this->success('申请查询成功', 'Information/lists');
                $this->redirect('Information/lists');
            } else {
                $this->error('申请查询失败');
            }
        }
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info =$infomodel->where('information_id','=',$information_id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

    //查询审核列表
    public function cq_lst(){
        $adminId = session('id');// 取出当前管理员的ID
        //查询录入的信息
        $infomodel = new InfoModel;
        $info = $infomodel->get_all_sqchaxun($adminId);
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }
    //查询信息详情页
     public function lst_l_xiang(){
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $adminId = session('id');// 取出当前管理员的ID
        $chaxun_id = session('chaxun_id');//取出当前查询操作的记录的id值
        if(!$chaxun_id||$chaxun_id == 'null'){
                $this->error('处置时间已过期');
        }
        $recoder = array();//记录查询处置操作
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $info = $infomodel->get_info_xiang($information_id);
        $chuzi_info = $Chuzi_tongjiModel->where('info_id','=',$information_id)->where('cz_id','=',$adminId)->find();
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        //判断是否过处置时间
        if(time()>strtotime($daoqi_time)){
            $is_chuzhi = 0;
        }else{
            $is_chuzhi = 1;
        }
        $this->assign('is_chuzhi',$is_chuzhi);


        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        $this->assign('chuzi_info',$chuzi_info);
        return $this->fetch();
    }
    //查询(操作)信息详情页
    public function lst_xiang(){
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $adminId = session('id');// 取出当前管理员的ID
        $chaxun_id = session('chaxun_id');//取出当前查询操作的记录的id值
        if(!$chaxun_id||$chaxun_id == 'null'){
                $this->error('处置时间已过期');
        }
        $recoder = array();//记录查询处置操作
        // var_dump($chaxun_id);
        if(Request::instance()->isPost()) {
            //获取审核人的id
            $Company = session('company');
            $adminmodel = new AdminModel;
            $where['Company'] = $Company;
            $where['admin_role'] = 1;
            $exam_name_id =$adminmodel->field('id')->where($where)->find();

            $date['cz_id'] = $adminId;
            $date['cz_name'] = Request::instance()->param('cz_name');

            $date['info_id'] = Request::instance()->param('information_id');
            $date['chuzhi_jieguo'] = Request::instance()->param('chuzhi_jieguo');
            $date['chuzhi_time'] = time();
            $date['chuzhi_mouth'] = intval(date('m',time()));
            $date['sh_id'] = $exam_name_id['id'];
            $date['status_chaxun'] = 0;

            $query = $Chuzi_tongjiModel->create($date);
            if($query){
                $recoder['inf_id'] = $date['info_id'];
                $recoder['chaxun_id'] = $chaxun_id;
                $recoder['sq_name'] = $date['cz_name'];
                $recoder['cz_res'] = $date['chuzhi_jieguo'];
                $recoder['cz_time'] = time();
                $resl = Db::table('ny_c_chuzhi')->insert($recoder);
                if($resl){
                $this->redirect('Information/czsq_lst');
                }else{
                $this->error('提交处置失败');
                }
                // $this->success('提交处置成功','Information/czsq_lst');
            }else{
                $this->error('提交处置失败');
            }
        }
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $info = $infomodel->get_info_xiang($information_id);
        $chuzi_info = $Chuzi_tongjiModel->where('info_id','=',$information_id)->where('cz_id','=',$adminId)->find();
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        //判断是否过处置时间
        if(time()>strtotime($daoqi_time)){
            $is_chuzhi = 0;
        }else{
            $is_chuzhi = 1;
        }
        $this->assign('is_chuzhi',$is_chuzhi);


        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        $this->assign('chuzi_info',$chuzi_info);
        return $this->fetch();
    }

    //处置申请列表
    public function czsq_lst(){
        $adminId = session('id');// 取出当前管理员的ID
        //查询录入的信息
        $infomodel = new InfoModel;
        $info = $infomodel->get_all_czlst($adminId);
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }

    //修改处置情况
    public function edit_chuzi(){
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;

        if(Request::instance()->isPost()) {

            $date['id'] = Request::instance()->param('id');
            $date['cz_name'] = Request::instance()->param('cz_name');
            $date['chuzhi_jieguo'] = Request::instance()->param('chuzhi_jieguo');
            $date['chuzhi_time'] = time();
            $date['chuzhi_mouth'] = intval(date('m',time()));
            $query = $Chuzi_tongjiModel->update($date);
            if($query){
                // $this->success('修改处置结果成功','Information/czsq_lst');
                $this->redirect('Information/czsq_lst');
            }else{
                $this->error('提交处置结果失败');
            }
        }

        $id = Request::instance()->param('id');
        $chuzi_info = $Chuzi_tongjiModel->where('id','=',$id)->find();
        $information_id = $chuzi_info['info_id'];
        $info = $infomodel->get_info_xiang($information_id);
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        //判断是否过处置时间
        if(time()>strtotime($daoqi_time)){
            $is_chuzhi = 0;
        }else{
            $is_chuzhi = 1;
        }
        $this->assign('is_chuzhi',$is_chuzhi);


        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        $this->assign('chuzi_info',$chuzi_info);
        return $this->fetch();
    }

    //删除处置情况
    public function del_chuzi(){
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $id = Request::instance()->param('id');
        $query = $Chuzi_tongjiModel->where('id','=',$id)->delete();
        if($query){
            // $this->success('删除处置结果成功','Information/czsq_lst');
            $this->redirect('Information/czsq_lst');
        }else{
            $this->error('删除处置结果失败');
        }
    }

    //导出处置详情
    public function daochu_chuzi(){
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $adminId = session('id');// 取出当前管理员的ID
        //接受信息ID
        $id = Request::instance()->param('id');
        $chuzi_info = $Chuzi_tongjiModel->where('id','=',$id)->find();
        $information_id = $chuzi_info['info_id'];

        $info = $infomodel->get_info_xiang($information_id);
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        //判断是否过处置时间
        if(time()>strtotime($daoqi_time)){
            $is_chuzhi = 0;
        }else{
            $is_chuzhi = 1;
        }
        $this->assign('is_chuzhi',$is_chuzhi);
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        $this->assign('chuzi_info',$chuzi_info);
        return $this->fetch();
    }

    //导出word文档
    public function word(){
        $adminId = session('id');// 取出当前管理员的ID
        $id= Request::instance()->param('id');
        //获取信息 member_info
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $chuzi_info = $Chuzi_tongjiModel->where('id','=',$id)->find();
        $user_infos=$infomodel->where('information_id='.$chuzi_info['info_id'])->find();
        if(!empty($user_infos)){
            //echo '信息存在';
            $user_info=$user_infos;
            $this->up_out_word($user_info,$chuzi_info);
        }
    }

    //word文档函数
    protected function up_out_word($user_info,$chuzi_info){
        $bools = vendor('PHPWord.PhpWord');
        $PHPWord = new \PHPWord();
        //添加数据变量
        $danwei_geren = $user_info['danwei_geren'];
        $xinhui_fenlei = $user_info['xinhui_fenlei'];
        //个人
        $username = $user_info['username'];
        $age = $user_info['age'];
        $sex = $user_info['sex']==0?'男':'女';
        $education = $user_info['education'];
        $cert_number = $user_info['cert_number'];
        $address = $user_info['address'];
        $company= $user_info['company'];
        $position= $user_info['position'];
        //单位
        $company_name=$user_info['company_name'];
        $nature=$user_info['nature'];
        $jigouma=$user_info['jigouma'];
        $boss_name=$user_info['boss_name'];
        $boss_cert=$user_info['boss_cert'];
        $zuce_address=$user_info['zuce_address'];
        $office_address=$user_info['office_address'];

        $xinhui_money=$user_info['xinhui_money'];
        $xinhui_cishu=$user_info['xinhui_cishu'];
        $xinhui_time=date("Y-m-d",$user_info['xinhui_time']);
        $input_time=date("Y-m-d",$user_info['input_time']);
        $input_company=$user_info['input_company'];
        $input_name=$user_info['input_name'];
        $exam_name=$user_info['exam_name'];

        //行贿行为
        $behavior_xingwei=$user_info['behavior_xingwei'];
        //行贿犯罪
        $behavior_fanzui=$user_info['behavior_fanzui'];
        $panjuewenshu_id=$user_info['panjuewenshu_id'];
        $xingqi=$user_info['xingqi'];


        $chuzhi_biaozhun=$user_info['chuzhi_biaozhun'];
        $chuzhi_qixian=$user_info['chuzhi_qixian'];
        $qishi_time = $user_info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$user_info['chuzhi_qixian']." months", $qishi_time));
        // if($user_info['xinhui_fenlei']==0){
        //     $qishi_time = $user_info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$user_info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$user_info['xingqi']." months", $user_info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$user_info['chuzhi_qixian']." months", $qishi_time));
        // }
        $qishi_time = date("Y-m-d",$qishi_time);

        $cz_name = $chuzi_info['cz_name'];
        $sh_name = $chuzi_info['sh_name'];
        $chuzhi_time = date("Y-m-d",$chuzi_info['chuzhi_time']);
        $chuzhijieguo = $chuzi_info['chuzhi_jieguo'];

        require '/static/admin_an/template/template1.php';
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

    /*+
    ***
    **告知函
*/
    public function gaozhihan(){
        $adminId = session('id');// 取出当前管理员的ID
        $id= Request::instance()->param('id');
        //获取信息 member_info
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        $chuzi_info = $Chuzi_tongjiModel->where('id','=',$id)->find();
        $user_infos=$infomodel->where('information_id='.$chuzi_info['info_id'])->find();
        if(!empty($user_infos)){
            //echo '信息存在';
            $user_info=$user_infos;
            $this->out_gaozhihan($user_info,$chuzi_info);
        }
    }

    /**+*+*+*
    *导出告知函
    *
    *
    **/
    public function out_gaozhihan($user_info,$chuzi_info){
        $bools = vendor('PHPWord.PhpWord');
        $PHPWord = new \PHPWord();
        $adminId = session('id');// 取出当前管理员的ID
        $name = Db::view('admin','Company')->where('id='.$adminId)->find();
        $name = $name['Company'];
        $company= $user_info['company'];
        $company_name=$user_info['company_name'];
        $main = '经南阳市行贿“黑名单”信息平台查询，发现有行贿信息记录，根据《南阳市行贿“黑名单”信息平台管理办法》(试行)规定：在';
        $chuzhi_qixian=$user_info['chuzhi_qixian'];
        $qishi_time = $user_info['exam_time'];
        $daoqi_time =date("Y年m月d", strtotime("+".$user_info['chuzhi_qixian']." months", $qishi_time));
        $qishi_time = date("Y年m月d",$qishi_time);
        $chuzhijieguo = $chuzi_info['chuzhi_jieguo'];
        $chuzhi_time = date("Y年m月d",$chuzi_info['chuzhi_time']);
        $body = "期间，予以".$chuzhijieguo.'处理。';
        // $cz_name = $chuzi_info['cz_name'];
        // $sh_name = $chuzi_info['sh_name'];
        // $chuzhi_time = date("Y-m-d",$chuzi_info['chuzhi_time']);
        

        require '/static/admin_an/template/template2.php';
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
    /*
     *
     * 审核人员的相关操作
     *
     * */

    //录入审核列表
    public function my_exam(){
        $infomodel = new InfoModel;
        $adminId = session('id');// 取出当前管理员的ID
        //分页
        $where = array();
        $where['exam_name_id'] = array('eq', $adminId);
        $info  = $infomodel->get_all_info($where);
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }

    //审核录入操作
    public function examine(){
        if(Request::instance()->isPost()) {   //判断操作是否为post请求
            $date_info['information_id'] = Request::instance()->param('infoid');
            $date_info['status'] = Request::instance()->param('status');
            $date_info['exam_time'] =time();
            $infomodel = new InfoModel;
            $info_query = $infomodel->update($date_info);

            if ( $info_query) {
                // $this->success('审核成功', 'Information/my_exam');
                $this->redirect('Information/my_exam');
            } else {
                $this->error('审核失败');
            }
        }
        $information_id = Request::instance()->param('information_id');
        $infomodel = new InfoModel;
        $info = $infomodel->find($information_id);
        $qishi_time = $info['exam_time'];
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

    //查询审核列表
    public function exam_cx(){
        $adminId = session('id');// 取出当前管理员的ID
        //查询录入的信息
        $infomodel = new InfoModel;
        $info = $infomodel->get_all_shchaxun($adminId);

        // 获取分页显示
        $page = $info->render();
        $exam = array();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }

    //审核查询操作
    public function do_exam_cx(){
        $chaxunModel = new ChaxunModel;
        if(Request::instance()->isPost()) {
            $date_info['id'] = Request::instance()->param('id');
            $date_info['status_chaxun'] = Request::instance()->param('status_chaxun');

            $info_query = $chaxunModel->update($date_info);

            if ( $info_query) {
                // $this->success('审核成功', 'Information/exam_cx');
                $this->redirect('Information/exam_cx');
            } else {
                $this->error('审核失败');
            }
        }
        $id = Request::instance()->param('id');
        $info = $chaxunModel->where('id','=',$id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }


    //审核查询人员的处置列表
    public function  exam_chuzi(){
        $adminId = session('id');// 取出当前管理员的ID
        //查询录入的信息
        $infomodel = new InfoModel;
        $info = $infomodel->get_all_shcz($adminId);
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }

    //审核处置操作
    public function do_exam_chuzi(){
        $infomodel = new InfoModel;
        $Chuzi_tongjiModel = new Chuzi_tongjiModel;
        if(Request::instance()->isPost()) {   //判断操作是否为post请求
            $data['id'] = Request::instance()->param('id');
            $data['sh_name'] = Request::instance()->param('sh_name');
            $data['status_chaxun'] = Request::instance()->param('status_chaxun');

            $query = $Chuzi_tongjiModel->update($data);

            if($query){
                // $this->success('审核处置结果成功','Information/exam_chuzi');
                $this->redirect('Information/exam_chuzi');
            }else{
                $this->error('审核处置结果失败');
            }
        }
        $id = Request::instance()->param('id');
        $chuzi_info = $Chuzi_tongjiModel->where('id','=',$id)->find();
        $information_id = $chuzi_info['info_id'];

        $info = $infomodel->get_info_xiang($information_id);
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // if($info['xinhui_fenlei']==0){
        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['xingqi']." months", $info['input_time']);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        //判断是否过处置时间
        if(time()>strtotime($daoqi_time)){
            $is_chuzhi = 0;
        }else{
            $is_chuzhi = 1;
        }
        $this->assign('is_chuzhi',$is_chuzhi);


        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        $this->assign('chuzi_info',$chuzi_info);
        return $this->fetch();
    }


    /*
     *
     *超级管理员操作
     */

    //审核修改删除列表
    public function exam_edit_del(){
        $infomodel = new InfoModel;
        $adminId = session('id');// 取出当前管理员的ID
        //判断是否为超
        $AdminModel = new AdminModel();
        $ad_info = $AdminModel->where('id','=',$adminId)->find();
        if($ad_info['admin_role'] == 0){
            $info  = $infomodel->get_all_editdel($adminId);
            $is_root=1;//是超级管理员
        }else{
            $info  = $infomodel->get_all_shenhe_editdel($adminId);
            $is_root=0;
        }
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('is_root',$is_root);
        $this->assign('info', $info);
        $this->assign('page', $page);

        return $this->fetch();
    }

    //做修改删除操作
    public function do_lu_ex(){
        $EditdelModel = new EditdelModel;
        $InfoModel = new InfoModel;
        $sq_id = Request::instance()->param('sq_id');
        list($sq_id,$is_root) = explode('-', $sq_id);
        $info = $EditdelModel->where('sq_id','=',$sq_id)->find();
        if(Request::instance()->isPost()) {
            if($is_root==1)
            {
                $dete['sq_id'] = Request::instance()->param('sq_id');
                $dete['status_sq'] = Request::instance()->param('status_sq');
                    Db::startTrans();
                    try {
                    $con = $EditdelModel->update($dete);
                    if(!$con){
                        throw new Exception("审核失败", 1);
                        
                    }
                    $where['status'] = 0;
                    $where['information_id'] = $info['info_id'];
                    $res = $InfoModel->update($where);
                    if(!$res){
                        throw new Exception("审核失败", 1);
                    }
                    Db::commit();
                } catch (\Exception $e) {
                    Db::rollback();
                }
                if($res){
                    $this->redirect('Information/exam_edit_del');
                }else{
                    $this->error('审核失败', 'Information/exam_edit_del');
                }
                
            }else{
                $dete['sq_id'] = Request::instance()->param('sq_id');
                $dete['shenhe_status'] = Request::instance()->param('shenhe_status');
                if ( $EditdelModel->update($dete)) {
                // $this->success('审核成功', 'Information/exam_edit_del');
                $this->redirect('Information/exam_edit_del');
                } else {
                    $this->error('审核失败');
                }
            }
            
        }
        $this->assign('info',$info);
        $this->assign('is_root',$is_root);
        return $this->fetch();
    }

    //录入情况审核状态列表
    public function lu_ex_lst(){
        $infomodel = new InfoModel;
        $info  = $infomodel->get_allpeople_info();
        // 获取分页显示
        $page = $info->render();
        // 模板变量赋值
        $this->assign('info', $info);
        $this->assign('page', $page);
        return $this->fetch();
    }

    //录入情况与审核的详情页
    public function lu_ex_xiang(){
        $infomodel = new InfoModel;
        //接受信息ID
        $information_id = Request::instance()->param('information_id');
        $info = $infomodel->get_info_xiang($information_id);
        $qishi_time = $info['exam_time'];
        $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        //区别行贿分类
        if($info['xinhui_fenlei']==0){
            $info['xinhui_fenlei']='行贿行为';
        }else{
            $info['xinhui_fenlei']='行贿犯罪';
        }
        // if($info['xinhui_fenlei']==0){

        //     $qishi_time = $info['input_time'];
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }else{
        //     $qishi_time = strtotime("+".$info['chuzhi_qixian']." months", $info['input_time']);
        //     var_dump($qishi_time);
        //     $daoqi_time =date("Y-m-d", strtotime("+".$info['chuzhi_qixian']." months", $qishi_time));
        // }
        $this->assign('qishi_time',$qishi_time);
        $this->assign('daoqi_time',$daoqi_time);

        $this->assign('info',$info);
        return $this->fetch();
    }
}
?>