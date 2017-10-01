<?php
/**
 * 举报
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class ReportsController extends CommonController {
    public function index(){
    	//确定组织
        $oid = I("oid");
        //获取举报清单数据
        $reportsModel = D('Reports');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
        $reportLists= $reportsModel->where("reports.oid=$oid")->join('dutys ON dutys.id=reports.dutiesId','left')->join('qjdepts ON qjdepts.id=reports.unit','left')->field('reports.*,dutys.duty as dname,qjdepts.name as qname')->page($p.',10')->select();
	
        $this->assign('reportLists',$reportLists);// 赋值数据集
        //$count      = $advicesModel->where("oid=$oid")->count();// 查询满足要求的总记录数
        $count      = $reportsModel->where("oid=$oid")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
	public function reportFind(){
		$id = I('id');
        $reportsModel = D('Reports');
        $report = $reportsModel->where("reports.id=$id")->field('reports.*,dutys.duty as dname,qjdepts.name as qname')->join('dutys ON dutys.id=reports.dutiesId','left')->join('qjdepts ON qjdepts.id=reports.unit','left')->find();
        $this->assign('report',$report);// 赋值数据集
		$this->display();
	}
    public function reportDel(){
    	$id = I('id');	
        $reportsModel = D('Reports');
		 if($reportsModel->delete($id)){
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
	}
	 public function reportSolve(){	 	
		$id=I('id');
        $reportsModel = D('Reports');
		$data['status']=2;
		$data['handleTime']=time();
		if($reportsModel->where("id=$id")->save($data)){
			    $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("处理失败！");
         }
	}
	public function reportSearch(){
		//确定组织
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords = $_POST['keyWords'];	
		$status = $_POST['status'];
        $reportsModel = D('Reports');
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
       $map['reports.oid'] = $oid;
        if($minDate!=null&& $minDate!="" && $maxDate!=null && $maxDate!=""){
	   		$map['reportTime'] =array(array('EGT',strtotime($minDate.' 00:00:00')),array('ELT',strtotime($maxDate.' 23:59:59')),'AND');
		} else if($minDate!=null){
        	$map['reportTime'] = array('egt',strtotime($minDate.' 00:00:00'));
	    }else if($maxDate!=null){
			$map['reportTime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	    }
	   if($keyWords!=null){
			$map['title'] = array('like','%'.$keyWords.'%');
		}
	    $map['status']=array('eq',$status);
        $reportLists= $reportsModel->where($map)->join('dutys ON dutys.id=reports.dutiesId','left')->join('qjdepts ON qjdepts.id=reports.unit','left')->field('reports.*,dutys.duty as dname,qjdepts.name as qname')->page($p.',10')->select();
        $this->assign('reportLists',$reportLists);// 赋值数据集       
        $count      = $reportsModel->where($map)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();		
	}
	public function downLoad(){
		$id=I('id');	 			
        $reportsModel = D('Reports');
        $report = $reportsModel->find($id);
//		$file=realpath("uploads").$report['attachment']; 
      // 调用类  
        $http = new \Org\Net\Http;  
        $filename = realpath("uploads")."/".$report['attachment'];
        $showname=basename($filename);  
        $http->download($filename, $showname);  
	}
	//批量删除
	public function reportsDelAll(){
		$ids = I('ids');	
        $reportsModel = D('Reports');
		$flag=true;
		foreach($ids as $id){
		 if($reportsModel->delete($id)){		 	
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