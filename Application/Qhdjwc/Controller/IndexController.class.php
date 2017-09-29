<?php
namespace Qhdjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('秦皇岛警卫处前台首页','utf-8');
    }
}