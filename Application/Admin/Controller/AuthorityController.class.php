<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class AuthorityController extends CommonController {
    public function index(){
        $model = D('Authority');
        $menus = array();
        //先选中顶级菜单
        $parents = $model->where("pid=0")->select();
        //根据选中的父菜单，选出该菜单里的子菜单
        foreach ($parents as $parent){
            $pid = $parent['id'];
            $childs = $model->where("pid=$pid")->select();
            $parent['childs'] = $childs;
            $parent['num'] = count($childs);
            $menus[] = $parents;
        }
        $this->assign("menus", $menus);
        $this->display();
    }
    public function welcome(){
        $this->display();
    }
}