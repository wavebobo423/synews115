<?php 
namespace Cadmin\Controller;
/*
*
*后台公共控制器
*/
class PublicController extends BaseController{

    public function index(){
        if(IS_POST){
           $pass=$_POST['pwd'];
           $name = session('name');
           $model=M("Admin");
           $row=$model->where("username='$name'")->data("password='{$pass}'")->save();
           if($row){
              $this->success("修改成功");
           }else{
              $this->error("修改失败");
           }
        }
        $this->display();
    }
    public function signout(){
        setCookie('session_name()','',time()-3600,'/');
        session('name',null);
        session_destroy();
        $this->redirect('Index/index');
    }
    public function edit(){
        $name = session('name');
        $mod  = M('Admin');

        $map['username']  = $name;
        $item = $mod->where($map)->select();
        $this->assign('item',$item);
        $this->display('edit');

    }
    public function check(){
        $newname=I('post.name');
        $map['username']=$newname;
        $data=getData('Aduser',$map);
        if(count($data)){  //判断用户是否已经存在
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }

    }
    public function show(){
        // $Game=M('Gameinfo')->field("id,gamename")->limit(5)->select();
        $Gamedown=M('Appdown')->field("count(ip) as gcount,gid")->limit(5)->order("gcount desc")->group("gid")->select();
        $GameDun=M('Appdown')->field("duan")->select();
        // dump($Gamedown);die;
        $newdata=array();
        foreach($Gamedown as $key=>$val){
          $newdata[]=$val;
          $Gameinfo=M('Gameinfo')->find($val['gid']);
          $newdata[$key]['gname']=$Gameinfo['gamename'];
        }
        $Duan=array();
        foreach ($GameDun as $key1 => $value1) {
              if($value1['duan']=="PC"){
                  $Duan['pc'][]=$value1['duan'];
              }
              if($value1['duan']=="WAP"){
                  $Duan['wap'][]=$value1['duan'];
              }
        }
        // dump($Duan);die;
        $this->assign(array(
                        'data'=>$newdata,
                        'duan'=>$Duan,
            ));
        $this->display('Public/index');
    }

    public function game(){
        $newdata=M('Weekys')->select();
        $this->assign(array(
                        'data'=>$newdata,
            ));
        $this->display('Public/game');
    }

    public function add(){
        if(IS_POST){
            

            $data=$_POST;
            $data['week']=strtotime($_POST['week']);
            $result=M('Weekys')->data($data)->add();
            if($result>0){
                $this->success("添加完成",U('game'));
                die;
            }
        }
        $this->assign(array(
                        'url'=>"add",
            ));
       $this->display('add');
    }
}