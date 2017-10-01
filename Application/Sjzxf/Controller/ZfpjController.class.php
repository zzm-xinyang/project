<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");
/*
 * 作风评价
 * */
class ZfpjController extends Controller {

    public function index(){
        $tobjectsModel = D('Tobjects');
        //$oid = I('oid');        
        $map['oid'] = 1;
        $qjdeptModel = D('Qjdept'); 
        $qjdept = $qjdeptModel->where($map)->select();		
		foreach($qjdept as &$q){
        	$q['members']=$tobjectsModel->getObjects(1,$q['id']);
		}		
        $this->assign('qjdept',$qjdept);
		//查询监督内容
		$styles = D('Tstyles');
    	$stylesData = $styles->getAllStyles();
        $contentsModel = D('Tcontents');
		foreach($stylesData as &$s){
        	$s['contents']=$contentsModel->getContentsByOidAndSid(1,$s['id']);
		}        
    	$this->assign("styleslist", $stylesData); 
        $this->display();
    } 
	
	public function zfpj(){	
		 $id = I('id'); 	
		$tobjectsModel = D('Tobjects');
        $tobject = $tobjectsModel->getOneObject($id);		
    	$this->assign("tobject", $tobject); 
        $map['oid'] = 1;
        $qjdeptModel = D('Qjdept'); 
        $qjdept = $qjdeptModel->where($map)->select();		
		foreach($qjdept as &$q){
        	$q['members']=$tobjectsModel->getObjects(1,$q['id']);
		}		
        $this->assign('qjdept',$qjdept);
		//查询监督内容
		$styles = D('Tstyles');
    	$stylesData = $styles->getAllStyles();
        $contentsModel = D('Tcontents');
		foreach($stylesData as &$s){
        	$s['contents']=$contentsModel->getContentsByOidAndSid(1,$s['id']);
		}        
    	$this->assign("styleslist", $stylesData); 
        $this->display();	
	}
/*
 * 正常评价
 * */
	public function pbuildsResult(){
		$data['bid']=$_POST['bid'];		
		$data['result'] = $_POST['result'];
		$data['oid']=1;
		$data['addtime']=time();		
        $fcontent = D('Pbresult');	
		$rid=$fcontent->add($data);		
		if($rid){
			if($data['result']==4){
			  $result['rid']=$rid;
			  $result['bid']=$data['bid'];
			  $result['evaluatetime']=$data['addtime'];
			  $result['name']=$_POST['name'];
			  $result['number']=$_POST['number'];
			  $result['phone']=$_POST['phone'];
			  $result['content']=$_POST['content'];
			  $bnegatives = D('Bnegatives');
			  if($bnegatives->add($result)){
			  	$this->ajaxReturn(true);
			  }else{
			  	$this->ajaxReturn("评价内容失败");
			  }
		    }			
            $this->ajaxReturn(true);
		}else{				
            $this->ajaxReturn("评价失败");
		}
	}

}