<?php
namespace Cadmin\Controller;
class NewsController extends BaseController{
	protected $modelName = "News";

	public function Index(){
		if(!empty($_POST['title'])){
			$where['title']=array('like',"%".$_POST['title']."%");
		}

		$Platform=M('Newlabel')->select();
		$neworder="id desc";
		$count=M($this->modelName)->where($where)->order($neworder)->count();
		$Page =new \Think\Page($count,20);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');

		$data=M($this->modelName)->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($neworder)->select();
		


		$this->assign(array(
						"channelName"=>"新闻管理",
						'newslabel'  =>$NewsLabel,
						'pagination' =>$Page->show(),
						'items'      =>$data,
						'Platform'   =>$Platform,

					));
		$this->display();
	}

	public function Add(){
		if(!empty($_POST)){
			$upload = new \Think\Upload();// 实例化上传类
	        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg','png','jpeg');// 设置附件上传类型
	        $upload->rootPath = './Public/Upload/huodong/'; // 设置附件上传根目录
	        //$upload->subName   =     array('date', 'Ym');
	        // $upload->subName   =     '';
	        // 上传文件  
	        $info   =   $upload->upload();
	        $data=$_POST;
	        if($info){
	        	$data['fm']=$info['fm']['savepath'].$info['fm']['savename'];
	        }
			$data['status']=$_POST['status'][0];
			$data['createtimenews']=time();
			$Result=M($this->modelName)->data($data)->add();
			if($Result>0){
				$this->success('添加完成',U('Index'));
				die;
			}else{
				$this->error('添加失败');
				die;
			}
		}

		$NewsLabel=M('Newlabel')->select();
		
		$this->assign(array(
						'newslabel' => $NewsLabel,
						'url'       => 'Add',
			));
		$this->display('add');
	}

	public function getGame(){
		$where['gamename']=array('like',"%".$_GET['name']."%");
		$data=M('Gameinfo')->where($where)->select();
		$this->ajaxReturn($data);
		die;
	}


	public function UpdateNews(){	
		if(IS_POST){
			$where['id']=$_POST['pro_id'];
			$upload = new \Think\Upload();// 实例化上传类
	        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg','png','jpeg');// 设置附件上传类型
	        $upload->rootPath = './Public/Upload/huodong/'; // 设置附件上传根目录
	        //$upload->subName   =     array('date', 'Ym');
	        // $upload->subName   =     '';
	        // 上传文件  
	        $info   =   $upload->upload();
	        // dump($upload->getError());die;
	        $data=$_POST;
	        if($info){
	        	$data['fm']=$info['fm']['savepath'].$info['fm']['savename'];
	        	@unlink($upload->rootPath.$_POST['oldfm']);
	        }
			
			$data['status']=$_POST['status'][0];
			$data['createtimenews']=time();
			$Result=M($this->modelName)->where($where)->data($data)->save();
			if($Result>0){
				$this->success('修改完成',U('Index'));
				die;
			}else{
				$this->error('修改失败');
				die;
			}
		}

		$id=$_GET['id'];

		$NewsLabel=M('Newlabel')->select();

		$data=M($this->modelName)->find($id);

		$this->assign(array(
						'item'=>$data,
						'url' =>'UpdateNews',
						'newslabel' => $NewsLabel,
			));
		$this->display('add');
	}


	//删除新闻
	public function DeleteNews(){
		$ArrayID=explode(",",$_GET['id']);
		if(!empty($ArrayID)){
			foreach ($ArrayID as $key => $value) {
				$ResultID=M($this->modelName)->delete($value);
			}
			if($ResultID>0){
				$this->success('删除完成',U('Index'));
			}else{
				$this->error('删除失败');
			}
		}
	}

	//批量推荐
	public function Tuijian(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['istj']=1;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
	    $this->success('推荐完成',U('Index'));	
	}

	//批量取消推荐
	public function QXtuijian(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['istj']=0;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('取消推荐完成',U('Index'));
		
	}

	//批量审核
	public function Shenhe(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['status']=1;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('批量审核完成',U('Index'));
		
	}

	//批量下架
	public function Xiajia(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['status']=2;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('批量下架完成',U('Index'));
		
	}

	//批量更新时间
	public function Newtime(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['createtimenews']=time();
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success("更新完成",U('Index'));
	}
	

}
