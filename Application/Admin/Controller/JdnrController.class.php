<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class JdnrController extends Controller {
    public function index(){
        //组织机构代码
        $oid = session('oid');
        $contents = D('Tcontents');
        $contentsData = $contents->getContentsByOid($oid);
        $this->assign("datalist", $contentsData);
        $this->display();
    }
    
    //添加
    public function nradd(){
        $styles = D('Tstyles');
        $stylesData = $styles->getAllStyles();
        $this->assign("styleslist", $stylesData);
        $this->display();
    }
    
    //添加保存
    public function nradd_save(){
        $jdlb = $_POST['jdlb'];  //类别
        $jdnr = $_POST['jdnr'];   //描述

        $Tcontents = D('Tcontents');
        //组织机构代码
        $oid = session('oid');
        $id = $Tcontents->insertContents($jdlb, $oid, $jdnr);
        if ($id > 0) {
            $this->redirect('index', '', 2, '添加成功...');
        } else {
            $this->redirect('lbadd', '', 2, '添加失败...');
        }

    }
    
    //编辑
    public function nredit(){
        $id = $_GET['kw'];
        $Tcontents = D('Tcontents');
        $editData = $Tcontents->getOneContent($id);
        $this->assign('id',$id);
        $this->assign('sid',$editData['sid']);
        $this->assign('content',$editData['content']);
        $styles = D('Tstyles');
        $stylesData = $styles->getAllStyles();
        $this->assign("styleslist", $stylesData);
        $this->display();
    }
    
    //编辑保存
    public function nredit_save(){
        $id=$_POST['rid'];  //id
        $jdnr=$_POST['jdnr'];   //描述
        $lb=$_POST['lb'];   //类别
        $Tcontents = D('Tcontents');
        if($Tcontents->updateContents($id,$lb,$jdnr)){
            echo '<script>alert("修改成功！");location.href = "javascript:history.back()"</script>';
        }else{
            echo '<script>alert("修改失败！");location.href = "javascript:history.back()"</script>';
            echo $Tcontents->getDbError();
        }
				
    }
    
    public function lbdel(){
        $id = $_POST['id'];
        $Tcontents = D('Tcontents');
        $bool = $Tcontents->delContents($id);
        $this->ajaxReturn($bool);
    }
}