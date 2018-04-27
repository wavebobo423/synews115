<?php
date_default_timezone_set('PRC');
$array=array(
		'http://www.baidu.com',
		'http://www.qq.com',
		'http://www.taobao.com',
		'http://www.sina.com.cn',
		'http://www.163.com/',
		'http://www.163.com/',
		'http://www.12306.cn/',
	);

//把array分成4个组，并且每个组2个
// 先获取数组的总数
$array_chunk=array_chunk($array,2,true);
for($i=0;$i<4;$i++){
	$pid=pcntl_fork();

	if($pid==-1){
		die("create process failed");

	}else if($pid>0){
		// 父进程
		pcntl_wait($status,WNOHANG);
		echo "我是父进程:我的PID是：".getmypid()."时间:".date("Y-m-d H:i:s",time())."\n";
	}else if($pid==0){
		// sleep(1);
		//子进行处理逻辑
		foreach($array_chunk[$i] as $key=>$val){
			echo "我的PID是".getmypid()."时间:".date("Y-m-d H:i:s",time())."我执行的网址是第:".$key."个/".$val."\n";
		}
		exit(0);
	}
}
