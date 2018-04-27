<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class TopController extends InitController {
    public function Index(){
        $model=M('Gameinfo');
        // BT游戏畅销榜
        $data['tjgame']=$model->order('istj desc')->limit(30)->select();
        // BT游戏新游榜
        $data['mvgame']=$model->order('gametime  desc,istj desc')->limit(30)->select();
        // BT游戏下载榜
        $data['downgame']=$model->order('downloadcount desc')->limit(30)->select();

        // 满VIP游戏畅销榜
        $data['mvtjgame']=$model->where("find_in_set('19',label)")->order('istj desc')->limit(30)->select();
        // 满VIP游戏新游榜
        $data['mvnewgame']=$model->where("find_in_set('19',label)")->order('gametime  desc,istj desc')->limit(30)->select();
        // 满VIP游戏下载榜
        $data['mvdowngame']=$model->where("find_in_set('19',label)")->order('downloadcount desc')->limit(30)->select();
        $this->assign(array(	
    				'Data'         =>$data,
                    'display'        =>5,
     		));
    	$this->display('Index');
    }
}