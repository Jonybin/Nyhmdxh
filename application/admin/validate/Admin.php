<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:55|unique:admin',
        'Company'  =>  'require|max:55',
        'password'  =>  'require|alphaNum',
        'cpassword'  =>  'require|confirm:password',
        'is_use'  =>  'require',
        'admin_role'  =>  'require',

    ];
    protected $message  =   [
        'username.require' => '管理员账户必须',
        'username.max' => '管理员账户不能大于55个字符',
        'Company.require' => '单位必须',
        'Company.max' => '单位不能大于55个字符',
        'username.unique' => '管理员账户已存在',
        'password.max' => '管理员密码必须',
        'password.alphaNum' => '管理员密码必须字母或数字',
        'cpassword.require' => '第二次密码必须',
        'cpassword.confirm' => '两次密码不一致',
        'is_use.require' => '是否启用必须',
        'admin_role.require' => '担任角色必须',
    ];
}
?>