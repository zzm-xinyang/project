<?php
namespace Hdxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('邯郸消防支队前台首页','utf-8');
    }
}