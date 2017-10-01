<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class JwsjController extends Controller {
	public function _initialize()
    {
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));

    }
  public function index(){
    $this->display();
  }
  public function jwsj_add(){
    $map['oid'] = 1;
    $qjdeptModel = D('Qjdept'); 
    $qjdept = $qjdeptModel->where($map)->select();	
    $this->assign("qjdept", $qjdept);  	
    $this->display();  	
  }
  /*
 	* 发信
 	* */
	public function add(){
		if($_FILES['attachment']['name']!=''){
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
	    	}else{	    		
				$data['attachment']=$info['attachment']['savepath'].$info['attachment']['savename'];
	    	}
		}
			$data['sender']=$_POST['sender'];		
			$data['unit'] = $_POST['unit'];
			$data['addressee']=$_POST['addressee'];
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['reportId'] = $_POST['reportId'];
			$data['oid']=1;
			$data['status']=0;
			$data['sendtime']=time();		
	        $accusationsModel = D('Accusations');	
			$rid=$accusationsModel->add($data);		
			if($rid){
            	$this->redirect('/Sjzxf/Jwsj/index', '', 1, '成功...');
			}else{				
	             $this->error('失败...');
			}	
	}
}