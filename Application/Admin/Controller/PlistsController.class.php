<?php
/**
 * 党委领导班子集体责任
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PlistsController extends CommonController {
    public function index(){
        $this->display();
    }
    public function welcome(){
        $this->display();
    }
}