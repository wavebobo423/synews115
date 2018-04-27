<?php
namespace Cadmin\Controller;
class BannerController extends BaseController{

	protected $modelName ="banner";

	public function index()
	{
		// print_r($list);
		$pageNum = isset($_GET['p'])?I("get.p"):1;
		$listRows = 5;
		$result = $this->model->pages($listRows,$pageNum);
		$this->assign("items",$result['items']);
		$this->assign("pagination",$result['pagination']);
		$this->assign("channelName","首页大图管理");
		$this->display();
	}

	public function addBanner()
	{
		$this->assign('channelName',"添加Banner");
		$this->display('Banner/add');
	}

	public function editBanner()
	{
		$id = (int)I("get.id");
		$item = $this->model->getById($id);
		$this->assign('channelName',"编辑Banner");
		$this->assign("item",$item);
		$this->display('Banner/add');
	}

	public function setBanner(){
		$data = I("post.");
		$url = U("Banner/index");
		if(!$data['id']){
			//add
			$result = $this->model->addData($data);			
			if($result){
				display_javascript("添加成功",$url);
			}else{
				display_javascript("添加异常",$url);
			}
		}else{
			//update
			$result = $this->model->updateById($data);
			if($result){
				display_javascript("修改成功",$url);
			}else{
				display_javascript("没有修改内容",$url);
			}
		}
	}

	public function delBanner(){
		$id = (int)I("get.id");
		$result = $this->model->delById($id);
		$url = U("Banner/index");
		if($result){
			display_javascript("删除成功",$url);
		}else{
			display_javascript("删除异常",$url);
		}
	}

	public function uploadImg()
	{
		$upload          	= new \Think\Upload();
		$upload->maxSize 	= 3145728;
		$upload->exts    	= array('jpg','jpeg','gif','png');
		// $upload->rootPath	= __ROOT__."/Public/Upload/Banner/".date('Y')."/".date('m')."/".date('d').'/';
		$upload->rootPath	="./Public/Upload/";

		//执行上传
        $info=$upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
        	// exit("OK");
            foreach($info as $file){
                $image=new\Think\Image();
                $old_img = "./Public/Upload/".$file['savepath'].$file['savename'];
                $image->open($old_img);
                $cover=$file['savepath']."m_".$file['savename'];
                //图片的缩放
                $image->thumb(750,500)->save("./Public/Upload/".$cover);
            }
        //删除老图片
        @unlink($old_img);
        $src = "/Public/Upload/".$cover;
        echo $src; 
        exit;
        } 

	}


}


?>