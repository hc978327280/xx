<?php
namespace app\Admin\controller;
use think\Db;
use think\Controller;
use think\Request;

class Channel extends Controller{
    public function list(){
        $channel_list=Db::name('channel')->where('is_del',0)->paginate(2,false,['query' => request()->param()]);
        //当前页
        $data = Request::instance() -> param();
        if(!isset($data['page'])){
            $data['page'] = 1; 
        }
        $this -> assign('page',$data['page']);
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
            $data['add_time']=date('Y-m-d H:i:s');
            $data['channel_mima']=$data['channel_pwd'];
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
    /**
     * 详情
     */
    public function deta(){
        $id=input('id');
        $cha_list=Db::name('channel')->find($id);
        if (request()->isPost()) {
            $data['channel_mima']='123456';
            $data['channel_pwd']=md5('123456'.config('code.password_pre_halt'));
            $data['user_time']=date('Y-m-d H:i:s');
            $res=Db::name('channel')->where('channel_id',$id)->update($data);
            if ($res) {
                $this->return_msg('200','重置密码成功');
            }else{
                $this->return_msg('404','重置密码');
            }
        }
            return $this->fetch('channel-xq',['cha_list'=>$cha_list]);
    }
    /**
 * 编辑
 */
    public function edit(){
        $id=input('id');
        $cha_list=Db::name('channel')->find($id);
        
        if (request()->isPost()) {
            $data=input('post.');
            $res=Db::name('channel')->where('channel_id','NEQ',$id)->select();
            foreach ($res as $key => $value) {
               if ($value['channel_phone']==$data['channel_phone']) {
                    $this->return_msg('404','手机号已存在');
                }
            }
            $data['user_time']=date('Y-m-d H:i:s');
            $data['channel_mima']=$data['channel_pwd'];
            $data['channel_pwd']=md5($data['channel_pwd'].config('code.password_pre_halt'));
            
            //进行插入
            try {
               $up=Db::name('channel')->where('channel_id',$id)->update($data);
                    //判断是否修改成功
                if ($up) {
                    $this->return_msg('200','添加成功');
                }else{
                    $this->return_msg('400','添加失败');
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return $this->fetch('channel-edit',['cha_list'=>$cha_list]);
    }
    /**
     * 删除
     */
    public function del(){
        if (request()->isPost()) {
            $id=input('id');
            try {
                $del=Db::name('channel')->where('channel_id',$id)->update(array('is_del'=>1));
                if ($del) {
                    $this->return_msg('200','删除成功');
                }else{
                    $this->return_msg('404','删除失败');
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
       
    }
    /**
     * 批量处理审核状态
     */
    public function chk(){
        if (request()->isAjax()) {
            $id=input('id');
            $audit=input('aid');
            //判断是否选中
            if (!empty($id)) {
                try {
                    $id=ltrim(input('id'),',');
                    $res=Db::name('channel')->where("channel_id in ($id)")->update(array('audit'=>$audit));
                    if ($res) {
                        $this->return_msg('200','批量审核成功');
                    }else{
                        $this->return_msg('404','批量审核失败');
                    }
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
           
        }

    }
}


?>