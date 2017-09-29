<?php
namespace Zjkjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('张家口警卫处前台首页','utf-8');
    }
}