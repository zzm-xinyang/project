<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class InleaderlistController extends CommonController {
    public function index(){
        $oid = I('oid');
        $model = D('Inleaderlist');
        $result = $model->where("oid=$oid")->find();
        //如果数据表里没有该条数据，则先添加之
        if(!$model->where("oid=$oid")->find()){
            $data['content'] = '纪委主要负责人责任';
            $data['inputtime'] = $data['updatetime'] = time();
            $data['oid'] = $oid;
            $model->add($data);
            $model->getLastsql();
            $this->redirect('Pleaderlist/index',array('oid'=>$model->getLastInsID()));
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
        $model = D('Inleaderlist');
        $list = $model->where("id=$id")->find();
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 更改信息
     */
    public function update(){
        $id = $_POST['id'];
        $model = D('Inleaderlist');
        $data['content'] = $_POST['content'];
        $data['updatetime'] = time();
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$id));
        }else{
            echo $model->getLastsql();
        }
    }

}