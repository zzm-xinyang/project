<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class ZjwzController extends Controller {
    public function _initialize()
        {
            $date_str=date("Y-m-d");
            $this->assign('date_str',$date_str);
            $this->assign('week_str',wk($date_str));
    }
    //四种形态
    public function zjwz_szxttj(){
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
            $szxtnum['first'] = $szxt[0]['total']!=0?$szxt[0]['total']:0;
            $szxtnum['second'] = $szxt[1]['total']!=0?$szxt[1]['total']:0;
            $szxtnum['third'] = $szxt[2]['total']!=0?$szxt[2]['total']:0;
            $szxtnum['fourth'] = $szxt[3]['total']!=0?$szxt[3]['total']:0;
            $this->ajaxReturn($szxtnum);
        } else {
            $this->display();
        }
        
    }
    public function zjwz_d1(){
        $this->display();
    }
    public function zjwz_d2(){
        $this->display();
    }
    public function zjwz_d3(){
        $this->display();
    }
    public function zjwz_d4(){
        $this->display();
    }
    public function zjwz_sjlxtj(){
        $this->display();
    }
    public function zjwz_xslytj(){
        $this->display();
    }

    public function zjwz_dyi(){
        $lx = I('lx');
        switch ($lx) {
            case "谈话提醒":
                $this->display('zjwz_01');
                break;
            case "警示谈话":
                $this->display('zjwz_02');
                break;
            case "批评教育":
                $this->display('zjwz_03');
                break;
            case "纠正或责令停止违纪行为":
                $this->display('zjwz_04');
                break;
            case "责成退缴违纪所得":
                $this->display('zjwz_05');
                break;
            case "限期整改":
                $this->display('zjwz_06');
                break;
            case "责令作出口头或书面检查":
                $this->display('zjwz_07');
                break;
            case "召开民主生活会批评帮助":
                $this->display('zjwz_08');
                break;
            case "责令公开道歉或检讨":
                $this->display('zjwz_09');
                break;
            case "通报批评":
                $this->display('zjwz_010');
                break;
            case "诫勉谈话":
                $this->display('zjwz_011');
                break;
            default:
                $this->display('zjwz_012');
        }

    }
    public function zjwz_der(){
        $lx = I('lx');
        switch ($lx) {
            case "党内警告":
                $this->display('zjwz_012');
                break;
            case "党内严重警告":
                $this->display('zjwz_013');
                break;
            case "行政警告":
                $this->display('zjwz_014');
                break;
            case "行政记过":
                $this->display('zjwz_015');
                break;
            case "行政记大过":
                $this->display('zjwz_016');
                break;
            case "行政降级":
                $this->display('zjwz_017');
                break;
            case "停职检查":
                $this->display('zjwz_018');
                break;
            case "调整职务岗位":
                $this->display('zjwz_019');
                break;
            case "免职":
                $this->display('zjwz_020');
                break;
            case "引咎辞职":
                $this->display('zjwz_021');
                break;
            case "责令辞职":
                $this->display('zjwz_022');
                break;
            default:
                $this->display('zjwz_022');
        }
    }

    public function zjwz_dsan(){
        $lx = I('lx');
        switch ($lx) {
            case "撤销党内职位":
                $this->display('zjwz_023');
                break;
            case "留党察看":
                $this->display('zjwz_024');
                break;
            case "开除党籍":
                $this->display('zjwz_025');
                break;
            case "行政撤职":
                $this->display('zjwz_026');
                break;
            case "行政开除":
                $this->display('zjwz_027');
                break;
            case "降职":
                $this->display('zjwz_028');
                break;
            case "组织除名或劝退":
                $this->display('zjwz_029');
                break;

            default:
                $this->display('zjwz_029');
        }
    }

    
    
}