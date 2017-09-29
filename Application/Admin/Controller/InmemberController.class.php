<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class InmemberController extends CommonController {
    /**
     * 显示添加成员模板
     */
    public function add(){
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();

        $memberModel = D('Inmember');
        $members = $memberModel->field('`id`,`order`')->order('`orders` ASC')->select();
        $lastOrder = count($members)-1;
        $nextOrder = $members[$lastOrder]['orders'] + 1;
        $this->assign('nextOrder',$nextOrder);
        $this->assign('dutys',$dutys);
        $this->display();
    }

    /**
     * 添加党委成员
     */
    public function save(){
        $model = D('Inmember');
        $data['oid'] = $_POST['oid'];
        $data['did'] = $_POST['duty'];
        $data['name'] = $_POST['name'];
        $data['order'] = $_POST['order'];
        $data['inputtime'] = $data['updatetime'] = time();

        if($model->add($data)){
            $this->success("添加成功！");
            //$this->redirect('Inmitem/index',array('oid'=>$data['oid']));
        }else{
            echo $model->getLastSql();
        }
    }

    /**
     * 显示编辑成员模板
     */
    public function edit(){
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`order` ASC')->select();
        $this->assign('dutys', $dutys);
        //获取成员信息
        $id = I('id');
        $memberModel = D('Inmember');
        $member = $memberModel->find($id);
        $this->assign('member',$member);
        $this->display();
    }

    /**
     * 更新成员信息
     */
    public function update(){
        $id = $_POST['id'];
        $model = D('Inmember');
        $data['did'] = $_POST['duty'];
        $data['name'] = $_POST['name'];
        $data['order'] = $_POST['order'];
        $data['updatetime'] = time();
        $model->where("id=$id")->save($data);
        $this->success("添加成功！");
        //$this->redirect('Inmitem/index',array('oid'=>$data['oid']));
        /*if($model->where("id=$id")->save($data)){
            $this->redirect('Inmitem/index',array('oid'=>$data['oid']));
        }*/

    }

    /**
     * 删除成员
     */
    public function delete(){
        $id = I('id');
        $model = D("Inmember");
        if($model->delete($id)){
            echo 1;
        }
    }

}