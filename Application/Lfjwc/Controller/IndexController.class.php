<?php
namespace Lfjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('廊坊警卫处前台首页','utf-8');
    }
}