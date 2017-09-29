<?php
namespace Czxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('沧州消防支队前台首页','utf-8');
    }
}