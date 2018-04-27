<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class IndexController extends InitController {
    public function Index(){


    	$model=D('Gameinfo');

        $news="aaa";

        // redis缓存时间
        $redisTime=86400;

        $data['Game']=S('Gameinfo');

    	//所有游戏信息
        if(!$data['Game']){
            $data['Game']=$model->newGame();
            S('Gameinfo',$data['Game'],$redisTime);
        }

        //推荐游戏
        $data['Tuijian']=S('Tuijian');
        if(!$data['Tuijian']){
            $data['Tuijian']=$model->Tuijian();
            S('Tuijian',$data['Tuijian'],$redisTime);
        }

        //热门推荐
        $data['Remen']=S('Remen');
        if(!$data['Remen']){
            $data['Remen']=$model->Rementuijian();
            S('Remen',$data['Remen'],$redisTime);
        }
        //精品推荐
        $data['Jingping']=S('Jingping');
        if(!$data['Jingping']){
            $data['Jingping']=$model->Jingping();
            S('Jingping',$data['Jingping'],$redisTime);
        }
        //获取活动推荐
        $data['HuodongTuijian']=S('HuodongTuijian');
        if(!$data['HuodongTuijian']){
            $data['HuodongTuijian']=$model->HuodongTuijian();
            S('HuodongTuijian',$data['HuodongTuijian'],$redisTime);
        }

        // 所有游戏轮播
    	$data['Banner']=S('Banner');
        if(!$data['Banner']){
            $data['Banner']=$model->Banner();
            S('Banner',$data['Banner'],$redisTime);
        }
        
        //获取新闻推荐
        $data['NewsTop']=S('NewsTop');
        if(!$data['NewsTop']){
            $data['NewsTop']=$model->NewTuijian();
            S('NewsTop',$data['NewsTop'],$redisTime);
        }

        //获取活动推荐
        $data['HuodongTop']=S('HuodongTop');
        if(!$data['HuodongTop']){
            $data['HuodongTop']=$model->HuodongTuijian();
            S('HuodongTop',$data['HuodongTop'],$redisTime);
        }

        //获取活动推荐
        $data['Kaifu']=S('Kaifu');
        if(!$data['Kaifu']){
            $data['Kaifu']=$model->getKaifuTj();
            S('Kaifu',$data['Kaifu'],$redisTime);
        }

        //获取活动推荐
        $data['Libao']=S('Libao');
        if(!$data['Libao']){
            $data['Libao']=$model->Libaotj();
            S('Libao',$data['Libao'],$redisTime);
        }
        // dump($data['Libao']);die;
        //获取活动推荐
        $data['iosTj']=S('iosTj');
        if(!$data['iosTj']){
            $data['iosTj']=M('Gameinfo')->field("id,gamename,logo,iosdownload,seourl")->where("iosdownload !='' ")->order("gametime desc")->limit(40)->select();
            S('iosTj',$data['iosTj'],$redisTime);
        }

        $data['apkTuijian']=S('apkTuijian');
        if(!$data['apkTuijian']){
            $data['apkTuijian']=$model->apkTuijian();
            S('apkTuijian',$data['apkTuijian'],$redisTime);
        }
        // dump($data['iosTj']);die;
    	$this->assign(array(	
    				'Game'         =>$data['Game'],
    				'Tuijian'      =>$data['Tuijian'],
    				'Banner'       =>$data['Banner'],
    				'NewsTop'      =>$data['NewsTop'],
    				'HuodongTop'   =>$data['HuodongTop'],
    				'Remen'        =>$data['Remen'],
    				'Jingping'     =>$data['Jingping'],
    				'HdTuijian'    =>$data['HuodongTuijian'],
    				'Kaifu'        =>$data['Kaifu'],
    				'Libao'        =>$data['Libao'],
                    'iosTj'        =>$data['iosTj'],
                    'apkTuijian'   =>$data['apkTuijian'],
                    'display'      =>1,
     		));
    	$this->display('Index');
    }


    public function Search(){
        $Gamelabel=M('Gamelabel')->select();
        if(!empty($_GET['keyboard'])){
            $keyword=$_GET['keyboard'];
        }else{
            $keyword=$_POST['keyboard'];
        }
        $like=addslashes(strip_tags($keyword));
        $where['gamename']=array('like',"%".$like."%");
        $count=M('Gameinfo')->where($where)->count();
        $Page =new \Think\Page($count,20);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('first','第一页');
        $Page->setConfig('last','第一页');
        $data=M('Gameinfo')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign(array(
                    'data' => $data,
                    'Gamelabel'=>$Gamelabel,
                    'show'     =>$Page->show(),
                    'display'  =>1,
                    'keyword'  =>$_POST['keyboard'],
                    'count'   =>$count,
            ));
        $this->display('Search');
    }
}