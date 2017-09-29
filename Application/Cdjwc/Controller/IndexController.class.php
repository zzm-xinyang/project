<?php
namespace Cdjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('承德警卫处前台首页','utf-8');
    }
}