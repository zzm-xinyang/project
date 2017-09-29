<?php
/**
 * 职务管理
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class DutyController extends CommonController {
    public function index(){
        $model = D('Duty');
        $this->assign('dutys',$model->order('`orders` asc')->select());
        $this->display();
    }
}