<?php
namespace Cadmin\Controller;

// use Think\Model;
class GameController extends BaseController{

	protected $modelName ="Gameinfo";

	public function Index(){
			/*
			 *  查询平台信息表
			 */
			$platforminfo=M('Plat')->select();

			//查询游戏类型
			$GameType=M('Gamelabel')->select();

			if(!empty($_POST['gamename'])){
				$where['gamename']=array("like","%".$_POST['gamename']."%");
			}

			if(!empty($_POST['platform'])){
				$where['platform']=$_POST['platform'];
			}

			if(!empty($_POST['status'])){
				switch($_POST['status']){
					case 1:
					  $where['state']=2;
					break;

					case 2:
					  $where['adpictureurl']=array('neq',"");
					break;

					case 3:
					  $where['wapadpic']=array('neq',"");
					break;

					case 4:
					  $order="alwaysclick desc";
					break;

					case 5:
					  $where['istj']=1;
					break;
					default:
					  $where[]="";
					;
				}
			}

			if(!empty($_POST['label'])){
				$where="find_in_set(".$_POST['label'].",label)";
			}

			$neworder=!empty($order)?$order:"gametime desc,istj desc";

			$count=M($this->modelName)->where($where)->order($neworder)->count();
			$Page =new \Think\Page($count,20);
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('first','第一页');
			$Page->setConfig('last','第一页');

			$data=M($this->modelName)->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($neworder)->select();
			// echo M($this->modelName)->getLastSql();die;
			$this->assign(array(
							"channelName"=>"游戏列表",
							'items'      =>$data,
							'Platform'   =>$platforminfo,
							'pagination' =>$Page->show(),
							'gametype'   =>$GameType,
							'count'      =>M('Gameinfo')->count(),
				));
			$this->display();
	}


	public function Add(){
		// $editor = M("product_editor");
		// $editorList = $editor->select();
		// $brand = M("product_brand");
		// $brandList = $brand->select();
		// $this->assign("brands",$brandList);
		// $this->assign("editorList",$editorList);
		$this->assign("type",1);
		// $this->assign("channelName","添加商品");
		
		$this->display('add');
	}

	


	//神马XMLsitemapPC端生成
	public function smxml(){
		$model=M('Gameinfo')->field('seourl')->select();
		$urls="";
		$list=array();
		foreach ($model as $key => $value) {
				$urls="";
				$urls.="<sitemapindex>";
				$urls.=" <sitemap>";
				$urls.="<loc>";	
				$urls.="http://www.sy115.com/listseo/".$value['seourl'].".html";
				$urls.="</loc>";
				$urls.="<lastmod>".date("Y-m-d H:i:s",time())."</lastmod>";
				$urls.="</sitemap>";
				$urls.="</sitemapindex>";
				$list[]=$urls;

		}
		foreach ($list as $key => $value1) {
			echo htmlentities($value1,ENT_QUOTES,"utf-8")."<br>";
		}

	}

