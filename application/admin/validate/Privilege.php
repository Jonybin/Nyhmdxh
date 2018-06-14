<?php
namespace app\admin\validate;

use think\Validate;

class Privilege extends Validate
{
    protected $rule = [
        'pri_name'  =>  'require|max:25',
        'module_name'  =>  'require|alphaNum',
        'controller_name'  =>  'require|alphaNum',
        'action_name'  =>  'require|alphaDash',
        'parent_id'  =>  'require|number',
    ];
    protected $message  =   [
        'pri_name.require' => '权限名称必须',
        'username.max'     => '权限名称最多不能超过25个字符',
        'module_name.require'   => '模块名称必须',
        'module_name.alphaNum'   => '模块名称数字或者字母',
        'controller_name.require'   => '控制器名称必须',
        'controller_name.alphaNum'   => '控制器名称数字或者字母',
        'action_name.require'   => '方法名称必须',
        'action_name.alphaDash'   => '方法名称数字或者字母或下划线',
        'parent_id.require'   => '父级id名称必须',
        'parent_id.number'   => '父级id必须为数字',

    ];
}