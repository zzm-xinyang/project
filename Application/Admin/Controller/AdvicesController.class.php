<?php
/**
 * 建言献策
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class AdvicesController extends CommonController {
    public function index(){
    	//确定组织
        $oid = I("oid");
        //获取建言献策清单数据
        $advicesModel = D('Advices');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
        $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',10')->select();
        $this->assign('adviceLists',$adviceLists);// 赋值数据集
        //$count      = $advicesModel->where("oid=$oid")->count();// 查询满足要求的总记录数
        $count      = $advicesModel->where("oid=$oid")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
	public function adviceFind(){
		$id = I('id');
        $adviceModel = D("Advices");
        $advice = $adviceModel->find($id);
        $this->assign('advice',$advice);// 赋值数据集
		$this->display();
	}
    public function adviceDel(){
    	$id = I('id');	
        $adviceModel = D("Advices");
		 if($adviceModel->delete($id)){
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
	}
	public function adviceSearch(){
		//确定组织
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords = $_POST['keyWords'];	
        $advicesModel = D("Advices");
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
       $map['oid'] = $oid;
       if($minDate!=null&& $minDate!="" && $maxDate!=null && $maxDate!=""){
	   		$map['adviceTime'] =array(array('EGT',strtotime($minDate.' 00:00:00')),array('ELT',strtotime($maxDate.' 23:59:59')),'AND');
		} else if($minDate!=null){
        	$map['adviceTime'] = array('egt',strtotime($minDate.' 00:00:00'));
	    }else if($maxDate!=null){
			$map['adviceTime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	    }
	   if($keyWords!=null){
			$map['title'] = array('like','%'.$keyWords.'%');
		}
        $adviceLists= $advicesModel->where($map)->order('id')->page($p.',10')->select();
        $this->assign('adviceLists',$adviceLists);// 赋值数据集
        //$count      = $advicesModel->where("oid=$oid")->count();// 查询满足要求的总记录数
        $count      = $advicesModel->where($map)->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();		
	}
	//批量删除
	public function advicesDelAll(){
		$ids = I('ids');	
        $advicesModel = D("Advices");
		$flag=true;
		foreach($ids as $id){
		 if($advicesModel->delete($id)){		 	
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