<?php
namespace Jwd\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('警卫队前台首页','utf-8');
    }
}