<?php  
namespace Cadmin\Controller;
use Think\Controller;
class SigninController extends Controller{
    public function index(){
        
        $this->display('Index/index');
    }
    
    //后台登录
    public function signin(){
        $data=M('Admin');
        $where['name']=I('post.name');
        $where['pass']=I('post.pass');
        $list=$data->where($where)->find();
        if($list==null){
            $this->ajaxReturn(0);
        }else{
           session('level',$list['level']);
           session('name','name1');
           $data1['logintime']=time();
           $data1['ip']       =$_SERVER['REMOTE_ADDR'];
           $data->where($where)->data($data1)->save();
           $this->ajaxReturn(1);
        }
    }
}