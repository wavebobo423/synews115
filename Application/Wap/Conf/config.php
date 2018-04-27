<?php
return array(
	'URL_MODEL' => 2,
	'URL_ROUTER_ON'   => true, 
    
	'URL_ROUTE_RULES'=>array(
    		'Index'             =>'Home/Index/Index',
    		'IndexData'         =>'Home/Index/getData',
             'Game'              =>'Home/Index/Game',
            'Gametype/:type'    =>'Home/Index/Game',
            'Gamesearch'        =>'Home/Index/Game',
            'getData'           =>'Home/Index/getData',
            'getDatatype/:type' =>'Home/Index/getData',
            'Kaifu'             =>'Home/Index/Kaifu',
            'Top'               =>'Home/Index/Top',
            'getData1'          =>'Home/Index/getData1',
            'Lb'                =>'Home/Index/Lb',
            'Lbxq/:id'          =>'Home/Index/Lbxq',
            'Linghao/:id'       =>'Home/Index/linghao',
            'listgame/:id'      =>'Home/Index/listgame',
            'listseo/:seourl'   =>'Home/Index/listgame',
            'Down/:id'          =>'Home/Index/Downapk',
            'Downios/:id'       =>'Home/Index/Downios',
            'Game1'             =>'Home/Index/Game1',
            'Search'            =>'Home/Index/Search',
            'SearchGame'        =>'Home/Index/SearchGame',
            'News'              =>'Home/Index/News',
            'Newslist/:id'      =>'Home/Index/Newslist',
            'IOS'               =>'Home/Index/IOS',
            'IOSdata'           =>'Home/Index/IOSData',
            



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