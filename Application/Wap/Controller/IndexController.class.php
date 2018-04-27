<?php
namespace Wap\Controller;
use Think\Controller;
use Wap\Controller\InitController;
class IndexController extends InitController {
    public function Index(){
        $redisTime=7200;
        $model=D('Gameinfo');

        // 所有游戏轮播
        $data['Banner']=S('Banner11');
        if(!$data['Banner']){
            $data['Banner']=$model->Banner();
            S('Banner11',$data['Banner'],$redisTime);
        }

        // 所有游戏
        $data['game']=S('game22');
        if(!$data['game']){
            $data['game']=$model->where("find_in_set('19',label) AND state=1")->order("downloadcount desc,gametime desc")->select();
            S('game22',$data['game'],$redisTime);
        }     

         //获取当天的开服信息
        $data['Gamekf']=S('Gamekf33');
        if(empty($data['Gamekf'])){
           $day_0=strtotime(date('Y-m-d',time()));
            $day_24=strtotime(date('Y-m-d',time()+60*60*24));
            $data['Gamekf']=M('Kaifu')->where('kfday>'.$day_0." AND kfday<".$day_24)->order('kdtime')->select();
            S('Gamekf33',$data['Gamekf'],86400);
        }

         //获取明天的开服信息
        $data['Gamemtkf']=S('Gamemtkf44');
        if(empty($data['Gamemtkf'])){
           //获取明天的开服
            $MonDay_0=strtotime(date('Y-m-d',time()+60*60*24));
            $MonDay_24=strtotime(date('Y-m-d',time()+2*60*60*24));
            $MonDay_Kaifu=M('Kaifu')->where('kfday>'.$MonDay_0." AND kfday<".$MonDay_24)->order('kdtime')->select();
            S('Gamemtkf44',$data['Gamemtkf'],86400);
        }
        
    	$this->assign(array(	
                    'Gamemtkf'     =>$MonDay_Kaifu,
                    'Gamekf'       =>$data['Gamekf'],
                    'game'         =>$data['game'],
                    'Banner'       =>$data['Banner'],
                    'display'      =>1,
     		));
    	$this->display('Index');
    }





    //游戏中心
    public function Game(){
        if($_GET['type']){
            $where[]="find_in_set('".$_GET['type']."',label)";
        }
        if(!empty($_POST['key'])){
            $like=addslashes(strip_tags($_POST['key']));
            $where['gamename']=array('like',"%".$like."%");
            

        }
        $where['state']=1;
        $data['game']=M('Gameinfo')->field("id,gamename,seourl,label,logo,gamesize,iosdownload,istj,downloadcount,gametime,duction,istj")->where($where)->limit(20)->order("gametime desc")->select();
        $this->assign(array(
                        'game'=>$data['game'],
            ));
        $this->display('Game');
    }

    //IOS游戏中心
    public function IOS(){
        $data['game']=M('Gameinfo')->field("id,gamename,seourl,label,logo,gamesize,iosdownload,istj,downloadcount,gametime,duction,istj")->where(" iosdownload!='' AND state=1")->limit(20)->order("gametime desc")->select();
        $this->assign(array(
                        'game'=>$data['game'],
            ));
        $this->display('IOS');
    }

    //游戏中心
    public function Game1(){

       if($_GET['type']){
            $where[]="find_in_set('".$_GET['type']."',label)";
        }
        if(!empty($_POST['key'])){
            $like=addslashes(strip_tags($_POST['key']));
            $where['gamename']=array('like',"%".$like."%");
        }
        $where['state']=1;
        $data['game']=M('Gameinfo')->field("id,gamename,seourl,label,logo,gamesize,iosdownload,istj,downloadcount,gametime,duction,istj")->where($where)->limit(20)->order("gametime desc")->select();
        $this->assign(array(
                        'game'=>$data['game'],
            ));
        $this->display('Game1');
    }

    public function getData(){
        $model=M('Gameinfo');
        //other为Game页面的游戏类型,其他类型
        // if(!empty($_GET['key'])){

        $data['lists']=$model->field("id,gamename,seourl,seourl,label,logo,gamesize,iosdownload,istj,downloadcount,duction,gametime")->where("state=1")->order("gametime desc")->limit(20,500)->select();
        
        $this->ajaxReturn($data);
        die;
        // }
    }

    public function IOSData(){
        $model=M('Gameinfo');
        //other为Game页面的游戏类型,其他类型
        // if(!empty($_GET['key'])){

        $data['lists']=$model->field("id,gamename,seourl,label,logo,gamesize,iosdownload,istj,downloadcount,duction,gametime")->where(" iosdownload!='' AND state=1 ")->order("gametime desc")->limit(20,500)->select();
        
        $this->ajaxReturn($data);
        die;
        // }
    }

    public function Kaifu(){
        $day_0=strtotime(date('Y-m-d',time()));
        $day_24=strtotime(date('Y-m-d',time()+60*60*24));
        $data['Gamekf']=M('Kaifu')->where('kfday>'.$day_0." AND kfday<".$day_24)->order('kfday asc')->select();

        // dump($data['Gamekf']);die;
        $this->assign(array(
                    'kaifu'=>$data['Gamekf'],
            ));
        $this->display('Kaifu');
    }


