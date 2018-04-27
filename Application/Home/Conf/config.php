<?php
return array(
	'URL_MODEL' => 2,
	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES'=>array(
    		'Index'=>'Home/Index/Index',
            // 'Game/:p' =>'Home/Game/Index',
    		// 'Game'=>'Home/Game/Index',
    		'Kaifu'=>'Home/Kaifu/Index',
    		'Top'=>'Home/Top/Index',
    		// 'Lb'=>'Home/Lb/Index',
    		// 'News'=>'Home/News/Index',
    		'Kf'=>'Home/News/Kf',
    		'List/:id'=>'Home/Game/Game',
    		'gamalist/:gamename'=>'Home/Game/Game',
            'listseo/:seourl'=>'Home/Game/Game',
    		'Newslist/:id'=>'Home/News/Content',
            'Newstype/:type'=>'Home/News/Index',
    		'Lbxq/:id' =>'Home/Lb/Lbxq',

    		'Lbname/:gamename' =>'Home/Lb/Lbxq',
    		'Gameselectos/:os'=>'Home/Game/Index',
    		'Gameselectbb/:bb'=>'Home/Game/Index',
    		'Gameselectlx/:lx'=>'Home/Game/Index',
    		'Gameselectaction/:action'=>'Home/Game/Index',
            'Lborder/:order'  =>'Home/Lb/Index',
            'Search/:keyboard'  =>'Home/Index/Search',
            'Searchpost'  =>'Home/Index/Search',
            'Linghao/:id'  =>'Home/Lb/linghao',
            'Downapk/:id' =>'Home/Game/Downapk',
            'Downios/:id' =>'Home/Game/Downios',
	),
	// 'URL_CASE_INSENSITIVE' => true,
 //    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	// 'HTML_CACHE_TIME'   =>    120,   // 全局静态缓存有效期（秒）
	// 'HTML_FILE_SUFFIX'  =>    '.html', // 设置静态缓存文件后缀
	// 'HTML_CACHE_RULES'=>array(
 //        '*' => '{:module}/{:controller}_{:action}',
 //         //Wap控制器下的index方法,按照规则生成缓存文件
 //    ),

);