<?php
namespace Wap\Model;
use Think\Model;
use Think\Db\Driver;
class GameinfoModel extends Model
{
	
	//最新游戏
	public function newGame(){
		$newGame=$this->order('id desc')->select();
		
		return $newGame;
	}

	// 推荐游戏
	public function Tuijian(){
		$newGame=$this->where('istj=1')->order('id desc')->select();
		
		return $newGame;
	}

	//获取首页轮播
	public function Banner(){
		$newGame=$this->where('adpictureurl!="" AND istj=1')->limit(10)->order("gametime desc")->select();
		
		return $newGame;
	}

	//获取新闻推荐
	public function NewTuijian(){
		$News=M('News')->where('newslabel=1 AND istj=1')->limit(6)->order('id desc')->select();

		// dump($News);die;
		return $News;
	}

	//获取新闻推荐
	public function HuodongTuijian(){
		$News=M('News')->where('newslabel=2 AND istj=1')->limit(4)->order('id desc')->select();

		return $News;
	}
	//热门推荐(按照评分来的)
	public function Rementuijian(){
		$newGame=$this->where('score!=""')->limit(3)->order('score desc')->select();
		
		return $newGame;
	}

	// 精品推荐游戏(推荐并且点击量最高)
	public function Jingping(){

		$newGame=$this->where('istj=1')->order('alwaysclick desc')->limit(9)->select();
		
		return $newGame;
	}

	//获取开服表推荐
	public function getKaifuTj(){
		$day_0=strtotime(date('Y-m-d',time()));
		$day_24=strtotime(date('Y-m-d',time()+60*60*24));
		$kaifu=M('Kaifu')->where('kfday>'.$day_0." AND kfday<".$day_24." AND istj=1")->limit(8)->order('kdtime asc')->select();
		return $kaifu;
	}

	//推荐礼包
	public function Libaotj(){
		$kaifu=M('Libao')->where("istj=1")->limit(6)->order('id desc')->select();
		return $kaifu;
	}


}