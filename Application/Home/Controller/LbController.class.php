<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\InitController;
class LbController extends InitController {
    public function Index(){
        if(!empty($_GET['order'])){
            if($_GET['order']=="istj"){
                $order=$_GET['order']." desc";
                $_SESSION['lb_select1']="";
                $_SESSION['lb_select2']="on";

            }
            if($_GET['order']=="news"){
                $order="create_time desc";
                $_SESSION['lb_select2']="";
                $_SESSION['lb_select1']="on";

            }
        }else{
            $_SESSION['lb_select1']="on";
            $order="id desc";
        }
        $Model=M('Libao');
        $count=$Model->where($where)->count();
        $Page =new \Think\Page($count,20);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('first','第一页');
        $Page->setConfig('last','第一页');
        

        $data['lbinfo']=$Model->where($where)->limit($Page->firstRow.','.$Page->listRows)->order($order)->select();

        // //热门推荐礼包
        $data['rementj']=$Model->order("istj desc")->limit(20)->select();

        // //获取最新礼包
        // $data['newlb']=$model->order('create_time desc')->select();
        $this->assign(array(	
    				'Data'         =>$data,
                    'show'     =>$Page->show(),
                    'display'        =>6,
     		));
    	$this->display('Index');
    }

    public function Lbxq(){
        $model=M('Libao');
        if(!empty($_GET['gamename'])){
            $where['gamename']=$_GET['gamename'];
        }else{
            $where['id']=$_GET['id'];
        }
        
        $data['lbinfo']=$model->where($where)->find();
        if(!empty($data['lbinfo']))
        {

        
        //查找礼包关联的游戏
        $data['gameinfo']=M('Gameinfo')->where("id=".$data['lbinfo']['gamename'])->find();
        
        // 查询其他礼包信息
        $data['lbdata']=M('Libao')->where("gamename='".$data['lbinfo']['gamename']."'")->select();

        //查询游戏相关咨询
        $data['gmnews']=M('News')->where("game=".$data['lbinfo']['gamename'])->limit(5)->select();
        
        //获取游戏开服
        $data['kaifu']=M('Kaifu')->where("gamename='".$data['gameinfo']['gamename']."'")->order('kfday desc')->select();
       
        //热门推荐礼包
        $data['rementj']=$model->order("istj desc")->limit(20)->select();
    }else{
        $this->error('抱歉,此游戏暂无礼包,请联系客服获取!',U('Index'));
        die;
    }
        $this->assign(array(
                    'data'    =>    $data,
            ));
        $this->display('Lbxq');
    }

    //领取礼包
    public function linghao(){
        $libao=M('Libao')->find($_GET['id']);
        //获取今天00.00的时间
        $date_00=strtotime(date("Y-m-d",time()));
        // 获取明天的时间戳
        $date_24=strtotime(date("Y-m-d",time()+60*60*24));
        //获取客服端IP地址
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        //获取礼包ID
        $data['lbid']=$_GET['id'];

        //查询这个IP今天是否领取过这个游戏的这个礼包
        // $lbresult=M('Lbcodeinfo')
        //           ->where("create_time>".$date_00." AND create_time<".$date_24." AND ip='".$data['ip']."' AND lbid=".$_GET['id'])
        //           ->select();
        // if(count($lbresult)>=5){
        //     $this->ajaxReturn(3,'json');
        //     die;
        // }

        //获取礼包地址
        $path=$libao['path'];
        $filename=$path;//定义操作文件
       
        $delcount=0;//已删除的行数
        $farray=file($filename);//读取文件数据到数组中
        $dellinekey=trim($farray[0]); //要删除的行关键字
        for($i=0;$i<count($farray);$i++)
        {   
          if($delcount == 0 && substr_count($farray[$i],$dellinekey) > 0)  //先判断是否已删除一次，再判断当前行是否包含关键字，是则删除
          {   
             $delcount++;//标记删除一次
            continue;
          }   
          if(trim($farray[$i])<>"")  //删除文件中的所有空行
          {   
              $newfp.=$farray[$i];    //重新整理后的数据
          }   
        }   
        $fp=@fopen($filename,"w");//以写的方式打开文件
        @fputs($fp,$newfp);
        @fclose($fp);
        
        
        
        $data['lbname']=$libao['lbname'];
        $data['code']=$dellinekey;
        $data['gid']=$libao['gamename'];
        $data['create_time']=time();
        $data['end']="PC";
        M('Lbcodeinfo')->data($data)->add();
        if(!empty($dellinekey)){
                $this->ajaxReturn($dellinekey,'json');
                die;
            }else{
                $this->ajaxReturn(2,'json');
                die;
            }
    }
}