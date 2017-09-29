<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class JdlbController extends Controller {
    public function index(){
    		$styles = D('Tstyles');
    		$stylesData = $styles->getAllStyles();
    		$this->assign("styleslist", $stylesData);        
        $this->display();
    }
    
    //添加
    public function lbadd(){
        $this->display();
    }
    
    //添加保存
    public function lbadd_save(){
    		$lb=$_POST['lb'];  //类别
        $ms=$_POST['ms'];   //描述

        $Tstyles = D('Tstyles');
        $style = $Tstyles->where("name='$lb'")->find();
        //查询新增的实施方式是否已经存在
        if($style){
            echo '<script>alert("该类型已存在！");location.href = "javascript:history.back()"</script>';
        }else {
            $id = $Tstyles->insertStyles($lb, $ms);
            if($id>0){
                $this->redirect('index', '', 2, '添加成功...');
            }else{
                $this->redirect('lbadd', '', 2, '添加失败...');
            }
        }
    }
    
    //编辑
    public function lbedit(){
        $id = $_GET['kw'];       
        $Tstyles = D('Tstyles');
        $editData = $Tstyles->getOneStyle($id);
        $this->assign('id',$id);
        $this->assign('ms',$editData['decription']);
        $this->assign('name',$editData['name']);
        $this->display();
    }
    
    //编辑保存
    public function lbedit_save(){
        $id=$_POST['tid'];  //id
        $ms=$_POST['ms'];   //描述
        $lb=$_POST['lb'];   //类别
        $Tstyles = D('Tstyles');
        if($Tstyles->updateStyles($id,$lb,$ms)){
            echo '<script>alert("修改成功！");location.href = "javascript:history.back()"</script>';
        }else{
            echo '<script>alert("修改失败！");location.href = "javascript:history.back()"</script>';
            echo $Tstyles->getDbError();
        }
				
    }
    
    public function lbdel(){
        $id = $_POST['id'];
        $Tstyles = D('Tstyles');
        $bool = $Tstyles->delStyles($id);
        $this->ajaxReturn($bool);
    }
}