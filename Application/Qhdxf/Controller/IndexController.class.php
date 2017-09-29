<?php
namespace Qhdxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('秦皇岛消防支队前台首页','utf-8');
    }
}