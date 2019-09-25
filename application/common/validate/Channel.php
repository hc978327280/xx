<?php
namespace app\common\validate;
use think\Validate;
class Channel extends Validate{
    protected $rule = [
        'channel_user_name'=>'require|max:16|chs',
        'channel_company'=>'require|max:20|chs',
        'channerl_name'=>'require|max:20|chs',
        'channel_login'=>'require|max:12|chsDash',
        'channel_pwd'=>'require|max:20/',
        'channel_vx'=>'require|max:20',
        'channel_phone'=>'require|max:11|unique:channel',
        'channel_qq'=>'require|max:20',
    ];
    protected $msg=[
        'channel_user_name.require'=>'名称必须',
        'channel_user_name.chs'=>'名称必须是中文',
        'channel_company.require'=>'公司名称必须',
        'channel_company.chs'=>'公司名称必须是中文',
        'channel_name.require'=>'渠道名名称必须',
        'channel_name.chs'=>'渠道名称必须是中文',
        'channel_login.require'=>'登陆账号必须',
        'channel_login.chsDash'=>'登陆账号只能是只能是汉字、字母、数字和下划线_及破折号',
        'channel_pwd.require'=>'登陆密码必须',
        'channel_vx.require'=>'微信必须',
        'channel_phone.require'=>'电话号码必须',
        'channel_phone.unique'=>'电话号码已存在',
        'channel_qq.require'=>'QQ号码必须',
    ];
}








?>