<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="baidu-site-verification" content="0nCT1SGHHK" />
        <link rel="shortcut icon" href="/ico.ico" />
         
    <meta name="keywords" content="手游礼包,手游礼包领取中心,手游礼包大全">

          
    <meta name="description" content="115游戏发号中心是手游玩家最喜爱的手游礼包领取平台，提供特权礼包、激活码、新手卡、新服礼包、礼包兑换码、发号内测账号等信息，免费手机游戏礼包等你来领取！">
 
          
    <title>手游礼包,手游礼包领取中心,手机游戏礼包大全 礼包-115手机游戏</title>

          
   <link rel="shortcut icon" href="/favicon.ico" />

  <meta name="renderer" content="webkit">
<!--   <meta name="360-site-verification" content="b2077b52765382ea7c25d7b3e371c8ed" /> -->
  <meta name="360-site-verification" content="7fd60915948c4dbc9462fa6639719b04" />
    </head>
<body >
    
 
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/style.css">
   <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/style1.css">
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/base.css">
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/list.css">
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/top.css">
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/comm.css">
<!--   <link rel="stylesheet" type="text/css" href="/Public/Home/css/Index/style(1).css"> -->
<!--   // <script src="/Public/Home/js/hm.js"></script>
  // <script type="text/javascript" src="/Public/Home/js/mobile.js"></script> -->
  <script type="text/javascript">
    //uaredirect("http://m.3733.com");
  </script>
  <script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="/Public/Home/js/com_top.js"></script>


<script type="text/javascript" charset="utf-8"  src="/Public/Home/js/jquery.js"></script>
<!-- <script type="text/javascript" charset="utf-8" src="/Public/Home/js/base.js"></script>
<script type="text/javascript" charset="utf-8"  src="/Public/Home/js/lazyload.js"></script> -->

    <!-- 头部 -->
    <div class="h5_head">
    <?php echo BDTONGJI; ?>
    <div class="general">
      <p style="color:#646464;"><?php echo WEB_PCHEADERTITLE;?>
      </p>
      <!-- <span> -->
          <!-- <a target="_blank" href="#">手机版</a> -->
          
    </div>
    <!-- 注册弹窗 -->
    <script type="text/javascript" src="/Public/Home/js/pc_login_register.js"></script>
    <script type="text/javascript" src="/Public/Home/js/validate_function.js"></script>


  </div>
  <!--logo-->
