<?php
return array(
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型


    //远程服务器
    /*'DB_HOST'   => '103.233.251.162', // 服务器地址
   * 'DB_NAME'   => 'wbblqzco_monitor', // 数据库名
     'DB_USER'   => 'wbblqzco_dd', // 用户名
     'DB_PWD'    => 'jiankongpingtai', // 密码*/

   //本地服务器
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'monitor5', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码*/


    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志


    //开启模板布局
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'layout',
	//子域名配置
    'APP_SUB_DOMAIN_DEPLOY' =>    1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'  =>    array(
        'home'          => 'Home',
        'admin'         => 'Admin',
        'sjzxf'         => 'Sjzxf',
        'hdxf'          => 'Hdxf',
        'hsxf'          =>'Hsxf',
        'qhdxf'         =>'Qhdxf',
        'tsxf'          =>'Tsxf',
        'cdxf'          =>'Cdxf',
        'zjkxf'         =>'Zjkxf',
        'bdxf'          =>'Bdxf',
        'xtxf'          =>'Xtxf',
        'czxf'          =>'Czxf',
        'lfxf'          =>'Lfxf',
        'jwj'           =>'Jwj',
        'sjzjwc'        =>'Sjzjwc',
        'qhdjwc'        =>'Qhdjwc',
        'bdjwc'         =>'Bdjwc',
        'lfjwc'         =>'Lfjwc',
        'zjkjwc'        =>'Zjkjwc',
        'cdjwc'         =>'Cdjwc',
        'czjwc'         =>'Czjwc',
        'jwd'           =>'Jwd',

    )
);