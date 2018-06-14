<?php
namespace app\admin\validate;

use think\Validate;

class Information extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:25',
        'age'   => 'require|number|between:1,120',
        'education'   => 'require',
        'cert_number'   => 'require|alphaNum',
        'address'   => 'require',
        'company'   => 'require',
        'position'   => 'require',
        'company_name'   => 'require',
        'nature'   => 'require',
        'jigouma'   => 'require',
        'boss_name'   => 'require|max:25',
        'boss_cert'   => 'require|alphaNum',
        'zuce_address'   => 'require',
        'office_address'   => 'require',
        'xinhui_cishu'   => 'require|number',
        'xinhui_time'   => 'require',
        'input_time'   => 'require',
        'input_company'   => 'require',
        'exam_name_id'   => 'require',
        'behavior'   => 'require',
        'bribery_xijie'   => 'require',
        'xinhui_money'   => 'require',
    ];
    protected $message  =   [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过25个字符',
        'age.require'   => '年龄必须',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'education.require'  => '教育必须',
        'cert_number.require'  => '身份证必须',
        'cert_number.alphaNum'  => '身份证数字或者字母',
        'address.require'  => '地址必须',
        'company.require'  => '所在单位必须',
        'position.require'  => '职务必须',
        'company_name.require'  => '单位名称必须',
        'nature.require'  => '性质必须',
        'jigouma.require'  => '机构码必须',
        'boss_name.require'  => '法定人姓名必须',
        'boss_name.max'     => '法定人名称最多不能超过25个字符',
        'boss_cert.require'  => '法定人身份证必须',
        'boss_cert.alphaNum'  => '法定人身份证数字或者字母',
        'zuce_address.require'  => '注册地必须',
        'office_address.require'  => '办公场所必须',
        'xinhui_cishu.require'   => '行贿次数必须',
        'xinhui_cishu.number'   => '行贿次数必须是数字',
        'xinhui_time.require'   => '行贿时间必须',
        'input_time.require'   => '录入时间必须',
        'input_company.require'   => '录入单位必须',
        'exam_name_id.require'   => '录入人员必须',
        'behavior.require'   => '事实经过必须',
        'bribery_xijie.require'   => '行贿情节必须',
        'xinhui_money.require'   => '行贿数额必须',
    ];

}?>