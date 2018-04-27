<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-11-25
 * Time: ����10:58
 */
namespace Cadmin\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index(){
    	
       $this->display();
    }

    // 百度自动提交手机端URL页面
	public function Submitbaiduwapurl(){
		$model=M('Gameinfo')->field('seourl')->select();
		$urls=array();
		foreach ($model as $key => $value) {
				$urls[]="http://m.sy115.com/listseo/".$value['seourl'].".html";
		}

		//查询新闻页面
		$news=M('News')->field("id")->select();
		foreach ($news as $key => $value) {
				$urls[]="http://m.sy115.com/Newslist/".$value['id'].".html";
		}


		$api = 'http://data.zz.baidu.com/urls?site=m.sy115.com&token=SgHZ9k0B0TbUeSPc';
		$ch = curl_init();
		$options =  array(
		    CURLOPT_URL => $api,
		    CURLOPT_POST => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS => implode("\n", $urls),
		    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$data['count']=count($urls);
		$data['create_time']=time();
		$data['type']="wap";
		M('Seourl')->data($data)->add();
	}

	//百度自动提交PC端URL页面
	public function Submitbaidupcurl(){
		$model=M('Gameinfo')->field('seourl')->select();
		$urls=array();
		foreach ($model as $key => $value) {
				$urls[]="http://www.sy115.com/listseo/".$value['seourl'].".html";

		}

		//查询新闻页面
		$news=M('News')->field("id")->select();
		foreach ($news as $key => $value) {
				$urls[]="http://www.sy115.com/Newslist/".$value['id'].".html";
		}

		$api = 'http://data.zz.baidu.com/urls?site=www.sy115.com&token=SgHZ9k0B0TbUeSPc';
		$ch = curl_init();
		$options =  array(
		    CURLOPT_URL => $api,
		    CURLOPT_POST => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS => implode("\n", $urls),
		    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$data['count']=count($urls);
		$data['create_time']=time();
		$data['type']="pc";
		M('Seourl')->data($data)->add();
	}

	//百度自动提交PC端URL页面
	public function sy552urlpc(){
		$model=M('Gamezl','ky_',"DB2")->field('seourl')->select();
		$urls=array();
		foreach ($model as $key => $value) {
				$urls[]="http://www.sy552.com/listseo/".$value['seourl'].".html";

		}
		$api = 'http://data.zz.baidu.com/urls?site=www.sy552.com&token=SgHZ9k0B0TbUeSPc';
		$ch = curl_init();
		$options =  array(
		    CURLOPT_URL => $api,
		    CURLOPT_POST => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS => implode("\n", $urls),
		    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
	}

	//百度自动提交PC端URL页面
	public function sy3nyxurlpc(){
		$model=M('appinfo','',"DB3")->field('id')->select();
		$urls=array();
		foreach ($model as $key => $value) {
				$urls[]="http://www.sy552.com/listseo/".$value['seourl'].".html";

		}
		$api = 'http://data.zz.baidu.com/urls?site=www.sy552.com&token=SgHZ9k0B0TbUeSPc';
		$ch = curl_init();
		$options =  array(
		    CURLOPT_URL => $api,
		    CURLOPT_POST => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS => implode("\n", $urls),
		    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
		);
		curl_setopt_array($ch, $options);
	}


	public function Crawler3733Kaifu(){
		header('Content-type: text/html; charset=utf-8');  
		header('Cache-Control: no-cache, must-revalidate, max-age=0');  
		header('Pragma: no-cache');  
		$url="http://www.3733.com/kaifu/";
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER,1);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$code=curl_setopt($curl,CURLOPT_FAILONERROR,1);
		$data=curl_exec($curl);
		curl_close();
		if($code==true){
			// 获取采集匹配的内容
			preg_match_all('/<tr class="bg-g">(.*)<\/tr>/s', $data, $newdata);
			//获取采集内容
			$html_array=$this->get_td_array($newdata[0][0]);
			
			$index=0;
			$arrData=array();
			foreach($html_array as $key=>$v){
				
				$time=str_replace(array("\r\n","\r","\n"),'',$v[0]);
				$Gamename=str_replace(array("\r\n","\r","\n"),'',$v[1]);
				$Server=str_replace(array("\r\n","\r","\n"),'',$v[2]);

				if(preg_match("/今日/", $time)){
					$day_time=strtotime(mb_substr($time,2,10,"utf-8"));
					$arrData['time']=$day_time;
					$arrData['gamename']=$Gamename;
					$arrData['server']=$Server;
				}else{
					if(!preg_match("/(已开服|即将开服|开服时间)/",$time)){
						$arrData['time']=strtotime(date("Y",time())."-".substr($time,0,5)." ".substr($time,5));
						$arrData['gamename']=$Gamename;
						$arrData['server']=$Server;
					}
					
				}

				// 添加到255数据库里面去
				$result1=$this->add_255_db($arrData);
				// 添加到51数据库里面去
				$result2=$this->add_51_db($arrData);

				$data111[]=$result1;
			}
			echo count($data111);die;
		}
	}

	public function Crawler985Kaifu(){
		header('Content-type: text/html; charset=utf-8');  
		header('Cache-Control: no-cache, must-revalidate, max-age=0');  
		header('Pragma: no-cache');  
		for($i=1;$i<=5;$i++){
			$url="http://www.985sy.com/servermore/1/index_".$i.".htm";
			$curl=curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER,1);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			$code=curl_setopt($curl,CURLOPT_FAILONERROR,1);
			$data=curl_exec($curl);
			curl_close();
			if($code==true){
			// 获取采集匹配的内容
			preg_match_all('/<div class="kc_con">(.*)<\/div>/s', $data, $newdata);
			//获取采集内容
			$html_array=$this->get_dvi985_array($newdata[0][0]);
			$index=0;
			$arrData=array();
			if($html_array!=null){
				foreach($html_array as $key=>$v){
				if(!empty($v[1])){
					$time=str_replace(array("\r\n","\r","\n"),'',$v[1]);
					$Gamename=str_replace(array("\r\n","\r","\n"),'',$v[0]);
					$Server=str_replace(array("\r\n","\r","\n"),'',$v[3]);
					if(!empty($Gamename) && !empty($time) && !empty($Server)){
							$arrData['time']=strtotime(date("Y",time())."-".substr($time,0,5)." ".substr($time,5));
							$arrData['gamename']=$Gamename;
							$arrData['server']=$Server;
							// 添加到255数据库里面去
							// 添加到51数据库里面去
							if($this->add_255_db($arrData) AND $this->add_51_db($arrData)){
								$data111[]=$arrData['gamename'];
								continue;
							}
					}else{
						continue;
					}
				}else{
					continue;
				}
			  }
			}else{
				break;
			}
		 }


		}
		echo count($data111);die;
		
	}
	public function getmaiyoukf(){
		header('Content-type: text/html; charset=utf-8');  
		header('Cache-Control: no-cache, must-revalidate, max-age=0');  
		header('Pragma: no-cache');  
		// for($i=1;$i<=5;$i++){
			$url="http://adm.app.99maiyou.com/index.php?ac=kaifu";
			$curl=curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER,1);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			$code=curl_setopt($curl,CURLOPT_FAILONERROR,1);
			$data=curl_exec($curl);
			curl_close();
			// dump($data);die;
			if($code==true){
			// 获取采集匹配的内容
			preg_match_all('/<tbody class="kaifu_list">(.*)<\/tbody>/s', $data, $newdata);
			// dump($newdata);die;
			// //获取采集内容
			$html_array=$this->get_maiyou_array($newdata[0][0]);
			$index=0;
			$arrData=array();
			if($html_array!=null){
				foreach($html_array as $key=>$v){
					
				if(!empty($v[1])){
					$time=str_replace(array("\r\n","\r","\n"),'',$v[0]);
					$Gamename=str_replace(array("\r\n","\r","\n"),'',$v[1]);
					$Server=str_replace(array("\r\n","\r","\n"),'',$v[2]);
					if(!empty($Gamename) && !empty($time) && !empty($Server)){
							$arrData['time']=strtotime($time);
							$arrData['gamename']=$Gamename;
							$arrData['server']=$Server;
							// 添加到255数据库里面去
							// 添加到51数据库里面去
							if($this->add_255_db($arrData) AND $this->add_51_db($arrData)){
								$data111[]=$arrData['gamename'];
								continue;
							}
					}else{
						continue;
					}
				}else{
					continue;
				}
			  }
			}else{
				break;
			}
		 }


		// }
		echo count($data111);die;
		
	}



	//添加到255服务器sydata数据库里面去
	public function add_255_db($arrData){
		//查询255服务器是否存在这个游戏
		$Gameissetwhere['gamename']=$arrData['gamename'];
		$Game_255_isset=M('Gameinfo')->field("gamename,androiddownload,iosdownload")->where($Gameissetwhere)->find();
		

		if(isset($Game_255_isset) && !empty($Game_255_isset)){
			//查询开服表今天是否已经上传过这个游戏的区服开服信息
			$Kaifu_where['gamename']=$arrData['gamename'];
			$Kaifu_where['kfday']=$arrData['time'];
			$Kaifu_255_isset=M('Kaifu')->field("gamename,server")->where($Kaifu_where)->select();
			if(empty($Kaifu_255_isset)){
				 if(!empty($Game_255_isset['iosdownload'])){
				 	$Add_data['os']="1,2";
				 }else{
				 	$Add_data['os']=1;
				 }
				 //添加到255数据库里面去
				 $Add_data['gamename']=$arrData['gamename'];
				 $Add_data['kfday']=$arrData['time'];
				 $Add_data['server']=$arrData['server'];
				 $Add_data['kfday']=$arrData['time'];
				 $Add_data['kdtime']=$arrData['time'];
				 $Add_data['create_time']=time();
				 $Kaifu_result=M('Kaifu')->data($Add_data)->add();
				 if($Kaifu_result>0){
				 	return true;
				 }else{
				 	return false;
				 }
			}
		}
	}


	//添加到51服务器ky1data_db数据库里面去
	public function add_51_db($arrData){
		//查询255服务器是否存在这个游戏
		$Gameissetwhere['gamename']=$arrData['gamename'];
		$Gameissetwhere['status']=2;
		$Game_51_isset=M('Game','ky_','DB2')->field("gamename,gameid")->where($Gameissetwhere)->find();
		
		if(isset($Game_51_isset) && !empty($Game_51_isset)){
			//查询开服表今天是否已经上传过这个游戏的区服开服信息
			$Kaifu_where['gamename']=$arrData['gamename'];
			$Kaifu_where['daytime']=$arrData['time'];
			$Kaifu_51_isset=M('Kaifu','ky_','DB2')->field("gamename,server")->where($Kaifu_where)->select();
			if(empty($Kaifu_51_isset)){
				 //添加到255数据库里面去
				 $Add_data['gameid']=$Game_51_isset['gameid'];
				 $Add_data['gamename']=$arrData['gamename'];
				 $Add_data['daytime']=$arrData['time'];
				 $Add_data['server']=$arrData['server'];
				 $Add_data['create_time']=time();
				 $Kaifu_result=M('Kaifu','ky_','DB2')->data($Add_data)->add();
				 if($Kaifu_result>0){
				 	return true;
				 }else{
				 	return false;
				 }
			}
		}
	}



	public function get_td_array($table) {
		  
		  // 去掉table标签
		  $table = preg_replace("'<table[^>]*?>'si","",$table);

		  // 去掉tr标签
		  $table = preg_replace("'<tr[^>]*?>'si","",$table);

		  $table = preg_replace("'<td[^>]*?>'si","",$table);

		  $table = str_replace("</tr>","{tr}",$table);

		  $table = str_replace("</td>","{td}",$table);

		  //去掉 HTML 标记 
		  $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);

		  //去掉空白字符 
		  $table = preg_replace("'([rn])[s]+'","",$table);

		  $table = str_replace(" ","",$table);

		  $table = str_replace(" ","",$table);
		  $table = explode('{tr}', $table);

		  array_pop($table);
		  foreach ($table as $key=>$tr) {
		    $td = explode('{td}', $tr);
		    array_pop($td);
		    $td_array[] = $td;
		  }
		  return $td_array;
	}

	public function get_dvi985_array($table) {
		  
		  // 去掉div标签
		  $table = preg_replace("'<div[^>]*?>'si","",$table);
		  
		  // 去掉table标签
		  $table = preg_replace("'<table[^>]*?>'si","",$table);

		  // 去掉tbody标签
		  $table = preg_replace("'<tbody[^>]*?>'si","",$table);

		  $table = preg_replace("'<tr[^>]*?>'si","",$table);

		  $table = preg_replace("'<th[^>]*?>'si","",$table);

		  $table = preg_replace("'<td[^>]*?>'si","",$table);

		  $table = preg_replace("'</div[^>]*?>'si","",$table);

		  $table = preg_replace("'<a[^>]*?>'si","",$table);

		  $table = preg_replace("'<i[^>]*?>'si","",$table);

		  $table = preg_replace("'<p[^>]*?>'si","",$table);

		  $table = preg_replace("'<img[^>]*?>'si","",$table);

		  $table = preg_replace("'</a[^>]*?>'si","",$table);

		  $table = preg_replace("'</i[^>]*?>'si","",$table);

		  $table = preg_replace("'</p[^>]*?>'si","",$table);

		  $table = preg_replace("'<span[^>]*?>'si","",$table);
		  
		  $table = preg_replace("'</span[^>]*?>'si","",$table);

		  $table = str_replace("</tr>","{tr}",$table);

		  $table = str_replace("</td>","{td}",$table);

		  //去掉 HTML 标记 
		  $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);

		  //去掉空白字符 
		  $table = preg_replace("'([rn])[s]+'","",$table);

		  $table = str_replace(" ","",$table);

		  $table = str_replace(" ","",$table);
		  $table = explode('{tr}', $table);

		  array_pop($table);
		  foreach ($table as $key=>$tr) {
		    $td = explode('{td}', $tr);
		    array_pop($td);
		    $td_array[] = $td;
		  }
		  return $td_array;
	}

	public function get_maiyou_array($table) {
		  

		  // 去掉tbody标签
		  $table = preg_replace("'<tbody[^>]*?>'si","",$table);



		  $table = preg_replace("'<tr[^>]*?>'si","",$table);


		  $table = preg_replace("'<td[^>]*?>'si","",$table);

		 
		  $table = preg_replace("'<a[^>]*?>'si","",$table);
		   

		  $table = preg_replace("'<img[^>]*?>'si","",$table);

		  $table = preg_replace("'</a[^>]*?>'si","",$table);

		  $table = preg_replace("'</tbody[^>]*?>'si","",$table);



		  $table = str_replace("</tr>","{tr}",$table);

		  $table = str_replace("</td>","{td}",$table);

		  //去掉 HTML 标记 
		  $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);

		  //去掉空白字符 
		  $table = preg_replace("'([rn])[s]+'","",$table);

		  $table = str_replace(" ","",$table);

		  $table = str_replace(" ","",$table);
		  $table = explode('{tr}', $table);

		  array_pop($table);

		  foreach ($table as $key=>$tr) {
		    $td = explode('{td}', $tr);
		    array_pop($td);
		    $td_array[] = $td;
		  }
		  return $td_array;
	}

}