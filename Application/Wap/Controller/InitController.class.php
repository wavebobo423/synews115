<?php
namespace Wap\Controller;
use Think\Controller;
class InitController extends Controller {

	
   //网站配置初始化信息
    public function __construct(){
        parent::__construct();
        $config=M('Webconfig')->find();
        //定义PC网站前台LOGO
        define('WAP_LOGO',$config['waplogo']);

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

        $keys=M('Gameinfo')->field('id,gamename')->where('score!=""')->limit(5)->order('score desc')->select();
        $this->assign(array(
                        'keys'=>$keys,
            ));
       
         //全部变成小写字母
         $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
         $type = 'other';
         //分别进行判断
         if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
        {
            $type = 'ios';
            define('WAP_TYPEPHONE',$type);
         } 
          
         if(strpos($agent, 'android'))
        {
            $type = 'apk';
            define('WAP_TYPEPHONE',$type);
         }
         
       

    }
}