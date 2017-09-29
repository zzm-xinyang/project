<?php
namespace Xtxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('邢台消防支队前台首页','utf-8');
    }
}