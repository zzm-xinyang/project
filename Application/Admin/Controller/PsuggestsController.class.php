<?php
/**
 * 党风廉政建设意见和建议
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PsuggestsController extends CommonController {
    public function index(){
    	//确定组织
        $oid = I("oid");
        //获取意见建议清单数据
        $psuggestsModel = D('Psuggests');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
        $psuggestsLists= $psuggestsModel->where("oid=$oid")->order('id')->page($p.',10')->select();
		
        $this->assign('psuggestsLists',$psuggestsLists);// 赋值数据集
        $count      = $psuggestsModel->where("oid=$oid")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
	
    public function psuggestsDel(){
    	$id = I('id');	
        $psuggestsModel = D('Psuggests');
		 if($psuggestsModel->delete($id)){
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
	}
	 public function  psuggestsDelAll(){
	 	$ids = I('ids');	
        $psuggestsModel = D('Psuggests');
		$flag=true;
		foreach($ids as $id){
		 if($psuggestsModel->delete($id)){		 	
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
	 
	 public function  psuggestsSearch(){
	 	//确定组织
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords = $_POST['keyWords'];	
        $psuggestsModel = D('Psuggests');
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       $map['oid'] = $oid;
//	   dump($minDate);
     	if($minDate!=null&& $minDate!="" && $maxDate!=null && $maxDate!=""){
	   		$map['addtime'] =array(array('EGT',strtotime($minDate.' 00:00:00')),array('ELT',strtotime($maxDate.' 23:59:59')),'AND');
		} else if($minDate!=null){
        	$map['addtime'] = array('egt',strtotime($minDate.' 00:00:00'));
	    }else if($maxDate!=null){
			$map['addtime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	    }
	   if($keyWords!=null){
			$map['content'] = array('like','%'.$keyWords.'%');
		}
        $psuggestsLists= $psuggestsModel->where($map)->order('id')->page($p.',10')->select();
//		dump($psuggestsLists);
        $this->assign('psuggestsLists',$psuggestsLists);// 赋值数据集
        $count      = $psuggestsModel->where($map)->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();	
	 }
}