<?php
namespace Bdxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('保定消防支队前台首页','utf-8');
    }
}