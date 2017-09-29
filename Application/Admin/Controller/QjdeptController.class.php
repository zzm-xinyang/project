<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class QjdeptController extends CommonController {
    public function index(){
        $oid = $this->assign('oid',I('oid'));

        //选出所有部门
        $model = D('Qjdept');
        $departments = $model->order('id asc')->select();
        $this->assign('departments',$departments);
        $this->display();
    }

    /**
     * 显示添加部门模板
     */
    public function add(){
        $oid = $this->assign('oid',I('oid'));
        $this->display();
    }

    /**
     * 保存部门
     */
    public function save(){
        $data['oid'] = $_POST['oid'];
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $data['addtime'] = $data['updatetime'] = time();

        $model = D('Qjdept');

        if($model->add($data)){
            $this->redirect('index',array('oid'=>$oid));
        }
    }

    /**
     * 显示修改部门模板
     */
    public function edit(){
        $id = I('id');
        $model = D('Qjdept');
        $department = $model->find($id);
        $this->assign('oid', I('oid'));
        $this->assign('department',$department);
        $this->display();
    }

    /**
     * 更新部门信息
     */
    public function update(){
        $id = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['description'] =$_POST['description'];
        $data['updatetime'] = time();
        $model = D('Qjdept');
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$_POST['oid']));
        }
    }

    /**
     * 删除部门
     */
    public function delete(){
        $id = I('id');
        $model = D("Qjdept");
        if($model->delete($id)){
            echo 1;
        }
    }


}