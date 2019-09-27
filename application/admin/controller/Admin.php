<?php
namespace app\Admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class Admin extends Controller
{
    public function role()
    {
        return $this->fetch('admin-role');
    }
   /**
    * 添加角色页面
    */
    public function addrole(){
        $node=Db::name('node')->where('pid',0)->select();
        foreach ($node as $key => $value) {
			$child=Db::name('node')->where('pid',$value['node_id'])->select();
			$data[$key]=$value;
			$data[$value['ename']]=$child;
        }
        dump($data);
        return $this->fetch('admin-role-add',['data'=>$data]);
    }
    
}