<?php
namespace Cadmin\Controller;
class VolumeController extends BaseController{

	protected $modelName ="volume";

	public function index()
	{
		$model=D('Volume');
		$pageNum = isset($_GET['p'])?I("get.p"):1;
		$listRows = 5;
		
		$total = $model->count();
		// $result = $model->pages($listRows,$pageNum);
		$pages = new \Think\Page($total,$listRows);
		$pages->setConfig("prev","上一页");
        $pages->setConfig("next","下一页");
        $pages->setConfig('theme',"<ul class='pagination'><li><a>共%TOTAL_ROW% %FIRST%条数据%NOW_PAGE%/%TOTAL_PAGE% 页</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li></ul>");
		$lists = $model->order("v_id desc")->page($pageNum,$listRows)->select();
		$pagination = $pages->show();
		$this->assign("items",$lists);
		$this->assign("pagination",$pagination);
		$this->assign("channelName","优惠卷管理");
		$this->display();
	}

	public function Volumeadd()
	{
		
		$this->assign('channelName',"添加优惠卷");
		$this->display('Volume/add');
	}

	public function editBanner()
	{

		if(IS_GET){
			$model=D('Volume');
			$item=$model->find($_GET['id']);
		}
		$this->assign('channelName',"编辑Banner");
		$this->assign("item",$item);
		$this->display('Volume/add');
	}

	public function setBanner(){
		$model=D('Volume');
		$data = I("post.");
		$url = U("Volume/index");
		if(!$data['v_id']){
			//add
			$result = $model->add($data);			
			if($result){
				display_javascript("添加成功",$url);
			}else{
				display_javascript("添加异常",$url);
			}
		}else{
			//update
			$model->create();
			$result = $model->data($data)->save();
			if($result){
				display_javascript("修改成功",$url);
			}else{
				display_javascript("没有修改内容",$url);
			}
		}
	}

	public function delBanner(){

		$id = (int)I("get.id");
		$result = M('Volume')->delete($id);
		$url = U("Volume/index");
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