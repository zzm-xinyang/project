<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
//define('BIND_MODULE','Admin'); //后台管理模块
//define('BIND_MODULE','Sjzxf'); //石家庄消防支队
//define('BIND_MODULE','Hdxf'); //邯郸消防支队
//define('BIND_MODULE','Hsxf'); //衡水消防支队
//define('BIND_MODULE','Qhdxf');//秦皇岛消防支队
//define('BIND_MODULE','Tsxf');//唐山消防支队
//define('BIND_MODULE','Cdxf');//承德消防支队
//define('BIND_MODULE','Zjkxf');//张家口消防支队
//define('BIND_MODULE','Bdxf');//保定消防支队
//define('BIND_MODULE','Xtxf');//邢台消防支队
//define('BIND_MODULE','Czxf');//沧州消防支队
//define('BIND_MODULE','Lfxf');//廊坊消防支队
//define('BIND_MODULE','Jwj');//警卫局
//define('BIND_MODULE','Sjzjwc');//石家庄警卫处
//define('BIND_MODULE','Qhdjwc');//秦皇岛警卫处
//define('BIND_MODULE','Bdjwc');//保定警卫处
//define('BIND_MODULE','Lfjwc');//廊坊警卫处
//define('BIND_MODULE','Zjkjwc');//张家口警卫处
//define('BIND_MODULE','Cdjwc');//承德警卫处
//define('BIND_MODULE','Czjwc');//沧州警卫处
//define('BIND_MODULE','Jwd');//警卫队

// 定义应用目录
define('APP_PATH','./Application/');

define('UPLOAD_PATH','./uploads/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单