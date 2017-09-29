<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PmemberlistController extends CommonController {
    public function index(){
        $oid = I('oid');
        $model = D('Pmemberlist');
        $result = $model->where("oid=$oid")->find();
        //如果数据表里没有该条数据，则先添加之
        if(!$model->where("oid=$oid")->find()){
            $data['content'] = '党委领导班子成员责任';
            $data['inputtime'] = $data['updatetime'] = time();
            $data['oid'] = $oid;
            $model->add($data);
            $model->getLastsql();
            $this->redirect('Pmemberlist/index',array('oid'=>$model->getLastInsID()));
        }else{
            $list = $model->where("oid=$oid")->find();
            $this->assign('list',$list);
            $this->display();
        }

    }

    /**
     * 显示修改该信息模板
     */
    public function edit(){
        $id = I('id');
        $model = D('Pmemberlist');
        $list = $model->where("id=$id")->find();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 更改信息
     */
    public function update(){
        $id = $_POST['id'];
        $model = D('Pmemberlist');
        $data['content'] = $_POST['content'];
        $data['updatetime'] = time();
        if($model->where("id=$id")->save($data)){
            $this->redirect('Pmemberlist/index',array('oid'=>$id));
        }else{
            echo $model->getLastsql();
        }
    }
}