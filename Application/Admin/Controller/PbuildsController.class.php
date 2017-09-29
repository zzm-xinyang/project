<?php
/**
 * 党风廉政建设
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PbuildsController extends CommonController {
    public function index(){
    	//确定组织
        $oid = I("oid");
        //获取党风廉政建设清单数据
        $pbuildsModel = D('Pbuilds');
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
        $pbuildsLists= $pbuildsModel->where("oid=$oid")->order('id')->page($p.',10')->select();
        $this->assign('pbuildsLists',$pbuildsLists);// 赋值数据集     
        //统计每个廉政官兵评价项的评价结果
        $pbuildsresultModel = D('Pbuildsresult');
		for($i=0;$i<count($pbuildsLists);$i++){
			$result1=0;
			$result2=0;
			$result3=0;
			$result4=0;
			$pbuilds = $pbuildsLists[$i];
			$data['oid']=$oid;
			$data['bid']=$pbuilds['id'];
			$resultLists = $pbuildsresultModel->where($data)->select();
			for($j=0;$j<count($resultLists);$j++){
				$result = $resultLists[$j];
				if($result['result']==1){
					$result1=$result1+1;
				}else if($result['result']==2){
					$result2=$result2+1;
				}else if($result['result']==3){
					$result3=$result3+1;
				}else if($result['result']==4){
					$result4=$result4+1;
				} 
			}
			$resultRes[$i]['1']=$result1;
			$resultRes[$i]['2']=$result2;
			$resultRes[$i]['3']=$result3;
			$resultRes[$i]['4']=$result4;
		}
		
        $this->assign('resultList',$resultRes);// 赋值数据集 
        //统计今年廉政官兵评价项的评价结果
        //好评价的统计
        $data1['oid']=$oid;
		$data1['result']=1;
		
		//获取数据库中存储的年份数据
            $years = array();
            $years[] = date('Y');

            $yearData = $pbuildsresultModel->field('addtime')->where("oid=$oid")->order('addtime desc')->select();
            foreach ( $yearData as $item) {
                $date = $item['addtime'];
                $item['addtime'] = date('Y', $item['addtime']);
                if (!in_array($item['addtime'], $years)) {
                    $years[] = $item['addtime'];
                }
            }			
            $this->assign("years",$years);
//		$data1['addtime']= array('egt',strtotime($daten.'-01-01 00:00:00'));
//		$data1['addtime']= array('elt',strtotime($daten.'-12-31 23:59:59'));
		$data1['addtime'] =array(array('EGT',strtotime($years[0].'-01-01 00:00:00')),array('ELT',strtotime($years[0].'-12-31 23:59:59')),'AND');
        $resultList1 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList1',$resultList1);// 赋值数据集 
         //较好评价的统计
         $data1['result']=2;
        $resultList2 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList2',$resultList2);// 赋值数据集 
         //一般评价的统计
         $data1['result']=3;
        $resultList3 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList3',$resultList3);// 赋值数据集 
         //差评价的统计
         $data1['result']=4;
        $resultList4 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList4',$resultList4);// 赋值数据集 
         
          $this->assign('daten',$daten);// 赋值数据集 
        $count      = $pbuildsModel->where("oid=$oid")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
	public  function pbuildsAdd(){		
		$this->display();
	}
	public function pbuildsFind(){
		$id = I('id');
        $pbuildsModel = D('Pbuilds');
        $pbuilds = $pbuildsModel->find($id);
        $this->assign('pbuilds',$pbuilds);// 赋值数据集
		$this->display();
	}
	public function pbuildsUpdate(){
		$id=$_POST['id'];		
		$data['content'] = $_POST['content'];
		$data['describe'] = $_POST['describe'];
        $pbuildsModel = D('Pbuilds');
		if($pbuildsModel->where("id=$id")->save($data)){
			    $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("修改失败！");
         }
		
	}
	
	public function pbuildsAddSubmit(){		
		$data['content'] = $_POST['content'];
		$data['describe'] = $_POST['describe'];
		$data['addtime']=time();
		$data['oid']=$_SESSION['oid'];
		$data['status']=2;
		 $pbuildsModel = D('Pbuilds');
		if($pbuildsModel->add($data)){
			    $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("添加失败！");
         }
	}
    public function pbuildsDel(){
    	$id = I('id');	
        $pbuildsModel = D('Pbuilds');
		 if($pbuildsModel->delete($id)){
              $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("删除失败！");
         }
	}
	public function pbuildsDelAll(){
		$ids = I('ids');	
        $pbuildsModel = D('Pbuilds');
		$flag=true;
		foreach($ids as $id){
		 if($pbuildsModel->delete($id)){		 	
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
	public function pbuildsUpdateStatus(){
		$id=$_POST['id'];		
		$data['status'] = 1;
        $pbuildsModel = D('Pbuilds');
		if($pbuildsModel->where("id=$id")->save($data)){
			    $this->ajaxReturn(true);
         }else{         	
              $this->ajaxReturn("发布失败！");
         }
		
	}
	public function pbuildsSearch(){
		//确定组织
        $oid = $_SESSION['oid'];
		$minDate = $_POST['minDate'];	
		$maxDate = $_POST['maxDate'];	
		$keyWords = $_POST['keyWords'];	
        $pbuildsModel = D('Pbuilds');
		if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
       // $adviceLists= $advicesModel->where("oid=$oid")->order('id')->page($p.',1')->select();
       $map['oid'] = $oid;
       if($minDate!=null&& $minDate!="" && $maxDate!=null && $maxDate!=""){
	   		$map['addtime'] =array(array('EGT',strtotime($minDate.' 00:00:00')),array('ELT',strtotime($maxDate.' 23:59:59')),'AND');
		
	   } else if($minDate!=null){
        	$map['addtime'] = array('egt',strtotime($minDate.' 00:00:00'));
	    }else if($maxDate!=null){
			$map['addtime'] = array('elt',strtotime($maxDate.' 23:59:59'));
	    }
	   if($keyWords!=null){
			$map['title'] = array('like','%'.$keyWords.'%');
		}
        $pbuildsLists= $pbuildsModel->where($map)->order('id')->page($p.',10')->select();
        $this->assign('pbuildsLists',$pbuildsLists);// 赋值数据集
        //统计每个廉政官兵评价项的评价结果
        $pbuildsresultModel = D('Pbuildsresult');
		for($i=0;$i<count($pbuildsLists);$i++){
			$result1=0;
			$result2=0;
			$result3=0;
			$result4=0;
			$pbuilds = $pbuildsLists[$i];
			$data['oid']=$oid;
			$data['bid']=$pbuilds['id'];
			$resultLists = $pbuildsresultModel->where($data)->select();
			for($j=0;$j<count($resultLists);$j++){
				$result = $resultLists[$j];
				if($result['result']==1){
					$result1=$result1+1;
				}else if($result['result']==2){
					$result2=$result2+1;
				}else if($result['result']==3){
					$result3=$result3+1;
				}else if($result['result']==4){
					$result4=$result4+1;
				} 
			}
			$resultRes[$i]['1']=$result1;
			$resultRes[$i]['2']=$result2;
			$resultRes[$i]['3']=$result3;
			$resultRes[$i]['4']=$result4;
		}
		
        $this->assign('resultList',$resultRes);// 赋值数据集 
        //统计今年廉政官兵评价项的评价结果
        //好评价的统计
        $data1['oid']=$oid;
		$data1['result']=1;
		$daten = date('Y');
		$data1['addtime'] =array(array('EGT',strtotime($daten.'-01-01 00:00:00')),array('ELT',strtotime($daten.'-12-31 23:59:59')),'AND');
        $resultList1 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList1',$resultList1);// 赋值数据集 
         //较好评价的统计
         $data1['result']=2;
        $resultList2 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList2',$resultList2);// 赋值数据集 
         //一般评价的统计
         $data1['result']=3;
        $resultList3 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList3',$resultList3);// 赋值数据集 
         //差评价的统计
         $data1['result']=4;
        $resultList4 = $pbuildsresultModel->where($data1)->count();
         $this->assign('resultList4',$resultList4);// 赋值数据集 
         
          $this->assign('daten',$daten);// 赋值数据集 
        $count      = $pbuildsModel->where("oid=$oid")->count();
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();		
	}
   public function pbuildsTJ(){
 	   $daten=$_POST['year'];
	    //统计今年廉政官兵评价项的评价结果
        //好评价的统计
        $data1['oid']=$_SESSION['oid'];
		$data1['result']=1;
		$data1['addtime'] =array(array('EGT',strtotime($daten.'-01-01 00:00:00')),array('ELT',strtotime($daten.'-12-31 23:59:59')),'AND');
      
        $pbuildsresultModel = D('Pbuildsresult');
	    $resultList1 = $pbuildsresultModel->where($data1)->count();
         $result[0]=$resultList1;
         //较好评价的统计
         $data1['result']=2;
         $resultList2 = $pbuildsresultModel->where($data1)->count();
          $result[1]=$resultList2;
         //一般评价的统计
         $data1['result']=3;
        $resultList3 = $pbuildsresultModel->where($data1)->count();
          $result[2]=$resultList3;
         //差评价的统计
         $data1['result']=4;
        $resultList4 = $pbuildsresultModel->where($data1)->count();
        $result[3]=$resultList4;
		 $this->ajaxReturn($result,'JSON');
 }
	
}