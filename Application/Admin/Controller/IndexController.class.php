<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class IndexController extends CommonController {
    public function index(){
        $oid = session('oid');

        //分配第一个部门的部门id
        $model = D('Qjdept');
        $department = $model->where("oid=$oid")->order('id asc')->find();
        $this->assign('mid',$department['id']);


        //获取组织名
        $organizaModel = D('Organize');
        $this->assign('organize',$organizaModel->getOrganize($oid));

        //获取前台角色
        $groupModel = D('Group');
        $this->assign('group',$groupModel->getRoleName(session('rid')));

        $this->display();
    }
    public function welcome(){
        $this->display();
    }
}