<?php
return array(
	 //默认的数据库连接
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '172.17.128.22',
	'DB_NAME' => 'sydata',
	'DB_USER' => 'root',
	'DB_PWD' =>'Wave_335747028',
	'DB_PREFIX' => 'sy_',
	'MODULE_ALLOW_LIST' => array ('Home','Cadmin'),
    'DEFAULT_MODULE' => 'Home',
    //我的第二个数据库连接
    'DB2' => 'mysql://root:Wave_335747028@172.17.128.24:3306/ky1data_db',
    // 3N游戏数据库
    'DB3' => 'mysql://root:33youxi.root@101.200.36.145:3306/815sy',

    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	'HTML_CACHE_TIME'   =>    3600,   // 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.html', // 设置静态缓存文件后缀


	'DATA_CACHE_PREFIX' => 'AY_Redis',//缓存前缀
	'DATA_CACHE_TYPE'=>'Redis',//默认动态缓存为Redis
	'REDIS_RW_SEPARATE' => false, //Redis读写分离 true 开启
	'REDIS_HOST'=>'127.0.0.1', //redis服务器ip，多台用逗号隔开；读写分离开启时，第一台负责写，其它[随机]负责读；
	'REDIS_PORT'=>'5516',//端口号
	'REDIS_TIMEOUT'=>'300',//超时时间
	'REDIS_PERSISTENT'=>false,//是否长连接 false=短连接
	'REDIS_AUTH'=>'wave335747028',//AUTH认证密码
	'APP_SUB_DOMAIN_DEPLOY'   =>    1,//开启子域名
	'APP_SUB_DOMAIN_RULES'    =>    array(
			'www'      => 'Home',
			'm'      => 'Wap',
			'cadmin' => 'Cadmin',
		),
);
