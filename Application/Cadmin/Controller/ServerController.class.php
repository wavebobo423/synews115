<?php
namespace Cadmin\Controller;
class ServerController extends BaseController{
	protected $modelName = "Webconfig";

	public function Index(){
		$data=M($this->modelName)->find();

		$this->assign(array(
						"channelName"=>"网站管理",
						'item'      =>$data,
						'Platform'   =>$Platform,
						'url'       => 'Update',
					));
		$this->display("Index");
	}

	public function Clearcase(){
		// $redis=new \Org\Util\Redis();
        $Redis=S(array('type'=>'redis','host'=>'127.0.0.1','port'=>'5516'));  
        $Redis->clear();
        $this->success("缓存清除完成",U('Game/Index'));
	}

	public function Update(){
		if(!empty($_POST)){
			$upload = new \Think\Upload();// 实例化上传类
	        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg','jpeg','png');// 设置附件上传类型
	        $upload->rootPath = './Public/Upload/Logo/'; // 设置附件上传根目录
	        //$upload->subName   =     array('date', 'Ym');
	        $upload->subName   =     '';
	        // 上传文件  
	        $info   =   $upload->upload();
	        $data=$_POST;
	        if($info['pclogo']){
	        	$data['pclogo']=$upload->rootPath.$info['pclogo']['savename'];
	        }
	        if($info['waplogo']){
	        	$data['waplogo']=$upload->rootPath.$info['waplogo']['savename'];
	        }
	        if($info['wx']){
	        	$data['wx']=$upload->rootPath.$info['wx']['savename'];
	        }
	        $where['id']=$_POST['id'];
			$Result=M($this->modelName)->where($where)->data($data)->save();
			if($Result>0){
				$this->success('修改完成',U('Index'));
				die;
			}else{
				$this->error('修改失败');
				die;
			}
		}
	}

	

}
