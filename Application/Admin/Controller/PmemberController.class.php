<?php
/**
 * 党委班子成员
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PmemberController extends CommonController {
    /**
     * 显示添加成员模板
     */
    public function add(){
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();

        $memberModel = D('Pmember');
        $members = $memberModel->field('`id`,`orders`')->order('`orders` ASC')->select();
        $lastOrder = count($members)-1;
        $nextOrder = $members[$lastOrder]['order'] + 1;
        $this->assign('nextOrder',$nextOrder);
        $this->assign('dutys',$dutys);
        $this->display();
    }

    /**
     * 添加党委成员
     */
    public function save(){
        $model = D('Pmember');
        $data['oid'] = $_POST['oid'];
        $data['did'] = $_POST['duty'];
        $data['name'] = $_POST['name'];
        $data['order'] = $_POST['order'];
        $data['inputtime'] = $data['updatetime'] = time();

        if($model->add($data)){
            $this->success("保存成功！");
            //$this->redirect('Pmitem/index',array('oid'=>$data['oid']));
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
        $dutys = $dutyModel->order('`orders` ASC')->select();
        $this->assign('dutys', $dutys);
        //获取成员信息
        $id = I('id');
        $memberModel = D('Pmember');
        $member = $memberModel->find($id);
        $this->assign('member',$member);
        $this->display();
    }

    /**
     * 更新成员信息
     */
    public function update(){
        $id = $_POST['id'];
        $model = D('Pmember');
        $data['did'] = $_POST['duty'];
        $data['name'] = $_POST['name'];
        $data['orders'] = $_POST['order'];
        $data['updatetime'] = time();

        if($model->where("id=$id")->save($data)){
            $this->success("修改成功！");
            //$this->redirect('Pmitem/index',array('oid'=>$data['oid']));
        }
    }

    /**
     * 删除成员
     */
    public function delete(){
        $id = I('id');
        $model = D("Pmember");
        if($model->delete($id)){
            echo 1;
        }
    }

}