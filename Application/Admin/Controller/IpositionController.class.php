<?php
/**
 * 领导岗位权力
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class IpositionController extends CommonController {
    public function index(){
        //确定组织
        $oid = I("oid");
        $this->assign('oid',$oid);

        //获取成员列表
        $memberModel = D('Iposition');
        $members = $memberModel->field('`dutys`.`duty`,`lpostions`.*')->join('dutys ON dutys.id=lpostions.did')->order('`lpostions`.`orders` asc')->select();
        $this->assign('members',$members);



        //主体责任分解清单落实情况列表，默认显示第一个人的事项
        if(I('who')){
            $who = I('who')-0;
        }else{
            $who = $members[0]['id'];
        }
        $member=$memberModel->find($who);
        $this->assign('member',$member);
        $this->assign('who',$who);
        $this->display();
    }
    /**
     * 显示添加成员模板
     */
    public function add(){
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();

        $model = D('Iposition');
        $members = $model->field('`id`,`orders`')->order('`orders` ASC')->select();
        $lastOrder = count($members)-1;
        $nextOrder = $members[$lastOrder]['orders'] + 1;
        $this->assign('oid',I('oid'));
        $this->assign('nextOrder',$nextOrder);
        $this->assign('dutys',$dutys);
        $this->display();
    }
    /**
     * 添加
     */
    public function save(){
        $model = D('Iposition');
        $data['inputtime'] = $data['updatetime'] = time();
        $data['oid'] = $_POST['oid'];
        $data['did'] = $_POST['did'];
        $data['name'] = $_POST['name'];
        $data['orders'] = $_POST['order'];
        $data['dutys'] = $_POST['dutys'];
        $data['risks'] = $_POST['risks'];
        $data['rlevel'] = $_POST['rlevel'];
        $data['controls'] = $_POST['controls'];
        if($model->add($data)){
            $this->redirect('index',array('oid'=>$_POST['oid']));
        }; // 写入数据到数据库
    }

    public function edit(){
        $id = I('id');
        $oid = I('oid');
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();
        $this->assign('dutys',$dutys);

        $model = D('Iposition');
        $this->assign('member',$model->find($id));
        $this->assign('oid',$oid);
        $this->assign('id', $id);
        $this->display();
    }

    public function update(){
        $id = $_POST['id'];
        $model = D('Iposition');
        $data['updatetime'] = time();
        $data['did'] = $_POST['did'];
        $data['name'] = $_POST['name'];
        $data['orders'] = $_POST['order'];
        $data['dutys'] = $_POST['dutys'];
        $data['risks'] = $_POST['risks'];
        $data['rlevel'] = $_POST['rlevel'];
        $data['controls'] = $_POST['controls'];
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$_POST['oid'],'who'=>$id));
        }; // 写入数据到数据库
    }

    /**
     * 删除成员
     */
    public function delete(){
        $id = I('id');
        $listModel = D("Iposition");
        if($listModel->delete($id)){
            echo 1;
        }
    }
}