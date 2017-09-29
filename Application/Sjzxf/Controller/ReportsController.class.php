<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class ReportsController extends Controller {

    public function index(){    
        $dutysModel = D('Dutys');
	    $dutysList = $dutysModel->select();
        $this->assign("dutys", $dutysList);
        $this->display();
    } 
	/*
 	* 举报
 	* */
	public function add(){
		$thismonth=date('Y-m-d'); 
		$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'docx', 'doc');// 设置附件上传类型
	    $upload->rootPath  =     './uploads/'; // 设置附件上传根目录
	    $upload->savePath  =      ''; // 设置附件上传（子）目录
        $upload->saveName=array('uniqid','');//上传文件的保存规则
        $upload->autoSub  = true;//自动使用子目录保存上传文件 
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功  
			$data['attachment']=$info['attachment']['savepath'].$info['attachment']['savename'];
			$data['rname']=$_POST['rname'];		
			$data['unit'] = $_POST['unit'];
			$data['dutiesId']=$_POST['dutiesId'];
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['report'] = $_POST['report'];
			$data['reportId'] = $_POST['reportId'];
			$data['oid']=1;
			$data['status']=1;
			$data['reportTime']=time();		
	        $reportsModel = D('Reports');	
			$rid=$reportsModel->add($data);		
			if($rid){
            $this->redirect('/Sjzxf/Reports/index', '', 1, '成功...');
			}else{				
	             $this->error('失败...');
			}	  
	    }
	}
	
}