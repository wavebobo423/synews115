<?php
namespace Cadmin\Controller;
class ProductController extends BaseController{

	// protected $modelName ="Product";

	public function index(){
		// print_r($list);
		// $cate      = isset($_GET['cate'])?I("get.cate"):'';
		// if($cate){
		// 	$condition['cate'] = $cate;
		// }
		// $pro_id    = isset($_GET['pro_id'])?I('get.pro_id'):'';
		// if($pro_id){
		// 	$condition['pro_id'] = $pro_id;
		// }
		// $pro_name  = isset($_GET['pro_name'])?I('get.pro_name'):'';
		// if($pro_name){
		// 	$condition['pro_name'] = $pro_name;
		// }
		// // $condition['if_show']  = 1;
		// $pageNum = isset($_GET['p'])?I("get.p"):1;
		
		// $listRows = 10;
		// $result = $this->model->pages($listRows,$pageNum,true,"if_groupby desc ,if_recommend desc, pro_id desc");
		// $this->assign("items",$result['items']);
		// $this->assign("pagination",$result['pagination']);
		// $this->assign("channelName","商品管理");
		$this->display();
	}
	public function add(){
		// $editor = M("product_editor");
		// $editorList = $editor->select();
		// $brand = M("product_brand");
		// $brandList = $brand->select();
		// $this->assign("brands",$brandList);
		// $this->assign("editorList",$editorList);
		// $this->assign("type",1);
		// $this->assign("channelName","添加商品");
		$this->display();
	}

