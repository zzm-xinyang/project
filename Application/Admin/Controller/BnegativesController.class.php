<?php
/**
 * 建言献策
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class BnegativesController extends CommonController {
    public function index(){
    	//确定组织
        $oid = I("oid");
        //获取建言献策清单数据
        $bnegativesModel = D('Bnegatives');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        $bnegativesLists= $bnegativesModel->where("oid=$oid")->join('LEFT JOIN pbuilds ON pbuilds.id=bnegatives.bid')->field('bnegatives.*,pbuilds.content as pcontent')->order('pbuilds.id')->page($p.',10')->select();
        $this->assign('bnegativesLists',$bnegativesLists);// 赋值数据集
        $count      = $bnegativesModel->where("oid=$oid")->join('LEFT JOIN pbuilds ON pbuilds.id=bnegatives.bid')->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
//	public function adviceFind(){
//		$id = I('id');
//      $adviceModel = D("Advices");
//      $advice = $adviceModel->find($id);
//      $this->assign('advice',$advice);// 赋值数据集
//		$this->display();
//	}
    public function bnegativesDel(){
    	$id = I('id');	
        $bnegativesModel = D('Bnegatives');
        $pbuildsresultModel = D('Pbuildsresult');
		 $bnegatives = $bnegativesModel->find($id);
		 if($pbuildsresultModel->delete($bnegatives['rid'])){
			 if($bnegativesModel->delete($id)){
	              $this->ajaxReturn(true);
	         }else{         	
	              $this->ajaxReturn("删除失败！");
	         }
		 }else{
		 	 $this->ajaxReturn("删除失败！");
		 }
	}
	/*
	 * 批量删除
	 * */
	public function bnegativesDelAll(){
		//得到所有的ID
		$ids = I('ids');	
        $bnegativesModel = D('Bnegatives');
        $pbuildsresultModel = D('Pbuildsresult');
		$flag=true;
		//依次循环删除
		foreach($ids as $id){	
			 $bnegatives = $bnegativesModel->find($id);			
			//删除对应的差评记录		
			 if($pbuildsresultModel->delete($bnegatives['rid'])){
			 		//删除差评的内容
			 		 if($bnegativesModel->delete($id)){
		         	}else{         	
				 		$flag=false;
						break;
		        	}	
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
	public function bnegativesSearch(){
		//确定组织
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords = $_POST['keyWords'];	
        $bnegativesModel = D('Bnegatives');
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       $map['oid'] = $oid;
       if($minDate!=null){
        	$map['evaluatetime'] = array('egt',strtotime($minDate.' 00:00:00'));
	   }
	   if($maxDate!=null){
			$map['evaluatetime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	   }
	   if($keyWords!=null){
			$map['title'] = array('like','%'.$keyWords.'%');
		}
        $bnegativesLists= $bnegativesModel->where($map)->join('LEFT JOIN pbuilds ON pbuilds.id=bnegatives.bid')->field('bnegatives.*,pbuilds.content as pcontent')->order('pbuilds.id')->page($p.',10')->select();
        $this->assign('bnegativesLists',$bnegativesLists);// 赋值数据集
        $count      = $bnegativesModel->where($map)->join('LEFT JOIN pbuilds ON pbuilds.id=bnegatives.bid')->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();		
	}
	
}