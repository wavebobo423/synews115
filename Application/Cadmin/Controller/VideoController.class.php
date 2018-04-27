<?php
namespace Cadmin\Controller;
class VideoController extends BaseController{
	protected $modelName ="Video";

	public function index()
	{
		// print_r($list);
		$pageNum = isset($_GET['p'])?I("get.p"):1;
		$listRows = 5;
		$result = $this->model->pages($listRows,$pageNum);
		$favor = M("favorite");
		$where['type']      = 2;
		foreach ($result['items'] as &$value) {
			$where['origin_id'] = $value['id'];
			$value['default_favor_num'] = $favor->where($where)->count();
		}
		$this->assign("items",$result['items']);
		$this->assign("pagination",$result['pagination']);
		$this->assign("channelName","视频管理");
		$this->display();
	}

	public function addVideo()
	{
		$this->assign('channelName',"添加Video");
		$this->display('Video/add');
	}

	public function editVideo()
	{
		$id = (int)I("get.id");
		$item = $this->model->getById($id);
		$this->assign('channelName',"编辑Video");
		$this->assign("item",$item);
		$this->display('Video/add');
	}

	public function setVideo(){
		$data = I("post.");
		$url = U("Video/index");
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

	public function delVideo(){
		$id = (int)I("get.id");
		$result = $this->model->delById($id);
		$url = U("Video/index");
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
		// $upload->rootPath	= __ROOT__."/Public/Upload/Video/".date('Y')."/".date('m')."/".date('d').'/';
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
	public function setFavor(){
		$video_id  =  (int) I('post.video_id');
		$favor_num = (int)I("post.favor_num");
		$favor = M("favorite");
	    $where['origin_id'] = (int) $video_id ;
	    $where['type']      = 2;
	    $res = $favor->where($where)->count();
	    if($favor_num < $res){
	    	$data['msg'] = "不能小于已有点赞数";
	    }else{
	    	$diff = $favor_num - $res;
	    	for($i=0;$i<$diff;$i++){
	    		$res = $favor->data($where)->add();
	    	}
	    	if($res){
	    		$data['msg'] = "修改成功";
	    	}else{
	    		$data['msg'] = "服务器异常";
	    	}
	    }
	    $this->ajaxReturn($data);
	}
	


}


?>