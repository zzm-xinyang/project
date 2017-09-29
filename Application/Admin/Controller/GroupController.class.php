<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class GroupController extends CommonController {
    public function index(){
        $oid = I('oid');
        $model = D('Group');
        $organizeModel = D('Organize');

        //如果是超级管理员，显示系统中的所有角色，如果是支队管理员，只显示该支队的角色
        if(session('rid')==1){
            $roles = $model->select();
        }else{
            $roles = $model->where("oid=$oid")->select();
        }
        foreach ($roles as &$role){
            $role['organize'] = $organizeModel->getOrganize($role['oid']);
        }
        $this->assign('roles',$roles);
        $this->display();
    }

    /**
     * 显示编辑用户的模板
     */
    public function edit(){
        $id = $_GET['id'];
        $this->assign('id',$id);
        $rid = session('rid');
        $groupModel = D('Group');
        $model = D('Rule');
        $organizeModel = D('Organize');

        //指定角色拥有的权限
        $group = $groupModel->find($id);
        $opsOwn = explode(',',$group['rules']);
        $group['rules'] = $opsOwn;
        $this -> assign('group',$group);

        //该角色可分配的权限
        if(session('rid')==1){
            //分配权限
            $modular = $model->getChildren(0);
            for ($i=0;$i<count($modular);$i++){
                $submodule[$i] = $model->getChildren($modular[$i]['id']);
                for ($j=0;$j<count($submodule[$i]);$j++){
                    $operation[$i][$j] = $model->getChildren($submodule[$i][$j]['id']);
                }
            }

            //分配组织
            $organizes = $organizeModel->select();
        }else{
            $group = $groupModel->find(session('rid'));
            $ops = explode(',',$group['rules']);

            $rules = array();
            $subrule = array();
            $op = array();

            foreach ($ops as $op){
                $p = $model->getParent($op);
                if(!in_array($p,$subrule)){
                    $subrule[] = $p;
                }
            }
            foreach ($subrule as $sub){
                $m = $model->getParent($sub);
                if(!in_array($m,$rules)){
                    $rules[] = $m;
                }
            }
            $modular=array();
            $submodule = array();
            $operation = array();
            foreach($rules as $rule){
                $modular[] = $model->getRole($rule);//取最顶层的标题
            }
            for ($i=0;$i<count($modular);$i++){
                $tmpSubmodule[$i] = $model->getChildren($modular[$i]['id']);
                for($j=0; $j<count($tmpSubmodule[$i]);$j++){
                    if(in_array($tmpSubmodule[$i][$j]['id'],$subrule)){
                        $submodule[$i][]=$tmpSubmodule[$i][$j];
                    }
                }
                for ($k=0;$k<count($submodule[$i]);$k++){
                    $tmpOperation[$i][$k] = $model->getChildren($submodule[$i][$k]['id']);
                    for($m=0; $m<count($tmpOperation[$i][$k]);$m++){
                        if(in_array($tmpOperation[$i][$k][$m]['id'],$ops)){
                            $operation[$i][$k][]=$tmpOperation[$i][$k][$m];
                        }
                    }
                }

            }
        }

        $this ->assign('oid', I('oid'));
        $this -> assign('Modular',$modular);
        $this -> assign('Submodule',$submodule);
        $this -> assign('operation',$operation);
        $this -> display();
    }

    public function update(){
        $oid = $_POST['oid'];
        $title = $_POST['user-name'];
        $rule_ids = $_REQUEST['user-Character-0-0-0'];
        $rules = implode(',',$rule_ids);
        $db = D('auth_group');
        $db -> rules = $rules;
        $r = $db
            -> where('id=%d',$_POST['id'])
            -> save();
        if ($r){
            $this -> success('修改成功',U('index',array('oid'=>$oid)),2);
        }else{
            echo $db->getLastSql();
            exit;
            $this -> error('修改失败','index',2);
        }
    }

    public function add(){
        $oid = session('oid');
        $model = D('Rule');
        $organizeModel = D('Organize');
        //当rid为1时，此角色为超级管理员，能加载权限数据表中的所有权限，否则只能加载他所在组的权限
        if(session('rid')==1){
            //分配权限
            $modular = $model->getChildren(0);
            for ($i=0;$i<count($modular);$i++){
                $submodule[$i] = $model->getChildren($modular[$i]['id']);
                for ($j=0;$j<count($submodule[$i]);$j++){
                    $operation[$i][$j] = $model->getChildren($submodule[$i][$j]['id']);
                }
            }

            //分配组织
            $organizes = $organizeModel->select();
        }else{//oid不为999时
            //分配权限
            $rules = array();
            $subrule = array();
            $op = array();

            $groupModel = D('Group');
            $group = $groupModel->find(session('rid'));
            $ops = explode(',',$group['rules']);
            foreach ($ops as $op){
                $p = $model->getParent($op);
                if(!in_array($p,$subrule)){
                    $subrule[] = $p;
                }
            }
            foreach ($subrule as $sub){
                $m = $model->getParent($sub);
                if(!in_array($m,$rules)){
                    $rules[] = $m;
                }
            }
            $modular=array();
            $submodule = array();
            $operation = array();

            foreach($rules as $rule){
                $modular[] = $model->getRole($rule);//取最顶层的标题
            }

            for ($i=0;$i<count($modular);$i++){
                $tmpSubmodule[$i] = $model->getChildren($modular[$i]['id']);
                for($j=0; $j<count($tmpSubmodule[$i]);$j++){
                    if(in_array($tmpSubmodule[$i][$j]['id'],$subrule)){
                        $submodule[$i][]=$tmpSubmodule[$i][$j];
                    }
                }
                for ($k=0;$k<count($submodule[$i]);$k++){
                    $tmpOperation[$i][$k] = $model->getChildren($submodule[$i][$k]['id']);
                    for($m=0; $m<count($tmpOperation[$i][$k]);$m++){
                        if(in_array($tmpOperation[$i][$k][$m]['id'],$ops)){
                            $operation[$i][$k][]=$tmpOperation[$i][$k][$m];
                        }
                    }
                }

            }

            //分配组织
            $organizes=$organizeModel->getOne($oid);
        }
        $this->assign('oid',$oid);
        $this -> assign('organizes',$organizes);
        $this -> assign('modular',$modular);
        $this -> assign('submodule',$submodule);
        $this -> assign('operation',$operation);
        $this->display();
    }

    public function save(){
        $model = D('Group');
        $oid = I('oid');
        $data = array();
        $data['oid'] = $_POST['oid'];
        $data['title'] = $_POST['user-name'];
        $rule_ids = $_REQUEST['user-Character-0-0-0'];
        $data['rules'] = implode(',',$rule_ids);

        $r = $model->add($data);

        if ($r){
            $this -> success('添加成功',U('index',array('oid'=>$oid)),2);
        }else{
            $this -> error('添加失败','index',2);
        }
    }

    /**
     * 删除角色
     */
    public function delete(){
        $id = I('id');

        $model = D('group');
        if($model->delete($id)){
            echo 1;
        }

    }

}