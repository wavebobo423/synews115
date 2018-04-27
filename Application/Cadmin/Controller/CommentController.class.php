<?php
namespace Cadmin\Controller;
class CommentController extends BaseController{
	protected $modelName = "Comment";

	public function index(){
		if($_GET['comment']!="" || $_GET['type']!=""){
			$model=D('Comment');
			// $pageNum = isset($_GET['p'])?I("get.p"):1;
			// $listRows = 5;
			if($_GET['comment']!="" && $_GET['type']=0){
					$where['status']=0;
					$where['comment']=$_GET['comment'];
			}elseif($_GET['comment']!="" && $_GET['type']=1){
					$where['status']=1;
					$where['comment']=$_GET['comment'];
			}elseif($_GET['comment']!=""){
					$where['comment']=$_GET['comment'];
			}else{
				    $where['status']=$_GET['type'];
			}	
			$data= $model->where($where)->select();
			$list[]=$data;
		}else{
			// print_r($list);
			$model=D('Comment');
			$pageNum = isset($_GET['p'])?I("get.p"):1;
			$listRows = 10;
			$list= $model->pages($listRows,$pageNum);
	}
		$this->assign("items",$list);
		$this->assign("channelName","评论管理");
		$this->display();
	}
	public function checkComment()
	{
		$model=D('Comment');
		$condition['id'] = (int)I("get.id");
		$data['status'] = (int)I("get.status");
		$result = $model->where("id={$_GET['id']}")->data($data)->save();
		if($result){
			display_javascript("设置成功");
		}else{
			display_javascript("网络异常");
		}
	}
	public function checkDel(){
		$model=D('Scomment')->delete($_GET['id']);
		// var_dump($_GET['id']);
		if($model){
			display_javascript("删除成功");
		}else{
			display_javascript("删除失败");
		}
	}
	public function commentDel(){
		$model=D('comment')->delete($_GET['id']);
		// var_dump($_GET['id']);
		if($model){
			display_javascript("删除成功");
		}else{
			display_javascript("删除失败");
		}
	}
	public function indexVideo(){
		if($_GET['comment']!="" || $_GET['type']!=""){
			$model=D('Scomment');
			// $pageNum = isset($_GET['p'])?I("get.p"):1;
			// $listRows = 5;
			if($_GET['comment']!="" && $_GET['type']=0){
					$where['status']=0;
					$where['stitle']=$_GET['comment'];
			}elseif($_GET['comment']!="" && $_GET['type']=1){
					$where['status']=1;
					$where['stitle']=$_GET['comment'];
			}elseif($_GET['comment']!=""){
					$where['stitle']=$_GET['comment'];
			}else{
				    $where['status']=$_GET['type'];
			}	
			$data= $model->where($where)->select();
			$list[]=$data;
		}else{
			// print_r($list);
			$model=D('Scomment');
			$total = $model->count();
			$pageNum = isset($_GET['p'])?I("get.p"):1;
			$listRows = 10;
			$lists= $model->order("sc_id desc")->page($pageNum,$listRows)->select();
			$pages = new \Think\Page($total,$listRows);

			//设置分页的config
	        $pages->setConfig("prev","上一页");
	        $pages->setConfig("next","下一页");
	        $pages->setConfig('theme',"<ul class='pagination'><li><a>共%TOTAL_ROW% %FIRST%条数据%NOW_PAGE%/%TOTAL_PAGE% 页</a></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li></ul>");
			$pagination = $pages->show();
			$page = array(
				'items'      => $lists,
				'pagination' => $pagination
			);
	}
		$this->assign("items",$page);
		$this->assign("channelName","评论管理");
		$this->display();
	}
	public function checkScomment()
	{
		$model=D('Scomment');
		$condition['id'] = (int)I("get.id");
		$data['status'] = (int)I("get.status");
		$result = $model->where("sc_id={$_GET['id']}")->data($data)->save();
		if($result){
			display_javascript("设置成功");
		}else{
			display_javascript("网络异常");
		}
	}

}


?>