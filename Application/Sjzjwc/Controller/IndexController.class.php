<?php
namespace Sjzjwc\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('石家庄警卫处前台首页','utf-8');
    }
}