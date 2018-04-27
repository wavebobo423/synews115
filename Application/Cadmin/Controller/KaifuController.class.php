<?php
namespace Cadmin\Controller;
class KaifuController extends BaseController{
	protected $modelName = "Kaifu";

	public function Index(){
		if(!empty($_POST['gamename'])){
			$where['gamename']=array('like',"%".$_POST['gamename']."%");
		}
		 //自动删除前2天的开服信息
        // $qianDay_2=strtotime(date('Y-m-d',time()-60*60*24*2));

        $qianDay_24=strtotime(date('Y-m-d',time()-60*60*24*1));
        // echo  $qianDay_24;die;
       	$delete=M($this->modelName)->where("kfday<".$qianDay_24)->delete();


       	$neworder="id desc";
		$Platform=M('Newlabel')->select();

		$count=M($this->modelName)->where($where)->order($neworder)->count();
		$Page =new \Think\Page($count,20);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');

		$data=M($this->modelName)->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($neworder)->select();
		$this->assign(array(
						"channelName"=>"开服管理",
						'newslabel'  =>$NewsLabel,
						'pagination' =>$Page->show(),
						'items'      =>$data,
						'Platform'   =>$Platform,

					));
		$this->display();
	}

	public function Add(){
		if(!empty($_FILES)){
			    // $files = $_FILES['kaifu'];

		        
		        // 上传
		        $upload = new \Think\Upload();// 实例化上传类
		        $upload->maxSize   =     3145728 ;// 设置附件上传大小
		        $upload->exts      =     array('xls','xlsx');// 设置附件上传类型
		        $upload->rootPath = './Public/Upload/Kaifu/'; // 设置附件上传根目录
		        //$upload->subName   =     array('date', 'Ym');
		        $upload->subName   =     '';
		        // 上传文件  
		        $info   =   $upload->upload();

		        $file=$upload->rootPath.$info['kaifu']['savename'];

		        // dump($info);die;
			    $exl=importExecl($file);
			    // 去掉第exl表格中第一行
        		// unset($exl[1]);
        		// 
        		// 清理空数组
		        foreach($exl as $k=>$v){
		            if(empty($v)){
		                unset($exl[$k]);
		            }    
		        }
		        // 重新排序
		       
        		sort($exl);
        		
        		$model=M('Kaifu');
        		// dump($exl);die;
        		foreach ($exl as $key => $value) {
        			$data['gamename']        =$value[0];
        			$Ostype=M('Gameinfo')->field("androiddownload,iosdownload")->where("gamename='".$value[0]."'")->find();
        			if(empty($Ostype)){
        				 continue;
        			}
        			// dump($Ostype);die;
        			if(!empty($Ostype['iosdownload'])){
        				$data['os']              ="1,2";
        			}else{
        				$data['os']              ="1";
        			}
        			$data['server']          =$value[1];
        			$data['kfday']           =strtotime($value[2]);
        			$data['kdtime']          =strtotime($value[3]);

        			$where['kfday']          =strtotime($value[2]);
        			$where['gamename']       =$value[0];


        			$isset=$model->where($where)->select();
        			if(!empty($isset)){
        				continue;
        			}
        			$data['create_time']     =time();
        			$model->data($data)->add();
        		}
        		unlink($file);
        		$this->success('一共上传'.count($exl).'个新区','Index');
        		die;

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
			$data       =$_POST;
			$data['status']=$_POST['status'][0];
			$data['create_time']=time();
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
	public function DeleteKaifu(){
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
			$data['create_time']=time();
			$ResultID=M($this->modelName)->where($where)->data($data)->save();
		}
		
	    $this->success("更新完成",U('Index'));
	}
	

	//百度自动提交URL列表
	public function Seourl(){
		$Seomodel=M('Seourl');
		$Page =new \Think\Page($Seomodel->count(),20);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');

		$data=$Seomodel->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
		$this->assign(array(
						'data'=>$data,
						'show'=>$Page->show(),
			));
		$this->display();
	}

}
