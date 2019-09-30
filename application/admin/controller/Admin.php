<?php
namespace app\Admin\controller;
use think\Db;
use think\Controller;
use think\Cache;

class Admin extends Controller
{
    public function role()
    {   
        $role=Db::name('role')->where('is_del',0)->select();
        return $this->fetch('admin-role',['role'=>$role]);
    }
   /**
    * 添加角色页面
    */
    public function addrole(){
        if (request()->isPost()) {
            $data=input('post.');
            $role['role_name']=$data['role_name'];
            $role['level']=$data['level'];
            $role['nw']=$data['nw'];
            //实例化验证类
            $validate=validate('Role');
            //调用check方法进行验证
            if (!$validate->check($data)) {
                if ($validate->getError()) {
                    $this->return_msg('404','名字已存在');
                }
            }
             //进行插入
             try {
                $id=Db::name('role')->insert($role);
                //最后一次插入的id
                $rid=Db::name('role')->getLastInsID();
                foreach ($data['nid'] as $key => $value) {
                    $info=Db::name('role_node')->where('rid',$rid)->where('nid',$value)->find();
                    //判断该节点是否已经添加
                    if (!$info) {
                        $res[$key]['rid']=$rid;
                        $res[$key]['nid']=$value;
                        
                    }
        
                }
                // dump($res);
                // return json_encode($res);
                $result=Db::name('role_node')->insertAll($res); //判断是否插入成功
                if ($id && $result==count($res)) {
                    $this->return_msg('200','添加成功');
                }else{
                    $this->return_msg('400','添加失败');
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }else{
            if (Cache::get('node')) {
                $node=Cache::get('node');
                $this->assign('node',$node);
            }else{
                $node=Db::name('node')->where('node_level',0)->select();
                $this->assign('node',$node);
                Cache::set('node',$node);
            }
            if (Cache::get('nodes')) {
                $node=Cache::get('nodes');
                $this->assign('nodes',$node);
            }else{
                $node=Db::name('node')->where('node_level',1)->select();
                $this->assign('nodes',$node);
                Cache::set('nodes',$node);
            }
            return $this->fetch('admin-role-add');
        }
       
    }
    public function return_msg($code,$msg='',$data=[]){
        $return_data['code']=$code;
        $return_data['msg']=$msg;
        $return_data['data']=$data;
        echo json_encode($return_data);die;
}
    /**
     * 编辑角色权限
     */
    public function editrole(){
            $role_id=input('role_id');
            
            // dump($info);
        if (request()->isPost()) {
            $data=input('post.');
            $info=Db::name('role')->where('role_id','neq',$data['id'])->field('role_name')->select();
            foreach ($info as $value) {
               if ($value['role_name']==$data['role_name']) {
                    $this->return_msg('404','用户名已存在');
                }
            } 
            $name['role_name']=$data['role_name'];
                $name['level']=$data['level'];
                $name['nw']=$data['nw'];
                $res1=Db::name('role')->where('role_id',$data['id'])->update($name);
                $res2=Db::name('role_node')->where('rid',$data['id'])->delete();
                    foreach ($data['nid'] as $key => $value) {
                        $data1[$key]['rid']=$data['id'];
                        $data1[$key]['nid']=$value;
        
                    }
                $result1=Db::name('role_node')->insertAll($data1);
                if ($result1==count($data1)) {
                    $this->return_msg('200','修改成功');
                }
            //开启事务
            // Db::startTrans();
            // try {
            //     $name['role_name']=$data['role_name'];
            //     $name['level']=$data['level'];
            //     $name['nw']=$data['nw'];
            //     $res1=Db::name('role')->where('role_id',$data['id'])->update($name);
            //     // $res2=Db::name('role_node')->where('rid',$data['id'])->delete();
            //     //     foreach ($data['nid'] as $key => $value) {
            //     //         $data1[$key]['rid']=$data['id'];
            //     //         $data1[$key]['nid']=$value;
        
            //     //     }
            //     // $result1=Db::name('role_node')->insertAll($data1);
            //     if ($res1) {
            //         $this->return_msg('200','修改成功');
            //     }
            //     Db::commit();
            // } catch (\Exception $e) {
            //     Db::rollback();
            //     return $e->getMessage();
            // }

        }else{
            if (Cache::get('node')) {
                $node=Cache::get('node');
                $this->assign('node',$node);
            }else{
                $node=Db::name('node')->where('node_level',0)->select();
                $this->assign('node',$node);
                Cache::set('node',$node);
            }
            if (Cache::get('nodes')) {
                $node=Cache::get('nodes');
                $this->assign('nodes',$node);
            }else{
                $node=Db::name('node')->where('node_level',1)->select();
                $this->assign('nodes',$node);
                Cache::set('nodes',$node);
            }
            //回填数据
            $role=Db::name('role')->find($role_id);
            // 获取当前角色拥有的权限节点
            $res=Db::name('role_node')->where('rid',$role_id)->field('nid')->select();
            if ($res) {
				foreach($res as $key=>$value){
				$result[]=$value['nid'];
				$this->assign('result',$result);
			    }
		    }
            return $this->fetch('admin-role-edit',['role'=>$role]);
        }
    }
    /**
     * 权限用户组删除
     */
    public function delrole(){
        if (request()->isAjax()) {
            $role_id=input('id');
            try {
                $del=Db::name('role')->where('role_id',$role_id)->update(array('is_del'=>1));
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
    
}