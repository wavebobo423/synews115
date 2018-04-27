<?php
namespace Cadmin\Controller;
class UserController extends BaseController{

	protected $modelName="User";

	public function index(){
		// print_r($list);
		$this->assign("items",$list);
		$this->assign("channelName","用户管理");
		$this->display();
	}
	

}


?>