	public function addProduct(){
		$data = I("post.");
		$ext['standard'] = $data['standard'];
		$ext['stock']    = $data['stock'];
		$pro_detail['pro_deltail'] = htmlspecialchars($data['pro_detail']);
		unset($data['stock']);unset($data['standard']);unset($data['pro_detail']);
		// print_r($data);exit(OK);
		$url = U("Product/index");
		if(!$data['pro_id']){
			//add
			$result = $this->model->addData($data);	
			$pro_detail['pro_id'] = $ext['pro_id'] = $result;

			$pro_attachment = M("product_attachment");
			$pro_attachment->data($pro_detail)->add();	
			$pro_ext  = M("product_ext");
			foreach ($ext as $item) {
				foreach($item as $k=>$v){
					$dataList[$k]['stock'] = $v['stock'];
					$dataList[$k]['standard'] = $v['standard'];
					$dataList[$k]['pro_id']  = $item['pro_id']; 
				}
			}
			$pro_ext->dataAll($dataList);	
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
	public function edit()
	{
		$condition['pro_id'] = (int)I("get.id");
		$item = $this->model->getByCondition($condition);
		$this->assign('channelName',"编辑Product");
		$this->assign("item",$item);
		$this->display('Product/add');
	}

	public function uploadImg()
	{
		 session_id($_POST['session']); 
  		 session_start();

		// $rootPath = "./Public/Upload/Product/";
		// $config = array(
		// 	'maxSize' 	=> 2014*2014*5,
		// 	'exts'    	=> array('jpg','jpeg','gif','png'),
		// 	'rootPath'	=> $rootPath
		// );
		// $upload          = new \Think\Upload($config);
		// if(!file_exists($rootPath)){
		// 	mkdir($rootPath,0777,true);
		// }
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/Upload/Product/'; // 设置附件上传根目录
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
		//执行上传
		$info=$upload->upload();
		if(!$info){
			$this->error($upload->getError());
		}else{
			foreach($info as $file){
				$image=new \Think\Image();
				$old_img = $upload->rootPath.$file['savepath'].$file['savename'];
				$image->open($old_img);
				$cover=$file['savepath']."m_".$file['savename'];
				//图片的缩放
				$image->thumb(750,500)->save($upload->rootPath.$cover);
			}
			
			//删除老图片
			@unlink($old_img);
			$src = array(
				'db_path' => "/Public/Upload/Product/".$cover,
				'img_path' => "/Public/Upload/Product/".$cover
			);
			echo json_encode($src);
			exit;
		}
	}

    public function uploadPic()
	{
		 session_id($_POST['session']); 
  		 session_start();
		// $rootPath = "./Public/Upload/Product/";
		// $config = array(
		// 	'maxSize' 	=> 2014*2014*5,
		// 	'exts'    	=> array('jpg','jpeg','gif','png'),
		// 	'rootPath'	=> $rootPath
		// );
		// $upload          = new \Think\Upload($config);
		// if(!file_exists($rootPath)){
		// 	mkdir($rootPath,0777,true);
		// }
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/Upload/Product/'; // 设置附件上传根目录
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
		//执行上传
        $info=$upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            foreach($info as $file){
                $image=new\Think\Image();
                $old_img = $upload->rootPath.$file['savepath'].$file['savename'];
                // $image->open($old_img);
                $cover[]=$file['savepath']."m_".$file['savename'];
                //图片的缩放
                // $image->thumb(750,500)->save($upload->rootPath.$cover);
            }
        //删除老图片
        @unlink($old_img);
        $src = array(
			'db_path' => $cover,
			'img_path' =>$cover
			);
        echo json_encode($src);
        exit;
        } 
    }

    //删除
   	public function DelProduct(){
   		$id=$_GET['id'];
   		$data=M('Product')->where("pro_id='{$id}'")->find();
   		@unlink("{$data['cover']}");
   		@unlink("{$data['bg_pic']}");
   		M('Speci')->where("pro_id='{$data['pro_id']}'")->delete();
   		$list=M('Product')->where("pro_id=$id")->delete();
   		if($list){
   			$this->success("删除完成",U("Product/index"));
   		}else{
   			$this->error("删除失败");
   		}
   	}
	public function test()
	{
		$template = "test";
		$this->assign("template",$template);
		$this->display("Product/add");
	}

	public function BaseInfo()
	{
		$data = I("post.");
		$url = U("Product/index");
		$content = htmlspecialchars($data['pro_detail']);
		unset($data["pro_detail"]);
		$aff['pro_detail']=$content;
		if(!$data['pro_id']){
			//add
			$data['ctime'] = date("Y-m-d H:i:s",time());
			$result = $this->model->addData($data);
			$attachment['pro_detail'] = $content;
			$attachment['pro_id']	  = $result;
			$att = M("product_attachment");
			$att->data($attachment)->add();
			if($result){
				redirect('Standard?add_id='.$result);
			}else{
			}
		}else{
			$url = U("Product/index");
			
			$result = $this->model->updateById($data);
		

			$resu=M('Product_attachment')->where("pro_id={$_POST['pro_id']}")->data($aff)->save();
			
			if($result||$resu){
				display_javascript("修改成功",$url);
			}else{
				display_javascript("没有修改内容",$url);
			}
		}
	}

	public function editBaseInfo()
	{
		$condition['pro_id'] = (int)I("get.id");
		$item = $this->model->getByCondition($condition);
		$attachment = M("product_attachment");
		$pro_id = $item['pro_id'];
		$pro_detail = $attachment->where("pro_id = ".$pro_id)->getField('pro_detail');
		$item['pro_detail'] = htmlspecialchars_decode($pro_detail);
		$editor = M("product_editor");
		$editorList = $editor->select();
		$brand = M("product_brand");
		$brandList = $brand->select();

		$this->assign("brands",$brandList);
		$this->assign("editorList",$editorList);
		$this->assign('channelName',"编辑商品");
		//基本信息
		$this->assign('type',1);    
		$this->assign("item",$item);
		$this->display('Product/add');

	}
	public function Standard(){
		$add_id = isset($_GET['add_id'])?$_GET["add_id"]:"";
		if(!$add_id){//提交
			$data = I("post.");
			foreach($data['spename1'] as $k=>$item){
				$insert_data[$k]['spename1'] = $item;
				$insert_data[$k]['pro_id'] = $data['pro_id'];
			}
			foreach($data['spepri1'] as $k=>$item){
				$insert_data[$k]['spepri1'] = $item;
			}
			foreach($data['spenumber1'] as $k=>$item){
				$insert_data[$k]['spenumber1'] = $item;
				$number[]=$item;
			}
			
			$countnumber=array_sum($number);
			$product = M("product");
			$product->where('pro_id = '.$data['pro_id'])->save(array('price'=>$data['spepri1'][0],'countnumber'=>$countnumber));
			$url = U("Product/index");
			$standard = M("speci");
			$standard->addAll($insert_data);
			display_javascript("添加成功",$url);
		}else{
			$this->assign('pro_id',$add_id);
			$this->display('Product/standard');
		}
	}

	public function GroupBuy()
	{
		$add_id = isset($GET['add_id'])?I("get.add_id"):"";
		$this->assign('type',4);
		$data = I("post.");
		$is_new = $data['is_new'];
		if($is_new){
			//add
			$standard = M("product_ext");
			$standard->data($data)->add();
			redirect('ExtInfo?add_id='.$data['pro_id']);
		}else{
			//update
			$standard = M("product_ext");
			$standard->where("pro_id =".$data['pro_id'])->save($data);
			redirect('ExtInfo?add_id='.$data['pro_id']);
		}
		if($add_id){
			$this->assign('pro_id',$add_id);
		}
		$this->display('Product/groupbuy');
	}
	public function setGroupInfo(){
		$pro_id  = isset($_POST['pro_id'])?(int)I("post.pro_id"):'';
		$group = M("product_groupbuy");
		$item = $group->where("pro_id = ".$pro_id)->find();
		if($item){
			$return_data = array(
				'status'   => 1,
				'people'   => $item['group_people'],
				'price'	   => $item['group_price'],
				'pro_id'   => $item['pro_id'],
				'cover'	   => $item['group_cover'],
				'des'	   => $item['group_des'],
				'title'	   => $item['group_title'],
				'tip'	   => $item['group_tip']
			);
		}else{
			$return_data = array(
				'status' => 0,
				'msg'	 => "操作异常"
			);
		}
		$this->ajaxReturn($return_data);
	}

	/**
	 * update
	 */
	public function updateGroupInfo(){
		$data  = I("post.");
		$group = M("product_groupbuy");
		$isNew = $data['isNew'];
		unset($data['isNew']);
		if(!$isNew){
			$res = $group->where("pro_id = ".$data['pro_id'])->save($data);
		}else{
			$res = $group->add($data);
			// echo
			$product = M("product");
			$product->where("pro_id =".$data['pro_id'])->setField('if_groupby',1);  //把product表团购设为1
		}
		$url = U("Product/index");
		if($res){
			display_javascript("操作成功",$url);
		}else{
			display_javascript("未修改内容",$url);
		}
	}

	public function delGroupInfo(){
		$pro_id = I("post.pro_id");
		$group = M("product_groupbuy");
		$group->where("pro_id = ".$pro_id)->delete();
		$product = M("product");
		$product->where("pro_id =".$pro_id)->setField('if_groupby',0);  //把product表团购设为0
		$this->ajaxReturn(1);
	}
	public function updateStatus(){
		$data = I("post.");
		$product = M("product");
		$res = $product->where("pro_id = ".$data['pro_id'])->setField($data['field'],$data['status']);
		$return_data['field'] = $data['field'];
		if($res) {
			$return_data['status'] = 1;
			$this->ajaxReturn($return_data);
		}else{
			$return_data['status'] = 0;
			$this->ajaxReturn($return_data);
		}
	}

	public function uploadGroupCover(){
		$rootPath = "/ROOT/www/xianeryijian/Public/Upload/Product/";
		$config = array(
			'maxSize' 	=> 2014*2014*5,
			'exts'    	=> array('jpg','jpeg','gif','png'),
			'rootPath'	=> $rootPath
		);
		$upload          = new \Think\Upload($config);
		if(!file_exists($rootPath)){
			mkdir($rootPath,0777,true);
		}
		//执行上传
		$info=$upload->upload();
		if(!$info){
			$this->error($upload->getError());
		}else{
			foreach($info as $file){
                $image=new\Think\Image();
                $old_img = $upload->rootPath.$file['savepath'].$file['savename'];
                $image->open($old_img);
                $cover=$file['savepath']."m_".$file['savename'];
                //图片的缩放
                $image->thumb(750,350)->save($upload->rootPath.$cover);
            }
        //删除老图片
        @unlink($old_img);
        $src = array(
			'db_path' => "/Public/Upload/Product/".$cover,
			'img_path' => "/Public/Upload/Product/".$cover
			);
        echo json_encode($src);
        exit;
		}
	}

	public function updateStandard(){
		$pro_id = I("get.id");
		$speci  = M("speci");
		$items = $speci->where("pro_id = ".$pro_id)->select();
		$this->assign("items",$items);
		$this->assign("pro_id",$pro_id);
		$this->display("Product/editStandard");
	}
	
	public function updateStandardInfo(){
		$data = I("post.");
		$speci = M("speci");
		$product = M("product");
		$count = $data['count'];
		unset($data['count']);
	   if (!empty($_GET)) {
	   		$id=$_GET['id'];
	   		$row=$speci->delete($id);
	   		if($row){
	   			$this->ajaxReturn(1);
	   			exit;
	   		}else{
	   			$this->ajaxReturn(2);
	   			exit;
	   		}
	   }
		if($count==1){
			$product->where("pro_id = ".$data['pro_id'])->save(array('price'=>$data['spepri1']));
		}
		//获取规格表修改前的数量
		$saveorl=$speci->field("spenumber1")->where("spe_id='{$data['spe_id']}'")->find();
		//获取商品表总数
		$productcount=$product->field("countnumber")->where("pro_id='{$data['pro_id']}'")->find();
		// 减去原来的总数
		$price1=$productcount['countnumber']-$saveorl['spenumber1'];
		$newprice=$price1+$data['spenumber1'];
		//更新商品表总数
		$product->where("pro_id='{$data['pro_id']}'")->data("countnumber=$newprice")->save();
		$res = $speci->data($data)->save();
		if($res) {
			$return_data['status'] = 1;
			$this->ajaxReturn($return_data);
		}else{
			$return_data['status'] = 0;
			$this->ajaxReturn($return_data);
		}
	}

	public function addStandard(){
		$data = I("post.");
		$speci = M("speci");
		$res = $speci->data($data)->add();
		$back_url = U('Product/updateStandard').'?id='.$data['pro_id'];
		if($res) {
			display_javascript("添加成功",$back_url);
		}else{
			display_javascript("服务器异常,请稍后再试",$back_url);
		}
	}
}


?>