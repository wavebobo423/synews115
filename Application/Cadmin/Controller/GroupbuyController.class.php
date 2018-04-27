<?php
namespace Cadmin\Controller;
class GroupbuyController extends BaseController{
	public function index(){
		$model=M("Order");
		if(IS_GET){
			$action=!empty($_GET['action'])?$_GET['action']:1;
			//订单编号查询
			if($action==1){
				$where['a.p_tuangou']=1;
				$where['a.order_id']=array("like","%{$_GET['relname']}%");
			//查询团购编号
			}elseif($action==2){
				$where['a.p_tuangou']=1;
				$where['a.t_number']=array("like","%{$_GET['relname']}%");
			//查询商品名称
			}elseif($action==3){
				$where['a.p_tuangou']=1;
				$where['c.group_title']=array("like","%{$_GET['relname']}%");
			}
		}
		

		//查询所有团购订单
		
		$count=$model->where("p_tuangou=1")->count();
		$where['a.p_tuangou']=1;
		$Page =new \Think\Page($count,10);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','第一页');
		$list=$model->alias("a")
					->join("xj_address as b on a.addid=b.add_id")
					->join("xj_product_groupbuy as c on a.pro_id=c.pro_id")
					->join("xj_product as d on d.pro_id=a.pro_id")
					->where($where)
					->order("a.id desc")
					->limit($Page->firstRow.','.$Page->listRows)
					->select();
		// var_dump($list);
		$show = $Page->show();// 分页显示输出
		$this->assign("show",$show);
		$this->assign("items",$list);
		$this->assign("channelName","团购订单");
		$this->display();
	}
	public function fahuo(){
		
		if(IS_GET){
			$model=M("Order");
			//获取商品ID
			$sid=$_GET['id'];
			$list=$model->alias("a")
					->join("xj_address as b on a.addid=b.add_id")
					->join("xj_product_groupbuy as c on a.pro_id=c.pro_id")
					->where("a.id=$sid")
					->find();
			$or=$list['order_id'];
			$order=$model->where("order_id=$or")->select();
			$this->assign("data",$list);
			$this->assign("order",$order);
		}

		if(IS_POST){
			if(!empty($_POST['exnumber'])&&!empty($_POST['exname'])){
				$model=M('Order');
				//获取订单ID
				$id=$_POST['id'];
				$data['ugername']=$_POST['exname'];
				$data['courier']=$_POST['exnumber'];
				$data['delivery_time']=date("Y/m/d H:i:s",time());
				$data['pro_state']=1;
				$row=$model->where("id=$id")->data($data)->save();
				if(!empty($row)){
					$fh=$model->find($id);
					$fahuo=A('Order');
					$openid=$fh['uid'];
					$keynote1=$fh['order_id'];
					$keynote2="鲜而易见商城";
					$keynote3=$fh['ugername'];
					$keynote4=$fh['courier'];
					$keynote5="团购订单";
					$result=$fahuo->template_msg($openid,$keynote1,$keynote2,$keynote3,$keynote4,$keynote5);
					if($result=="ok"){
						display_javascript("发货完成");
					}	
					
				}
			}else{
				$this->error("快递为空!");
			}
			
		}
		$this->display();
	}
	public function del(){
		$model=D('Order');
		$id['id']=$_GET['id'];
		$row=$model->delByCondition($id);
		if(!empty($row)){
			$this->success("删除成功!",U('Order/index'));
		}
	}

	public function Update(){
		//获取ID
		$condition['id']=$_GET['id'];
		//获取状态
		$fields['t_zt']=$_GET['status'];
		$model=D('Order');
		$row=$model->update($condition,$fields);
		if(!empty($row)){
			$this->ajaxReturn(1);
		}else{
			$this->ajaxReturn(2);
		}
	}

}


?>