	// 删除游戏
	public function DeleteGame(){
		$ArrayID=explode(",",$_GET['id']);
		if(!empty($ArrayID)){
			foreach ($ArrayID as $key => $value) {
				$Gameinfo=M($this->modelName)->find($value);
				//删除LOGO
				@unlink('./Public/Upload/Product/'.$Gameinfo['logo']);
			
				@unlink('./Public/Upload/Product/'.$Gameinfo['bjpic']);
				
				@unlink('./Public/Upload/Product/'.$Gameinfo['adpictureurl']);

				@unlink('./Public/Upload/Product/'.$Gameinfo['wapadpic']);
			
				$ImgArray=explode(",",$Gameinfo['imgall']);

				foreach ($ImgArray as $k => $v) {
					@unlink(".".substr(trim($v),7));
				}

				$ResultID=M($this->modelName)->delete($value);
			}

			if($ResultID>0){
				$this->success('删除完成',U('Game/Index'));
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
		
	    $this->success('推荐完成',U('Game/Index'));
		
	}

	//批量取消推荐
	public function QXtuijian(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['istj']=0;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('取消推荐完成',U('Game/Index'));
		
	}
	//批量审核
	public function Shenhe(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['state']=1;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('批量审核完成',U('Game/Index'));
		
	}

	//批量下架
	public function Xiajia(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['state']=2;
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success('批量下架完成',U('Game/Index'));
		
	}

	//批量更新时间
	public function Newtime(){
		$ArrayID=explode(",",$_GET['id']);
		foreach ($ArrayID as $key => $value) {
			$where['id']=$value;
			$data['gametime']=time();
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success("更新完成",U('Game/Index'));
	}

	public function GameDeletePic(){
		$path=$_GET['imgall'];

		foreach ($path as $key => $value) {
				@unlink(".".substr($value,7));
		}

		echo "<script>history.go(-1)</script>";
	}

	public function GamebjPicDelete(){
		$gameid=$_POST['gameid'];
		$gameinfo=M('Gameinfo')->find($gameid);


		if(!empty($gameinfo['imgall'])){
			$img=explode(",",$gameinfo['imgall']);
			foreach ($img as $key => $value) {
				if(trim($value)==trim($_POST['url'])){
					@unlink(".".substr(trim($_POST['url']),7));
				}else{
					$gamepic[]=$value;
				}
			}
			// /synews/Public/Upload/Product/2017-07-06/m_595dafff13399.jpg,/synews/Public/Upload/Product/2017-07-06/m_595dafff590d9.png,/synews/Public/Upload/Product/2017-07-06/m_595dafffb97e8.png
			$where['id']=$gameid;
			$data['imgall']=implode(",",$gamepic);
			$Result=M('Gameinfo')->where($where)->data($data)->save();

			if($Result>0){
				$this->ajaxReturn(1);
				die;
			}else{
				$this->ajaxReturn(2);
				die;
			}
		}
	}

	public function GameAddUp(){
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Public/Upload/Product/'; // 设置附件上传根目录
	    $upload->savePath  =     ''; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    // dump($info);die;
		if($info){
			$Model=M('Gameinfo');
			$data                 =  $_POST;
			$data['logo']         =  $info['logo']['savepath'].$info['logo']['savename'];
			$data['bjpic']        =  $info['bjpic']['savepath'].$info['bjpic']['savename'];
			$data['adpictureurl'] =  $info['adpictureurl']['savepath'].$info['adpictureurl']['savename'];
			$data['wapadpic']     =  $info['wapadpic']['savepath'].$info['wapadpic']['savename'];
			$data['gametime']     =  time();
			$data['label']        =  implode(",",$_POST['label']);
			$data['state']        =  $_POST['state'][0];
			$data['imgall']       =  implode(",",$_POST['imgall']);
			$data['alwaysclick']  =  !empty($_POST['alwaysclick'])?$_POST['alwaysclick']:rand(100,999).rand(1000,9999);
			$data['weekclick']    =  !empty($_POST['weekclick'])?$_POST['weekclick']:rand(100,9999);
			$data['dayclick']     =  !empty($_POST['dayclick'])?$_POST['dayclick']:rand(100,999);
			$data['score']        =  !empty($_POST['score'])?$_POST['score']:5;
			$GameResult=$Model->data($data)->add();
			if($GameResult>0)
			{
				$this->redirect('Index');
				die;
			}else{
				$this->error($Model->error());
			}
		}else{
			$this->error("LOGO没有上传!");
		}
		
	}

	//修改游戏
	public function GameSaveinfo(){
		
		if(!empty($_POST)){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath  =     './Public/Upload/Product/'; // 设置附件上传根目录
		    $upload->savePath  =     ''; // 设置附件上传（子）目录
		    // 上传文件 
		    $info   =   $upload->upload();

		    // 先判断是否有文件上传
		    if($info){
		    	$data            =  $_POST;
		    	//如果更换了游戏LOGO 那么就删除掉以前的LOGO
		    	if(!empty($info['logo'])){
		    		$data['logo']    =    $info['logo']['savepath'].$info['logo']['savename'];
		    		@unlink("./Public/Upload/Product/".$_POST['oldfile']);
		    	}

		    	//如果更换了详细页形象图(1920x550)
		    	if(!empty($info['bjpic'])){
		    		$data['bjpic']   =    $info['bjpic']['savepath'].$info['bjpic']['savename'];
		    		@unlink("./Public/Upload/Product/".$_POST['oldbjpic']);
		    	}

		    	//如果更换了首页广告图(586*300,需要推荐才填,不需要推荐不用填)
		    	if(!empty($info['adpictureurl'])){
		    		$data['adpictureurl']   =    $info['adpictureurl']['savepath'].$info['adpictureurl']['savename'];
		    		@unlink("./Public/Upload/Product/".$_POST['adpictureurloldfile']);
		    	}

		    	//如果更换了wap/APP广告图:(500*250,需要推荐才填,不需要推荐不用填)
		    	if(!empty($info['wapadpic'])){
		    		$data['wapadpic']   =    $info['wapadpic']['savepath'].$info['wapadpic']['savename'];
		    		@unlink("./Public/Upload/Product/".$_POST['wapadpicoldfile']);
		    	}
		    	  $data['gametime']     =  time();
				  $data['label']        =  implode(",",$_POST['label']);
				  $data['state']        =  $_POST['state'][0];
				  $data['imgall']       =  implode(",",$_POST['imgall']);
				  
				  $where['id']          =   $_POST['pro_id'];
		    }else{

		    	  
		    	  $data                 =   $_POST;
		    	  $data['gametime']     =  time();
				  $data['label']        =  implode(",",$_POST['label']);
				  $data['state']        =  $_POST['state'][0];
				  $data['imgall']       =  implode(",",$_POST['imgall']);
		    	  $where['id']          =   $_POST['pro_id'];
		    }


		    $Result=M($this->modelName)->where($where)->data($data)->save();
		    if($Result>0){
		    	$this->success('修改完成',U('Game/Index'));
		    	die;
		    }else{
		    	$this->error("修改失败!");
		    	die;
		    }
		}
	}

	//设置推荐
	public function Updateistj(){
		 $type=$_GET['type'];
		 // 1是取消推荐 2是推荐
		 if($type==1){
		 	$data['istj']=0;
		 	
		 }else{
		 	$data['istj']=1;
		 }
		 $result=M($this->modelName)->where("id={$_GET['id']}")->data($data)->save();
		 if($result>0){
		 	$this->redirect('Index');
			die;
		 }
	}


	//修改游戏
	public function SaveGame(){
		$gameinfo=M($this->modelName)->find($_GET['id']);

		/*
		 *  查询平台信息表
		 */
		$platforminfo=M('Plat')->select();

		/*
		 *  查询游戏标签表
		 */
		$gamelabel   =M('Gamelabel')->select(); 


		$this->assign(array(
						'item'      =>  $gameinfo,
						'Platform'  =>  $platforminfo,
						'Gamelabel' =>  $gamelabel,
			));
		$this->display();
	}


	public function Addapp(){
		$model=M('Appgg');
		if(IS_POST){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath  =     './Public/Upload/Product/'; // 设置附件上传根目录
		    $upload->savePath  =     ''; // 设置附件上传（子）目录
		    // 上传文件 
		    $info   =   $upload->upload();

		    if($info){
		    	$data['appimg']    =    "http://www.sy115.com/Public/Upload/Product/".$info['appimg']['savepath'].$info['appimg']['savename'];
		    	$data['appurl']    =    $_POST['appurl'];
		    	$data['create_time'] = time();
		    	$result=$model->data($data)->add();
		    	if($result){
		    		$this->success("添加完成");
		    		die;
		    	}
		    }else{
		    	$this->error("没有上传广告图片");
		    	die;
		    }
		}
		$count=$model->count();
		$Page =new \Think\Page($count,20);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');

		$data=$model->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
			
		$this->assign(array(
						'data'=>$data,
						'show'=>$Page->show(),
						'url'=>"Addapp",
			));
		$this->display();
	}

  }


