<?php
namespace Home\Controller;
use Think\Controller;
class InitController extends Controller {

	
   //网站配置初始化信息
    public function __construct(){
        parent::__construct();
        $config=M('Webconfig')->find();
        //定义PC网站前台LOGO
        define('WEB_LOGO',$config['pclogo']);

        //定义WAP网站标题
        define('WEB_TITLE',$config['title']);

        //定义首页网站描述
        define('WEB_DESC',$config['desc']);

        //首页关键字
        define('WEB_KEYWORD',$config['keyword']);

        //定义客服QQ
        define('WEB_KFQQ',$config['kfqq']);

        //定义QQ群
        define('WEB_QQQUN',$config['qqqun']);

        //微信图片
        define('WEB_WX',$config['wx']);
        
        //首页头部标题介绍
        define('WEB_PCHEADERTITLE',$config['pcheadertitle']);

        // 网站名称
        define('WEB_NAME',$config['webname']);

        // 网站名称
        define('BDTONGJI',$config['bdtongji']);

        $keys=M('Gameinfo')->field('id,gamename,seourl')->where('score!=""')->limit(5)->order('score desc')->select();
        $this->assign(array(
                        'keys'=>$keys,
            ));
         $a=explode("/",$_SERVER['HTTP_USER_AGENT']);
         $b=explode(";",$a[1]);
         //判断是否为IOS
         $ios="iPhone";
         //判断是否为安卓
         $android="Linux";

         // dump(is_weixin());
         // // $url=explode(".",$_SERVER['SERVER_NAME']);
         // echo $_SERVER['HTTP_USER_AGENT'];
         if(is_weixin()){
            header("Location:http://m.sy115.cn");
            die;
         }
         if(strpos($b[0],$ios)){
             header("Location:http://m.sy115.com");
             die;
         }elseif(strpos($b[0],$android)){
             header("Location:http://m.sy115.com");
             die;
         }

    }
}