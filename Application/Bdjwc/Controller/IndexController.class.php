<?php
namespace Bdjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('保定警卫处前台首页','utf-8');
    }
}