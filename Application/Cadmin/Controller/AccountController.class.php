<?php 
namespace Cadmin\Controller;
/*
*
*账户管理
*/
class AccountController extends BaseController{
    public function index(){
        $this->assign('channelName','账户管理');
        //实例化model类
        $mod=M("User");
        //用户搜索
        $where=array();
        $where['power']=1;
        //获取get值
        $where['username']=array("like","%{$_GET['mid']}%");
        //获取总条数
        $total=$mod->where($where)->count();
        //实例化分页类
        $page=new\Think\Page($total,4);
        //分配变量
        $item=$mod->where($where)->limit($page->firstRow,$page->listRows)->select();
        //设置分页的config
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig('theme',"<ul class='pagination'><li><a>共%TOTAL_ROW% %FIRST%条数据%NOW_PAGE%/%TOTAL_PAGE% 页</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li></ul>");
        //前台展示
        $show=$page->show();
        $this->assign('pagination',$show);  //赋值分页输出
        $this->assign("items",$item);
        $this->assign("mid",$_GET['mid']);
        $this->display("index");
    }
    public function rubbish(){
       $this->assign('channelName','账户管理');
        //实例化model类
        $mod=M("User");
        //用户搜索
        $where=array();
        $where['power']=0;
        //获取get值
        $where['username']=array("like","%{$_GET['mid']}%");
        //获取总条数
        $total=$mod->where($where)->count();
        //实例化分页类
        $page=new\Think\Page($total,4);
        //分配变量
        $item=$mod->where($where)->limit($page->firstRow,$page->listRows)->select();
        //设置分页的config
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        $page->setConfig('theme',"<ul class='pagination'><li><a>共%TOTAL_ROW% %FIRST%条数据%NOW_PAGE%/%TOTAL_PAGE% 页</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li></ul>");
        //前台展示
        $show=$page->show();
        $this->assign('pagination',$show);  //赋值分页输出
        $this->assign("items",$item);
        $this->assign("mid",$_GET['mid']);
        $this->display('rubbish');
    }
    public function del(){
        //实例化model类
        $mod=M("User");
        //执行删除
        if($mod->delete($_GET['id'])){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");

        }
    }
    public function restore(){
        //实例化model类
        $mod=M("User");
        //查询
        $data['id']=I("get.id");
        $data['power']=1;
        //封装信息
        if(!$mod->create($data)){
           $this->error($mod->getError()); 
        }
        //执行还原
        if($mod->save()){
            $this->success("修改成功",U("Account/index"));
        }else{
            $this->error("修改失败");
        }
    }
    public function shield(){
        //实例化model类
        $mod=M("User");
        //查询
        $data['id']=I("get.id");
        $data['power']=0;
        //封装信息
        if(!$mod->create($data)){
           $this->error($mod->getError()); 
        }
        //执行还原
        if($mod->save()){
            $this->success("修改成功",U("Account/rubbish"));
        }else{
            $this->error("修改失败");
        }
    }
   
} 