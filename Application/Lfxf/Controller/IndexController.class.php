<?php
namespace Lfxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('廊坊消防支队前台首页','utf-8');
    }
}