<?php
namespace Zjkxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('张家口消防支队前台首页','utf-8');
    }
}