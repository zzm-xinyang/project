<?php
/**
 * 部门岗位权力
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class DpositionController extends CommonController {
    public function index(){
        //确定组织
        $oid = I("oid");
        $this->assign('oid',$oid);

        //确定哪个部门显示
        $mid = I('mid');
        $this->assign('mid',$mid);

        //获取有哪些部门
        $dModel = D('Qjdept');
        $departments = $dModel->order('id asc')->select();
        $this->assign('departments',$departments);

        //获取成员列表
        $memberModel = D('Dposition');
        /*$members = $memberModel->field('`dutys`.`duty`,`dpostions`.*')->join('dutys ON dutys.id=dpostions.did')->where("oid=$oid and mid=$mid")->order('`dpostions`.`order` asc')->select();
        $this->assign('members',$members);*/

        $contents = array();
        //按部门取数据
        foreach($departments as $de){
            $m = $de['id'];
            $members = $memberModel->field('`dutys`.`duty`,`dpostions`.*')->join('dutys ON dutys.id=dpostions.did')->where("oid=$oid and mid=$m")->order('`dpostions`.`orders` asc')->select();
            $contents[] = $members;
        }
        $this->assign('contents',$contents);
        $this->display();
    }
    public function find(){
        $id = I('id');
        $model = D('Dposition');
        $data = $model->find($id);
        echo json_encode($data);
    }
    /**
     * 显示添加成员模板
     */
    public function add(){
        $mid = I('mid');
        $oid = I("oid");
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();

        $model = D('Dposition');
        $members = $model->field('`id`,`orders`')->where("oid=$oid and mid=$mid")->order('`orders` ASC')->select();
        $lastOrder = count($members)-1;
        $nextOrder = $members[$lastOrder]['orders'] + 1;
        $this->assign('oid',I('oid'));
        $this->assign('mid', I('mid'));//部门id
        $this->assign('nextOrder',$nextOrder);
        $this->assign('dutys',$dutys);
        $this->display();
    }
    /**
     * 添加
     */
    public function save(){
        $model = D('Dposition');
        $data['inputtime'] = $data['updatetime'] = time();
        $data['oid'] = $_POST['oid'];
        $data['did'] = $_POST['did'];
        $data['mid'] = $_POST['mid'];
        $data['name'] = $_POST['name'];
        $data['order'] = $_POST['order'];
        $data['dutys'] = $_POST['dutys'];
        $data['risks'] = $_POST['risks'];
        $data['rlevel'] = $_POST['rlevel'];
        $data['controls'] = $_POST['controls'];
        if($model->add($data)){
            $this->redirect('index',array('oid'=>$_POST['oid'],'mid'=>$_POST['mid']));
        }; // 写入数据到数据库
    }

    public function edit(){
        $id = I('id');
        $oid = I('oid');
        $mid = I('mid');
        //获取职务列表
        $dutyModel = D('Duty');
        $dutys = $dutyModel->order('`orders` ASC')->select();
        $this->assign('dutys',$dutys);

        $model = D('Dposition');
        $this->assign('member',$model->find($id));
        $this->assign('oid',$oid);
        $this->assign('id', $id);
        $this->display();
    }

    public function update(){
        $id = $_POST['id'];
        $model = D('Dposition');
        $data['updatetime'] = time();
        $data['did'] = $_POST['did'];
        $data['mid'] = $_POST['mid'];
        $data['name'] = $_POST['name'];
        $data['orders'] = $_POST['order'];
        $data['dutys'] = $_POST['dutys'];
        $data['risks'] = $_POST['risks'];
        $data['rlevel'] = $_POST['rlevel'];
        $data['controls'] = $_POST['controls'];
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$_POST['oid'],'who'=>$id,'mid'=>$_POST['mid']));
        }; // 写入数据到数据库
    }

    /**
     * 删除成员
     */
    public function delete(){
        $id = I('id');
        $listModel = D("Dposition");
        if($listModel->delete($id)){
            echo 1;
        }
    }
}