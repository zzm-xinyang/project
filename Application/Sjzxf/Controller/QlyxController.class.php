<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class QlyxController extends Controller {
    public function _initialize()
        {
            $date_str=date("Y-m-d");
            $this->assign('date_str',$date_str);
            $this->assign('week_str',wk($date_str));
    }
    public function qlyx(){
        $oid = I("oid");
        $this->assign('oid',$oid);
        $db_lpostions = D('lpostions');
        $lpostions = $db_lpostions
            ->field('`dutys`.`duty`,`lpostions`.*')
            ->join('dutys ON dutys.id=lpostions.did')
            ->order('`lpostions`.`orders` asc')
            ->select();
        $this->assign('lpostions',$lpostions);
        if(I('who')){
            $who = I('who')-0;
        }else{
            $who = $lpostions[0]['id'];
        }
        $lpostion=$db_lpostions->find($who);
        $this->assign('lpostion',$lpostion);
        $this->assign('who',$who);
        $this->display();
    } 
    
    public function ql_jgt_zzd(){
        $oid = 1;//I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['oarchitecture']);
        $this->display();
    }

    public function qlyx_slbzt(){
        //确定组织
        /*$oid = I("oid");
        $this->assign('oid',$oid);*/

        //确定哪个部门显示
        $mid = I('mid');
        $this->assign('mid',$mid);

        //获取有哪些部门
        $dModel = D('qjdepts');
        $departments = $dModel->order('id asc')->select();
        $this->assign('departments',$departments);

        //获取成员列表
        $memberModel = D('Dpostions');
        /*$members = $memberModel->field('`dutys`.`duty`,`dpostions`.*')->join('dutys ON dutys.id=dpostions.did')->where("oid=$oid and mid=$mid")->order('`dpostions`.`order` asc')->select();
        $this->assign('members',$members);*/

        $contents = array();
        //按部门取数据
        foreach($departments as $de){
            $m = $de['id'];
            $members = $memberModel
                ->field('`dutys`.`duty`,`dpostions`.*')
                ->join('dutys ON dutys.id=dpostions.did')
                ->where("mid=$m")
                ->order('`dpostions`.`orders` asc')
                ->select();
            $contents[] = $members;
        }
        $this->assign('contents',$contents);
        $this->display();
    }

    public function find(){
        $id = I('id');
        $model = D('dpostions');
        $data = $model->find($id);
        $this->assign('data',$data);
    }
}