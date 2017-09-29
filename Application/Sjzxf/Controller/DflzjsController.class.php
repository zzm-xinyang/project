<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class DflzjsController extends Controller {

    public function index(){
        $db = D('Dflzjs');
        //$oid = I('oid');
        $map['oid'] = 1;
		$map['status']=1;
        $lists = $db->where($map)->select();
        $this->assign('lists',$lists);

        if (IS_AJAX) {
            $year = $_POST['nd'];
        } else {
            //当前年份
            $year = date("Y");
        }
        $fcontent = D('Pbresult');
        $startdate = strtotime($year . "-01-01");
        $enddate = strtotime($year . "-12-31");
        $szxt = $fcontent->getXtTj($startdate, $enddate);
        $arrNum = array();
        $arrNum[0] = 0;
        $arrNum[1] = 0;
        $arrNum[2] = 0;
        $arrNum[3] = 0;
        for ($i = 0; $i < count($szxt); $i++) {
            if($szxt[$i]['result'] == 1){
                $arrNum[0] = $szxt[$i]['total'];
            }
            else if($szxt[$i]['result'] == 2){
                $arrNum[1] = $szxt[$i]['total'];
            }
            else if($szxt[$i]['result'] == 3){
                $arrNum[2] = $szxt[$i]['total'];
            }
            else if($szxt[$i]['result'] == 4){
                $arrNum[3] = $szxt[$i]['total'];
            }
        }
        $this->assign("nd", $year);
        $this->assign("szxtnum", $arrNum);

        //获取数据库中存储的年份数据
            $years = array();
            $years[] = date('Y');

            $yearData = $fcontent->field('addtime')->where("oid=1")->order('addtime desc')->select();
            foreach ( $yearData as $item) {
                $date = $item['addtime'];
                $item['addtime'] = date('Y', $item['addtime']);
                if (!in_array($item['addtime'], $years)) {
                    $years[] = $item['addtime'];
                }
            }			
            $this->assign("years",$years);

        if (IS_AJAX) {
            $szxtnum['first'] = $szxt[0]['total'];
            $szxtnum['second'] = $szxt[1]['total'];
            $szxtnum['third'] = $szxt[2]['total'];
            $szxtnum['fourth'] = $szxt[3]['total'];
            $this->ajaxReturn($szxtnum);
        } else {
            $this->display();
        }



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