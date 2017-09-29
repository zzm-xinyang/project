<?php
namespace Admin\Controller;
use Think\Controller;
class RulesController extends Controller{
    public function index(){
        $id = $_GET['id'];
        $db = D('auth_group');
        $group = $db
            -> where('id=%d',$id)
            -> find();
        $arr_rules = explode(',',$group['rules']);
        $group['rules'] = $arr_rules;
        $this -> assign('group',$group);
        $db_rules = D('auth_rule');
        $Modular = $db_rules
            -> where('pid=0')
            -> select();
        for ($i=0;$i<sizeof($Modular);$i++){
            $Submodule[$i] = $db_rules
                -> where('pid=%d',$Modular[$i]['id'])
                -> select();
            for ($j=0;$j<sizeof($Submodule[$i]);$j++){
                $operation[$i][$j] = $db_rules
                    -> where('pid=%d',$Submodule[$i][$j]['id'])
                    -> select();
            }
        }
        $this -> assign('Modular',$Modular);
        $this -> assign('Submodule',$Submodule);
        $this -> assign('operation',$operation);
        $this -> display();
    }

    public function update(){
        $title = $_POST['user-name'];
        $rule_ids = $_REQUEST['user-Character-0-0-0'];
        $rules = implode(',',$rule_ids);
        $db = D('auth_group');
        $db -> rules = $rules;
        $r = $db
            -> where('title="%s"',$title)
            -> save();
        if ($r){
            $this -> success('修改成功','../Group/index',2);
        }else{
            $this -> error('修改失败','../Group/index',2);
        }
    }
}