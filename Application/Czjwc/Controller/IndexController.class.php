<?php
namespace Czjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('沧州警卫处前台首页','utf-8');
    }
}