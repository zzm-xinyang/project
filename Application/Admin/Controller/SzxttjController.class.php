<?php
/**
 * 四种形态统计
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class SzxttjController extends Controller {
    public function index(){

		if (IS_AJAX) {
			$year = $_POST['nd'];
		} else {
			//当前年份
			$year = date("Y");
		}
		$fcontent = D('Fcontents');
		$startdate = strtotime($year . "-01-01");
		$enddate = strtotime($year . "-12-31");
		$szxt = $fcontent->getXtTj($startdate, $enddate);
		$arrNum = array();
		$arrNum[0] = 0;
		$arrNum[1] = 0;
		$arrNum[2] = 0;
		$arrNum[3] = 0;
		for ($i = 0; $i < count($szxt); $i++) {
			if($szxt[$i]['status'] == 1){
				$arrNum[0] = $szxt[$i]['total'];
			}
			else if($szxt[$i]['status'] == 2){
				$arrNum[1] = $szxt[$i]['total'];
			}
			else if($szxt[$i]['status'] == 3){
				$arrNum[2] = $szxt[$i]['total'];
			}
			else if($szxt[$i]['status'] == 4){
				$arrNum[3] = $szxt[$i]['total'];
			}
		}
		$this->assign("nd", $year);
		$this->assign("szxtnum", $arrNum);
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
    
}