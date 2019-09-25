<?php
namespace app\Admin\controller;
use think\Db;
use think\Controller;

class Channel extends Controller{
    public function list(){
        $channel_list=Db::name('channel')->select();
        dump($channel_list);
        return $this->fetch('channel-list',['channel_list'=>$channel_list]);
    }
    //渠道用户添加
    public function add(){
        if (request()->isPost()) {
            $data=input('post.');
            //实例化验证类
            $validate=validate('Channel');
            //调用check方法进行验证
            if (!$validate->check($data)) {
                if ($validate->getError()=='channel_phone已存在') {
                    $this->return_msg('404','手机号码已存在');
                }
            }
            $data['channel_pwd']=md5($data['channel_pwd'].config('code.password_pre_halt'));
            //进行插入
            try {
                $id=Db::name('channel')->insert($data);
                    //判断是否插入成功
                if ($id) {
                    $this->return_msg('200','添加成功');
                }else{
                    $this->return_msg('400','添加失败');
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            
        }else{
            return $this->fetch('channel-add');
        }
    }
    public function return_msg($code,$msg='',$data=[]){
            $return_data['code']=$code;
            $return_data['msg']=$msg;
            $return_data['data']=$data;
            echo json_encode($return_data);die;
    }
}



?>