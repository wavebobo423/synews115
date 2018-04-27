<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class GameController extends InitController {
    public function Index()
    {	

    	if($_GET['os']==1){
    		$_SESSION['os']='';
    		$_SESSION['os']=1;
    		$_SESSION['androiddownload']=array('neq',"");
    	}else if($_GET['os']==2){
    		$_SESSION['os']='';
    		$_SESSION['os']=2;
    		$_SESSION['iosdownload']=array('neq',"");
    	}else if($_GET['os']=="a"){
    		$_SESSION['os']="";
    		$_SESSION['androiddownload']="";
    		$_SESSION['iosdownload']='';
    	}

    	if($_GET['bb']==2){
    		$_SESSION['bb']=19;
    		$_SESSION['_string']="find_in_set('19',label)";
    	}else if($_GET['bb']==1){
    		$_SESSION['bb']="";
    		$_SESSION['_string']="";
    	}
    	

    	if($_GET['lx']!="a"){
    		$_SESSION['lx']=$_GET['lx'];

    	}else{
    		$_SESSION['lx']='';

    	}

    	
    	if(!empty($_SESSION['iosdownload'])){
    		$where['iosdownload']=$_SESSION['iosdownload'];
    	}

    	if(!empty($_SESSION['androiddownload'])){
    		$where['androiddownload']=$_SESSION['androiddownload'];
    	}
    	if(!empty($_SESSION['_string'])){
    		$where[]="find_in_set('19',label)";
    	}

    	if(!empty($_SESSION['lx'])){
    		$where[]="find_in_set ('".$_SESSION['lx']."',label)";
    	}

    	if($_GET['action']==2){
    		$neworder="downloadcount desc";
    	}else{
    		$neworder="id desc";
    	}
    	$Model=M('Gameinfo');
    	$count=$Model->where($where)->count();
    	$Page =new \Think\Page($count,18);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');
        $Page->setConfig('url','Gamepage');

		
        //获取今天更新的时间
        $day_00=strtotime(date('Y-m-d',time()));

        $day_24=strtotime(date('Y-m-d',time()+60*60*24));

		$data['game']=$Model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($neworder)->select();
		// echo $Model->getLastSql();
		$Gamelabel=M('Gamelabel')->select();

        $daycount=$Model->where("gametime>".$day_00." AND gametime<".$day_24)->count();

		$this->assign(array(
					'Game'     =>$data['game'],
					'show'     =>$Page->show(),
					'action'   =>$_GET['action'],
					'display'  =>2,
					'Gamelabel'=>$Gamelabel,
                    'count'    =>$count,
                    'daycount' =>$daycount,
			));

    	$this->display('Index');
    }

  

    public function Game()
    {
        if(!empty($_GET['id'])){
            $Game=M('Gameinfo')->find($_GET['id']);
        }else{
            $Game=M('Gameinfo')->where("seourl='".$_GET['seourl']."'")->find();
        }
    
        //获取游戏开服
        $GameKaifu=M('Kaifu')->where("gamename='".$Game['gamename']."'")->select();

        //热门推荐
        $RemenGame=M('Gameinfo')->where('score!=""')->limit(20)->order('score desc')->select();

        $News=M('News')->where("game='".$_GET['id']."'")->select();

        $this->assign(array(
                        'Game'         =>$Game,
                        'Kaifu'        =>$GameKaifu,
                        'RemenGame'    =>$RemenGame,
                        'News'         =>$News,
            ));
    	$this->display('Game');
    }

    public function IOS()
    {
        $Game=M('Gameinfo')->find($_GET['id']);

        //获取游戏开服
        $GameKaifu=M('Kaifu')->where("gamename='".$Game['gamename']."'")->select();
        
        //热门推荐
        $RemenGame=M('Gameinfo')->where('score!=""')->limit(20)->order('score desc')->select();

        $News=M('News')->where("game='".$_GET['id']."'")->select();

        $this->assign(array(
                        'Game'         =>$Game,
                        'Kaifu'        =>$GameKaifu,
                        'RemenGame'    =>$RemenGame,
                        'News'         =>$News,
            ));
        $this->display('Game');
    }

    //安卓下载统计
    public function Downapk(){
        $url=M('Gameinfo')->field('androiddownload,id,gamename')->find($_GET['id']);
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        $data['gid']=$url['id'];
        $data['gname']=$url['gamename'];
        $data['duan']="PC";
        $data['create_time']=time();
        $data['phone']="apk";
        M('Appdown')->data($data)->add();
        header("Location:".$url['androiddownload']);
        die("如果下载不了请添加客服微信btsy115获取下载地址!");
    }

     //IOS下载统计
    public function Downios(){
        $url=M('Gameinfo')->field('iosdownload,id,gamename')->find($_GET['id']);
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        $data['gid']=$url['id'];
        $data['gname']=$url['gamename'];
        $data['duan']="PC";
        $data['create_time']=time();
        $data['phone']="IOS";
        M('Appdown')->data($data)->add();
        if($url['iosdownload']=="#"){
            $this->error("下载地址不正确,请联系客服获取最新的下载地址~");
            die;
        }else{
            header("Location:".$url['iosdownload']);
        }
        
        die("如果下载不了请添加客服微信btsy115获取下载地址!");
    }
}