<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    //app版本更新接口
    public function AppInfo(){
        $data['appinfo']=M('AppInfo')->find(1);
        echo json_encode($data);
        die;
    }

    //app广告接口
    public function appgg(){
        $re=M('Appgg')->order("id desc")->find();
        echo json_encode($re);
        die;
    }

    //网站秘钥接口
    public function Webauto(){

    	$data['url']=$_GET['url'];
    	// $data['ip']=$_GET['ip'];
    	$result=M('Websdk')->where($data)->select();
    	// dump($result);die;
    	if(empty($result)){
    		echo 101;
    		die;
    	}else{
    		echo 200;
    		die;
    	}
    }

    public function wap(){
    	$host=explode(".",$_SERVER['HTTP_HOST']);
    	$data=file_get_contents("http://www.sy115.com/Api/Webauto/url/".$host[1]);
    	if($data!=200){
    		die("请联系QQ:390373977进行授权!");
    	}
    }
}