<div class="h5_logo_bg">
    <div class="general">
        <div class="h5_logo">
            <div class="logo_left"><a href=""><img src="<?php echo substr(WEB_LOGO,1);?>" width="242" height="80"></a>
                  <span>我们只做变态服</span> 
            </div>
            <div class="h5_search">
                <form action="/Searchpost" onsubmit="var v = $(&#39;#search_keyword_input&#39;).val();
                        v = v.replace(/(^s*)|(s*$)/g, &#39;&#39;);
                        if (!v) {
                            alert(&#39;请输入游戏名称&#39;);
                            return false
                        }
                        ;" method="post">
                    <input id="search_keyword_input" name="keyboard" type="text" class="h5_text" placeholder="输入游戏名称" value="">
                    <!-- <input type="hidden" name="show" value="title,keyboard">	 -->
                   <!--  <input type="hidden" name="tempid" value="3">	
                    <input type="hidden" name="classid" value="1,43,49"> -->
                    <input type="submit" class="h5_bt" value="">
                </form>
           <p style="clear: both;margin-top: 42px;display: block;white-space: nowrap;"><span style="color:#f60;font-size:14px;"> &nbsp;热门搜索：</span> 
                                <?php foreach($keys as $key=>$val){?>
                                  <a href="<?php echo U("listseo/".$val['seourl']);?>" title="<?php echo $val['gamename'];?>" target="_blank"><?php echo $val['gamename'];?></a>
                                <?php }?> 
                           </p>
            </div>
            <div class="logo_right">
                <span><a target="_blank" href="http://www.sy115.com/Public/115.apk"><?php echo WEB_NAME?>盒子</a></span>
                <p><a href="javascript:;">微信公众号</a><em style="display: none;"><!--<i></i>--><img src="<?php echo substr(WEB_WX,1);?>"></em></p>
            </div>
        </div>
    </div>
</div>

<script>
    // var display=$("#t_home").data('display');
    // if(display!=1){
    //     $("#t_home").removeClass("curr");
    // }
    

</script>

<!--导航-->
 <div class="nav" style="clear:both;">         
      <ul>       
        <li id="t_home1" <?php echo $display==1?'class="curr"':'';?>     >          
          <a href="/Index" title="网游首页">首页</a>        
        </li>             
        <li id="t_game" <?php echo $display==2?'class="curr"':'';?>>          
          <a href="/Game/Index" title="游戏中心">游戏中心<span class="navIcon">            
            </span></a>        
        </li>           
        <li id="t_time" <?php echo $display==4?'class="curr"':'';?>>          
          <a href="/Kaifu" title="开服表">开服表</a>        
        </li>             
        <li id="t_top" <?php echo $display==5?'class="curr"':'';?>>          
          <a href="/Top" title="排行榜" >排行榜</a>        
        </li>             
        <li id="t_card" <?php echo $display==6?'class="curr"':'';?>>        
        <a href="/Lb/Index" title="礼包中心" >礼包中心</a>        
        </li>             
        <li id="t_news" <?php echo $display==7?'class="curr"':'';?>>          
          <a href="/News/Index" title="资讯">资讯</a>        
        </li>             
          
        <li id="t_kefu" <?php echo $display==8?'class="curr"':'';?>>        
        <a href="/Kf" title="客服中心" >客服中心</a>        
        </li>         
      </ul>    
    </div>   
   
    <!-- <div id="floatTools" class="float0831">
  <div id="divFloatToolsView" class="floatR">
    <div class="tp"></div>
    <div class="cn">
      <ul>
        <li class="top">
          <h3 class="titZx">QQ咨询</h3>
        </li>
        <li><span class="icoZx">在线咨询</span> </li>
        <li><a class="icoTc" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1942329047&site=qq&menu=yes" rel="nofollow">返利咨询</a> </li>
        <li><a class="icoTc" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=3201994506&site=qq&menu=yes" rel="nofollow">礼包咨询</a> </li>
        <li><a class="icoTc" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=3067175948&site=qq&menu=yes" rel="nofollow">开服咨询</a> </li>
        <li><a class="icoTc" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=61ea82e8b1d81b757b0e7d934a2554b7bcb58372c03b53fb210e0201ce83fc63" rel="nofollow">玩家QQ群1</a> </li>
        <li><a class="icoTc" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=fca39f7651e47a00004f02c2b952e2ddf27cb077467c60ecbc7d71ddfb604c76" rel="nofollow">玩家QQ群2</a> </li>
        <li class="bot"><a class="icoTc" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=7b97144dc7693412953f40946ead58ab44f2a7c7361477fdc8e3803b5ba1d11f" rel="nofollow">玩家QQ群3</a> </li>
      </ul>
    </div>
  </div>
</div> -->
    <!-- 主要内容 -->
     
<link rel="stylesheet" href="/Public/Home/lbxq/newfah.css" />
<script type="text/javascript" src="/Public/Home/lbxq/newfah.js"></script> 
<meta http-equiv="X-UA-Compatible" content="IE=8">
<style>
    body{
      background:white;
    }
</style>
        <style type="text/css">
            #siteNav .layout{width: 950px;}
        </style>
        

        <div class="main">
            <div class="weizhi">
                <p>
                    当前位置：<a href="/Index">首页</a>&nbsp;&gt;&nbsp;<a href="/Lb">礼包</a>
                </p>
            </div>
            <div class="wrap clearfix">
                <div class="main_lf">
                    <div class="wrap1" style="display:block">
                        <div class="wrap_tt"><span></span>领取中心</div>
                        <div class="wrap_list">
                            <dl class="clearfix"><dt>类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</dt><dd><a class="<?php echo $_SESSION['lb_select1']?>" href="/Lborder/news">最新</a><a class="<?php echo $_SESSION['lb_select2']?>" href="/Lborder/istj">热门</a></dd>
                            </dl> 
                        </div>
                    </div>
                    <div class="wrap2">
                        <div class="wrap_tt" style="display:none"><span></span>最新礼包<em>共找到<i>586</i>个</em></div>
                        <div class="warp2_list">
                    <ul class="clearfix">
            <?php foreach($Data['lbinfo'] as $k=>$v){ $Game=M('Gameinfo')->where("id=".$v['gamename'])->find(); ?>
                        <li>
                            <div class="imgli"><a href="<?php echo U('Lbxq/'.$v['id']);?>" target="_blank"><img src="/Public/Upload/Product/<?php echo $Game['logo']?>" alt="<?php echo $v['lbname']?>"></a></div>
                            <div class="txtli">
                                <p class="ptitle"><a href="<?php echo U('Lbxq/'.$v['id']);?>" target="_blank"><?php echo $v['lbname']?></a></p>
                                <p class="ptxt"><?php echo $v['content']?></p>
                                <p class="plq">
                                      <?php  $os=explode(",",$v['os']); if($os[0]==1){ ?>
                                        <span class="az" style="display:display "></span>
                                         <?php } if($os[1]==2 OR $os[0]==2){?>    
                                        <span class="ios" style="display:display "></span>
                                         <?php }?>  
                                    <?php  $file=$v['path']; $count=count(file($file)); $jilu=$v['jilu']; $countLB=100-(round($jilu/($count+$jilu),2)*100); ?> 
                                    <em>剩余：<?php echo $countLB?>%</em>
                                    <a href="<?php echo U('Lbxq/'.$v['id']);?>" target="_blank" class="qh">领取</a>
                                </p>
                            </div>
                        </li>             
            <?php }?>
                   </ul>
                        </div>
                        <div class="page">
                            <div class="gy_page fhpage">
                                <?php echo ($show); ?>
                               <!--  <span class="num">共：227条</span>&nbsp;&nbsp;&nbsp;<b>1</b>&nbsp;<a href="http://www.3733.com/listinfo-18-1.html">2</a>&nbsp;<a href="http://www.3733.com/listinfo-18-2.html">3</a>&nbsp;<a href="http://www.3733.com/listinfo-18-3.html">4</a>&nbsp;<a href="http://www.3733.com/listinfo-18-4.html">5</a>&nbsp;<a href="http://www.3733.com/listinfo-18-5.html">6</a>&nbsp;<a href="http://www.3733.com/listinfo-18-1.html">下一页</a>&nbsp;<a href="http://www.3733.com/listinfo-18-11.html">尾页</a> -->
                                
                            </div>					
                        </div>
                    </div>
                </div>
                <div class="main_rg">
                    <div class="rmlb_list">
                        <div class="wrap_tt"><span></span>热门礼包</div>
                        <div class="listbox">
                            <ul class="clearfix">
            <?php foreach($Data['rementj'] as $k1=>$v1){ $Game1=M('Gameinfo')->where("id=".$v1['gamename'])->find(); ?>
                            <li>   
                              <div class="prediv"><span><?php echo $v1['lbname']?></span>
                                        <a href="<?php echo U('Lbxq/'.$v1['id']);?>" target="_blank">领取</a></div>
                                    <div class="hoverdiv">
                                        <div class="imgdiv"><a href="<?php echo U('Lbxq/'.$v1['id']);?>" target="_blank">
                                                <img src="/Public/Upload/Product/<?php echo $Game1['logo']?>" alt="<?php echo $v1['lbname']?>"></a></div>
                                        <div class="txtdiv">
                                            <p class="ptitle"><a href="_<?php echo U('Lbxq/'.$v1['id']);?>" target="_blank">
                                            <?php echo $v1['lbname']?></a></p>
                                         <?php  $file=$v1['path']; $count=count(file($file)); $jilu=$v1['jilu']; $countLB=100-(round($jilu/($count+$jilu),2)*100); ?> 
                                            <p class="psl">剩余：<?php echo $countLB?>%<a href="<?php echo U('Lbxq/'.$v1['id']);?>" class="qh" target="_blank">领取</a></p>
                                        </div>
                                    </div>
                                </li> 
             <?php }?>                  
                            </ul>
                        </div>
                    </div>
                </div>
           
            </div>

        </div>
 
    <!-- 底部 -->
    
  <script type="text/javascript" 
  data-main="/Public/Home/js/index.js" src="/Public/Home/js/require.js"></script>
  <script type="text/javascript">
    $(".b1-slide").find('img[data-original]').each(function () {
      $(this).attr('src', $(this).attr('data-original'))
        .removeAttr('data-original');
    });
  </script>


  <div id="footer">
    <div class="link clearfix">
      <h2>友情链接</h2>
            <a href="http://www.sy115.com" title="115手机游戏" target="_blank">
        115手机游戏   </a>
            <a href="http://m.sy115.com" title="手游公益服" target="_blank">
        手游公益服      </a>
            <a href="hhttp://www.sy115.cn" title="手游私服" target="_blank">
        手游私服      </a>
            <a href="http://www.sy115.com/Game/Index" title="热门手游私服" target="_blank">
        热门手游私服 </a>
            <a href="http://www.sy115.com/Kaifu" title="最新手游私服开服表" target="_blank">
        最新手游私服开服表      </a>
            <a href="http://www.sy115.com/Top" title="手游私服排行榜" target="_blank">
        手游私服排行榜      </a>
            <a href="http://www.sy115.com/Lb/Index" title="手游私服礼包" target="_blank">
        手游私服礼包      </a>
            <a href="http://www.sy115.com/News/Index" title="手游私服咨询" target="_blank">
         手游私服咨询     </a>
            <a href="http://www.sy115.com/Newstype/3" title="手游私服测评" target="_blank">
        手游私服测评      </a>
            <a href="http://www.sy115.com/listseo/mhjqb.html" title="梦幻加强版" target="_blank">
        梦幻加强版      </a>
            <a href="http://www.sy115.com/listseo/mhty.html" title="梦幻桃源 " target="_blank">
       梦幻桃源       </a>
      
    </div>
    <div class="siteMap">
      <div class="map">
<p>          <a href="/Index.html" target="_blank">关于本站</a><em>|</em>
 		<a href="<?php echo WEB_KFQQ?>" target="_blank">联系我们</a><em>|</em>
 		<a href="/Index.html" target="_blank">帮助中心</a><em>|</em>
 		<a href="/Index.html" target="_blank">版权声明</a><em>|</em>
 		<a href="/Index.html" target="_blank">友情链接</a><em>|</em>
 		<a href="/Index.html" target="_blank">家长监护</a><em>|</em>
 		<a href="/Index.html" target="_blank">网站地图</a>
 	

 <p> 健康游戏忠告：抵制不良游戏 拒绝盗版游戏 注意自我保护 谨防上当受骗 适度游戏益脑 沉迷游戏伤身 合理安排时间 享受健康生活<br>
 <p>115手机游戏私服发布网,是专业的手游私服发布网站,每周更新数款最新的手游私服,站内有最新的苹果IOS手机游戏私服,安卓手机游戏私服,类型有:无限元宝手游,卡牌类手游私服,仙侠类手游私服,武侠类手游私服,满VIP手游私服,回合类手游私服,各热门手游:青云志私服,大主宰私服,少年三国志私服,天龙八部私服,梦幻西游手游私服,大话西游手游私服,问道手游私服,苹果手游私服,除了这些之外,每天还更新最新的热门手机游戏私服开服表,游戏数量上千款,每天新开游戏上百款,欢迎大家光临本站!</p>

 Copyright © 2014-2017 <a href=""><?php echo $_SERVER['HTTP_HOST']?></a> All rights reserved&nbsp;<a href="javascript:;" target="_blank">备案号：京ICP备10326号</a>&nbsp;京网文[2017]1219-015号 <a href="javascript:;"><?php echo WEB_NAME?></a> 版权所有 <span id="cnzz_stat_icon_1259904712"></span>
 
</p> 
 <script language="javascript" type="text/javascript" src="//js.users.51.la/19296242.js"></script>
</div>
    </div>
  </div>
<!--   // <script src="/Public/Home/js/xp_new.js" type="text/javascript"></script> -->
  <div class="clear"></div>
  <script>
    $(function () {
       $("#t_home").addClass('curr');
      $('.itab').hover(function () {
        var index = $(this).index();
        $(this).addClass('hover').siblings('.itab').removeClass('hover');
        $('.b3-l-slidebox').eq(index).show().siblings('.b3-l-slidebox').hide();
      })
    })
  </script>
    <!-- javascript区域-->
    
  
</body>
</html>