    public function Top(){
        // 所有游戏
        $data['game']=S('game212');
        if(!$data['game']){
            $data['game']=M('Gameinfo')->order("downloadcount desc")->limit(100)->select();
            S('game212',$data['game'],$redisTime);
        }  
        $this->assign(array(
                        'game'=>$data['game'],
            ));
        $this->display('Top');
    }


    public function getData1(){
        $model=M('Gameinfo');
        //other为Game页面的游戏类型,其他类型
        // if(!empty($_GET['key'])){

            $data=$model->order("alwaysclick desc")->select();
            
            $this->ajaxReturn($data);
            die;
        // }
    }

    public function Lb(){
        $Lb=M('Libao')->order("create_time desc")->select();
        $this->assign(
                array(
                        'Lb'=>$Lb,
                    )
            );
        $this->display('Lb');
    }

     public function Lbxq(){
        
        $Lb=M('Libao')->find($_GET['id']);
        // dump($Lb);die;
        // 查询其他礼包信息
        $data=M('Libao')->where("gamename='".$Lb['gamename']."' AND id!=".$Lb['id'])->select();
        
        $game['gameinfo']=M('Gameinfo')->where("id='".$Lb['gamename']."'")->find();
        // dump($game);die;
        $this->assign(
                array(
                        'gameinfo'=>$game,
                        'Lb'=>$Lb,
                        'data'=>$data,
                    )
            );
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

        // //查询这个IP今天是否领取过这个游戏的这个礼包
        // $lbresult=M('Lbcodeinfo')
        //           ->where("create_time>".$date_00." AND create_time<".$date_24." AND ip='".$data['ip']."' AND lbid=".$_GET['id'])
        //           ->select();
        // if(count($lbresult)>=3){
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
        $data['end']="WAP";
        M('Lbcodeinfo')->data($data)->add();
        if(!empty($dellinekey)){
                $this->ajaxReturn($dellinekey,'json');
                die;
            }else{
                $this->ajaxReturn(2,'json');
                die;
            }
    }

    public function listgame(){
        if(!empty($_GET['id'])){
            $Game=M('Gameinfo')->find($_GET['id']);
        }else{
            $Game=M('Gameinfo')->where("seourl='".$_GET['seourl']."'")->find();
        }
        $Gameremen=M('Gameinfo')->order("id desc")->limit(8)->select();
        $this->assign(array(
                        'Gameremen'=>$Gameremen,
                        'Game'=>$Game,
            ));
        $this->display('List');
    }

    //下载统计
    public function Downapk(){
        if(is_weixin()){
            $this->error("微信用户请<b style='color:red;'>点击右上角在浏览器打开</span>。进行下载!");
            die;
        }
        $url=M('Gameinfo')->field('androiddownload,id,gamename')->find($_GET['id']);
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        $data['gid']=$url['id'];
        $data['gname']=$url['gamename'];
        $data['duan']="WAP";
        $data['create_time']=time();
        $data['phone']="apk";
        M('Appdown')->data($data)->add();
        header("Location:".$url['androiddownload']);
    }

    //IOS下载统计
    public function Downios(){

        if(is_weixin()){
            $this->error("微信用户请<b style='color:red;'>点击右上角在浏览器打开</span>。进行下载!");
            die;
        }

        $url=M('Gameinfo')->field('iosdownload,id,gamename')->find($_GET['id']);
        // dump($url);die;
        $data['ip']=$_SERVER['REMOTE_ADDR'];
        $data['gid']=$url['id'];
        $data['gname']=$url['gamename'];
        $data['duan']="WAP";
        $data['create_time']=time();
        $data['phone']="IOS";
        M('Appdown')->data($data)->add();

        if($url['iosdownload']=="#"){
            $this->error("这款游戏请联系客服获取最新的下载地址~");
            die;
        }else{
            header("Location:".$url['iosdownload']);
        }
        
        die("如果下载不了请添加客服微信btsy115获取下载地址!");
    }

    public function Search(){
        //搜索推荐前十的游戏
        $Game=M('Gameinfo')->order("gametime desc")->limit(10)->select();
        $this->assign(array(
                        'data'=>$Game,
            ));
        $this->display('Search');
    }

    public function SearchGame(){
        // dump($_POST['name']);die;
        $name=$_POST['name'];
        if(!empty($_POST['name'])){
            $keyword=$_POST['name'];
        }
        $like=addslashes(strip_tags($keyword));
        $where['gamename']=array('like',"%".$like."%");
        $data=M('Gameinfo')->where($where)->select();
        $this->assign(array(
                    'game'=>$data,
            ));
        $this->display('SearchGame');
    }

    public function News(){
        $news=M('News')->limit(100)->order("createtimenews desc")->select();
        $this->assign(array(
                    'News'     =>   $news,
            ));
        $this->display('News');
    }

    public function Newslist(){
        $where['id']=$_GET['id'];
        $data['news']=M('News')->where($where)->find();
        $data['news']['clicknumber']++;
        $newdata['clicknumber']=$data['news']['clicknumber'];

        M('News')->where($where)->data($newdata)->save();

        $Gameremen=M('Gameinfo')->order("weekclick desc")->limit(8)->select();

        $game=M('Gameinfo')->where("id='".$data['news']['game']."'")->select();
        // dump($game);die;
        $this->assign(array(
                    'Gameremen'=>$Gameremen,
                    'data'=>$data,
                    'game'=>$game,
            ));
        $this->display("Newslist");
    }
}