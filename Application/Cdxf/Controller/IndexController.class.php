<?php
namespace Cdxf\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('承德消防支队前台首页','utf-8');
    }
}