<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class KaifuController extends InitController {
    public function Index(){
    	$model=M('Kaifu');

        //获取当天的开服信息
        $day_0=strtotime(date('Y-m-d',time()));
        $day_24=strtotime(date('Y-m-d',time()+60*60*24));
        $Day_Kaifu=M('Kaifu')->distinct("kfday")->where('kfday>'.$day_0." AND kfday<".$day_24)->order('kfday asc')->select();
        //获取昨天
        $YesDay_0=strtotime(date('Y-m-d',time()-60*60*24));
        $YesDay_24=strtotime(date('Y-m-d',time()));
        $YesDay_Kaifu=M('Kaifu')->where('kfday>'.$YesDay_0." AND kfday<".$YesDay_24)->order('kfday asc')->select();

        //获取明天的开服
        $MonDay_0=strtotime(date('Y-m-d',time()+60*60*24));
        $MonDay_24=strtotime(date('Y-m-d',time()+2*60*60*24));
        $MonDay_Kaifu=M('Kaifu')->where('kfday>'.$MonDay_0." AND kfday<".$MonDay_24)->order('kfday asc')->select();

       
        $YesDay_Kaifu=M('Kaifu')->where('kfday>'.$YesDay_0." AND kfday<".$YesDay_24)->order('kfday asc')->select();

    	$this->assign(array(	
                    'display'      =>4,
                    'Daykaifu'     =>$Day_Kaifu,
                    'Yeskaifu'     =>$YesDay_Kaifu,
                    'Monkaifu'     =>$MonDay_Kaifu,
     		));
    	$this->display('Index');
    }
}