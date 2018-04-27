<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class NewsController extends InitController {
    public function Index(){
    	if(!empty($_GET['type'])){
    		$where['newslabel']=$_GET['type'];
    		$data['typeid']=$_GET['type'];
    	}

    	$data['Newslabel']=M('Newlabel')->select();
    	
    	$Model=M('News');
    	$count=$Model->where($where)->count();
    	$Page =new \Think\Page($count,10);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');
		
		
		$data['news']=$Model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();

		$data['rmnews']=$Model->order('istj desc,clicknumber desc')->limit(10)->select();

		$data['rmgl']=$Model->where('newslabel=4')->order('istj desc,clicknumber desc')->limit(10)->select();
    	$this->assign(array(

    				'data'           =>$data,
    				'show'           =>$Page->show(),
    				'display'        =>7,
    		));
    	$this->display('Index');
    }

    public function Content(){
        $where['id']=$_GET['id'];
        $data=M('News')->where($where)->find();
        //获取到以前的点击次数
        $data['clicknumber']++;
        $newdata['clicknumber']=$data['clicknumber'];

        M('News')->where($where)->data($newdata)->save();
        //热门推荐
        $dataselect['game']=M('Gameinfo')->limit(20)->order('downloadcount desc')->select();
        //当前游戏
        $nowGame=M('Gameinfo')->field("gamename,details")->where("id=".$data['game'])->find();
        $this->assign(array(
                        'nowGame'=>$nowGame,
                        'data'=>$data,
                        'dataselect'=>$dataselect,
                        'display'        =>7,
            ));
        $this->display('Content');
    }

    //客服
    public function Kf(){
        $config=M('Webconfig')->find();
        $this->assign(array(
                    'data'  =>$config,
                    'display'=>8,
            ));
        $this->display('Kf');
    }
}