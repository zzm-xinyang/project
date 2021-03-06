<?php
/**
 * 线索来源统计
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class SjlxtjController extends Controller {
    public function index(){
		if (IS_AJAX) {
			$year = $_POST['nd'];
		} else {
			//当前年份
			$year = date("Y");
		}
		$fcontent = D('Fcontents');
		//拼接日期，搜索本年度1月1日到12月31日
		$startdate = strtotime($year . "-01-01");
		$enddate = strtotime($year . "-12-31");
		//搜索满足条件的数据
		$lxRst = $fcontent->getLxTj($startdate, $enddate);
		$ftypes = D('Ftypes');
		//获取所有类型名称
		$typesName = $ftypes->getTypesName();
		//得到各个类型对应的数量，因为有的类型可能没有数据，所以需要这样转换
		$arrNum = array();
		$j = 0;
		for ($i = 0; $i < count($typesName); $i++) {
			if ($typesName[$i] == $lxRst[$j]['name']) {
				$arrNum[$i] = $lxRst[$j]['total'];
				$j = $j + 1;
			} else {
				$arrNum[$i] = 0;
			}
		}
		$this->assign("typesName", $typesName);
		$this->assign("nd", $year);
		$this->assign("szxtnum", $arrNum);
		if (IS_AJAX) {
			$data['typesName'] = $typesName;
			$data['sjlxNum'] = $arrNum;
			$this->ajaxReturn($data);
		} else {
			$this->display();
		}
    }
}