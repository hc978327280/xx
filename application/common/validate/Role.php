<?php
namespace app\common\validate;
use think\Validate;
class Role extends Validate{
    protected $rule = [
        'role_name'=>'require|max:15|unique:role',
    ];
    protected $msg=[
        'role_name.unique'=>'名字已存在',
    ];
}








?>