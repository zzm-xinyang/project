<?php
namespace Tsxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('唐山消防支队前台首页','utf-8');
    }
}