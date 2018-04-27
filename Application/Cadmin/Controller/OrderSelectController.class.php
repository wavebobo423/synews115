<?php
namespace Cadmin\Controller;

use Think\Model;
class OrderSelectController extends BaseController{

	protected $modelName ="Order";

	public function index(){
		$model=M('Order');
		$order_id      = isset($_POST['order_id'])?I("post.order_id"):'';
		$condition['a.order_id'] = $order_id;
		//查询订单类型
		$row=$model->field("p_tuangou,id")->where("order_id='{$order_id}'")->select();
		$newdata=array();
		for($i=0;$i<count($row);$i++){
			$a.=(int)$row[$i]['id'].",".(int)$row[$i]['p_tuangou']."/";
		}
		$sta=explode("/",$a);
		// echo $sta[0];
		$newdata=array();
		for($j=0;$j<count($sta);$j++){
			$kissa=explode(",",$sta[$j]);
			if($kissa[1]==0){
					$newdata[]=$model->alias("a")
								     ->join("xj_product as b on a.pro_id=b.pro_id")
								     ->join("xj_speci as c on a.gid=c.spe_id")
								     ->field("a.*,b.pro_name,b.cover,c.*")
									 ->where("a.id='{$kissa[0]}'")
									 ->select();
			}
		}
		for($p=0;$p<count($sta);$p++){
			$kissa=explode(",",$sta[$p]);
			if($kissa[1]==1){
				// echo $kissa[0];
					$data[]=$model->alias("a")
								 ->join("xj_product_groupbuy as b on b.pro_id=a.pro_id")
								 ->where("a.id='{$kissa[0]}'")
								 ->select();
			}
		}
		//查询订单是否使用过优惠卷
		if(!empty($order_id)){
			$mdata=M('Uvolume')->where("dname={$order_id}")->find();
		}
		
		// echo "<pre>";
		// var_dump($data);
		// echo "<hr>";
		// var_dump($newdata);
		$list=array();
		foreach($newdata as $k=>$v){
			foreach($v as $j){
				$list[]=$j;
			}
		}
		foreach ($data as $key => $value) {
			foreach($value as $c){
				$list[]=$c;
			}
		}

		// var_dump($list);
		$this->assign("uvolume",$mdata);
		$this->assign("items",$list);
		$this->assign("order_id",$order_id);
		$this->assign("channelName","订单查询");
		$this->display();
	}
	public function fahuo(){
		
		if(IS_GET){
			$model=M("Order");
			//获取商品ID
			$sid=$_GET['id'];
			// echo $sid;
			// die();
			$list=$model->alias("a")
					->join("xj_address as b on a.addid=b.add_id")
					->join("xj_speci as c on c.spe_id=a.gid")
					->join("xj_product as d on d.pro_id=a.pro_id")
					->field("a.*,b.*,c.*,d.pro_name")
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
				if($row){
					display_javascript("发货完成");
				}
			}else{
				$this->error("快递为空!");
			}
			
		}
		$this->display();
	}

	public function get_pro_id($order_id)
	{
		$Model = new Model();
		$res = $Model->query("select pro_id,gid from xj_order WHERE order_id = {$order_id}");
		return $res;
	}
	public function get_pro_info($pro_id,$gid){
		$product = M("product");
		$product->where("pro_id = ".$pro_id)->find();
		$Model = new Model();
		$res = $Model->query("SELECT pro.pro_name,sp.spename1 FROM xj_product pro LEFT JOIN xj_speci sp ON pro.pro_id=sp.pro_id WHERE sp.spe_id ={$gid} AND pro.pro_id={$pro_id}");
		return $res;
	}

	public function array_unique_item($items){
		print_r($items);
		foreach($items as $k=>$item){
			$old_order[$k] = $item['order_id'];
		}
		echo 22;
		print_r($old_order);exit();
		$new_order = array_unique($old_order);
		$res = array_diff_assoc($old_order,$new_order);
		$key = array_keys($res);
		unset($items[$key]);
	}
}


?>