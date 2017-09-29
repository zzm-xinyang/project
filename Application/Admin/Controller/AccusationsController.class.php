<?php
/**
 * 纪委书记信箱
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class AccusationsController extends CommonController {
    public function index(){
    	//确定组织
        $oid = $_SESSION['oid'];
        //获取纪委书记信箱清单数据
        $accusationsModel = D('Accusations');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        $accusationLists= $accusationsModel->where("oid=$oid")->order('id')->page($p.',10')->select();
//      $adviceLists= $advicesModel->order('id')->page($p.',10')->select();
        $this->assign('accusationLists',$accusationLists);// 赋值数据集
          $count      = $accusationsModel->where("oid=$oid")->count();// 查询满足要求的总记录数
//      $count      = $advicesModel->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
	public function accusationsFind(){
		$id = I('id');
        $accusationsModel = D('Accusations');
        $accusation = $accusationsModel->find($id);
        $this->assign('accusation',$accusation);// 赋值数据集
		$this->display();
	}
	public function accusationsRevovery(){
		$id=I('id');
        $this->assign('id',$id);// 赋值数据集
		$this->display();
	}
	public function accusationsUpdateRe(){
		$id=$_POST['id'];
//		$reply=I('reply');
        $accusationsModel = D('Accusations');
		$data['reply'] = $_POST['reply'];
		$data['revoverytime'] = time();
		$data['status']=1;
		if($accusationsModel->where("id=$id")->save($data)){
			    $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("回复失败！");
         }
		
		
	}
    public function accusationsDel(){
    	$id = I('id');	
        $accusationsModel = D('Accusations');
		 if($accusationsModel->delete($id)){
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
	}
	public function accusationsSearch(){
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords =$_POST['keyWords'];	
        $accusationsModel = D('Accusations');
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       $map['oid'] = $oid;
      if($minDate!=null&& $minDate!="" && $maxDate!=null && $maxDate!=""){
	   		$map['sendtime'] =array(array('EGT',strtotime($minDate.' 00:00:00')),array('ELT',strtotime($maxDate.' 23:59:59')),'AND');
		} else if($minDate!=null){
        	$map['sendtime'] = array('egt',strtotime($minDate.' 00:00:00'));
	    }else if($maxDate!=null){
			$map['sendtime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	    }
	   if($keyWords!=null){
			$map['title'] = array('like','%'.$keyWords.'%');
		}
        $accusationLists= $accusationsModel->where($map)->order('id')->page($p.',10')->select();
        $this->assign('accusationLists',$accusationLists);// 赋值数据集
        //$count      = $advicesModel->where("oid=$oid")->count();// 查询满足要求的总记录数
        $count      = $accusationsModel->where($map)->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();		
	}
	//下载附件
	public function downLoad(){
		$id=I('id');	 			
        $accusationsModel = D('Accusations');
        $accusation = $accusationsModel->find($id);
      // 调用类  
        $http = new \Org\Net\Http;  
        $filename = realpath("uploads").$accusation['attachment'];
        $showname=basename($filename);  
        $http->download($filename, $showname);  
	}
	//批量删除
	public function accusationsDelAll(){
		$ids = I('ids');	
        $accusationsModel = D('Accusations');
		$flag=true;
		foreach($ids as $id){
		 if($accusationsModel->delete($id)){		 	
		 }else{
		 	$flag=false;
			break;
		 }
		}
		if($flag){	
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
		
	}
	
}