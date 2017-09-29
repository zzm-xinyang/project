<?php
namespace Jwj\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('警卫局前台首页','utf-8');
    }
}