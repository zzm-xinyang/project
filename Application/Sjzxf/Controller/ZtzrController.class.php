<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class ZtzrController extends Controller {
	public function _initialize()
    {
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));

        $memberModel = D('Pmember');
        $members = $memberModel->field('`dutys`.`duty`,`pmembers`.*')->join('LEFT JOIN dutys ON dutys.id=pmembers.did')->order('`pmembers`.`orders` asc')->select();
        $dwwy = array();
        for($i=0;$i<count($members);$i++){
            if($members[$i]['duty']=="党委书记"){
                $this->assign('dwsj',$members[$i]);
            }else if($members[$i]['duty']=="党委副书记"){
                $this->assign('dwfsj',$members[$i]);
            }else{
                $dwwy[] = $members[$i];
            }
            
        }

        $this->assign('dwwy',$dwwy);
    }
    //新闻动态
    public function ztzr(){
       //确定组织
        $oid = 1;
        //获取集体责任清单数据
        $listModel = D('Plist');
        $plists = $listModel->where("oid=$oid")->select();
        $this->assign('plists', $plists);

        //主体责任分解清单落实情况列表
        $itemModel = D("Pitem");
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        $this->assign('oid',$oid);
        $itemLists = $itemModel->order('inputtime')->page($p.',10')->select();

        //预警提示图片
        foreach ($itemLists as &$item){
            $item['starttime'] = date('Y-m-d',$item['starttime']);
            if($item['status']=='1'){//待完成
                $item['tip'] = "yellowdot.png";
                $item['status'] = "待完成";
            }else if($item['status']=='2'){//已完成
                $item['tip'] = "greendot.png";
                $item['status'] = "已完成";
            }else{
                $item['tip'] = "reddot.png";
                $item['status'] = "未完成";
            }
        }
        $this->assign('itemLists',$itemLists);// 赋值数据集
        $count      = $itemModel->where("oid=$oid")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        //获取数据库中存储的年份数据
        $years = array();
        $years[] = date('Y');

        $yearData = $itemModel->field('starttime')->where("oid=$oid")->order('starttime desc')->select();
        foreach ( $yearData as &$item) {
            $date = $item['starttime'];
            $item['starttime'] = date('Y', $item['starttime']);
            if (!in_array($item['starttime'], $years)) {
                $years[] = $item['starttime'];
            }
        }
        //统计图-默认情况只选取当年的统计数据
        $start=$years[0].'-01-01 00:00:00';
        $end = $years[0].'-12-31 23:59:59';
        $start = strtotime($start);//判断起始时间
        $end = strtotime($end);//判断结束时间

        $curItems = $itemModel->field('status,starttime')->where("oid=$oid and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
        $nums = array();
        foreach ($curItems as &$item){
            if($item['status']=='1'){//待完成
                $nums['s1'] += 1;
            }else if($item['status']=='2'){//已完成
                $nums['s2'] += 1;
            }else{
                $nums['s3'] += 1;
            }
        }

        $this->assign("nums",$nums);
        $this->assign("curYear",date('Y'));
        $this->assign("years",$years);
        $this->display();
    } 

    //党委组织架构
    public function dw_jgt_zzd(){
        $oid = 1;//I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['parchitecture']);
        $this->display();
        
    } 
    
    //获取主体责任内容
    public function getItemContent(){
         $id = I('id');
         $listModel = D("Plist");
         $list = $listModel->find($id);
         $this->ajaxReturn($list['content']);
       
    }
    /*
     * 条件查询主体责任分解清单
     */
    public function listsearch(){

        if(isset($_POST['submit'])){
            $logmax = $_POST['logmax'];
            $logmin = $_POST['logmin'];
            $status= $_POST['status'];
            $oid = $_POST['oid'];
            $subject = $_POST['subject'];
            $keyword = $_POST['keyword'];
            $mintime = strtotime($logmin);
            $maxtime = strtotime($logmax);
            $map['status'] = $status;
            $map['oid'] = $oid;
            $map['subject'] = $subject;
            $map['keyword'] = $keyword;
            $map['mintime'] = $mintime;
            $map['maxtime'] = $maxtime;
            session('map',$map);
        }else{
            $map = session('map');
            $keyword = $map['keyword'];
            $mintime = $map['mintime'];
            $maxtime = $map['maxtime'];
            $subject = $map['subject'];
            $oid = $map['oid'];
            $status = $map['status'];
        }

        $m = M('pitems');
        #$where['pitems.oid'] = I('oid');
        if (strcmp($subject,"全部")!=0){
            $where['pitems.subject'] = array('like','%'.$subject.'%');
        }

        if ($status!=0){
            $where['pitems.status'] = $status;
        }

        if (empty($mintime) and empty($maxtime)){
            $where['pitems.item'] = array('like','%'.$keyword.'%');

        }elseif (empty($mintime)){
            $where['pitems.item'] = array('like','%'.$keyword.'%');
            $where['pitems.starttime'] = array('ELT',$maxtime);
        }elseif(empty($maxtime)){
            $where['pitems.item'] = array('like','%'.$keyword.'%');
            $where['pitems.starttime'] = array('EGT',$mintime);
        }else{
            $where['pitems.item'] = array('like','%'.$keyword.'%');
            $where['pitems.starttime'] = array('between',array($mintime,$maxtime));
        };
        $count = $m->where($where)->count();
        $p = new \Think\Page($count,10);//getpage($count,10);

        $itemLists = M('pitems')->order('pitems.starttime desc')->limit($p->firstRow, $p->listRows)->where($where)->select();
        foreach ($itemLists as &$item){
            $item['starttime'] = date('Y-m-d',$item['starttime']);
            if($item['status']=='1'){//待完成
                $item['tip'] = "yellowdot.png";
                $item['status'] = "待完成";
            }else if($item['status']=='2'){//已完成
                $item['tip'] = "greendot.png";
                $item['status'] = "已完成";
            }else{
                $item['tip'] = "reddot.png";
                $item['status'] = "未完成";
            }
        }
        $this->assign('itemLists',$itemLists);



        $this->assign('page', $p->show()); // 赋值分页输出

        $years = array();
        $years[] = date('Y');

        $yearData = M('pitems')->field('starttime')->where("oid=$oid")->order('starttime desc')->select();
        foreach ( $yearData as &$item) {
            $date = $item['starttime'];
            $item['starttime'] = date('Y', $item['starttime']);
            if (!in_array($item['starttime'], $years)) {
                $years[] = $item['starttime'];
            }
        }
        //统计图-默认情况只选取当年的统计数据
        $start=$years[0].'-01-01 00:00:00';
        $end = $years[0].'-12-31 23:59:59';
        $start = strtotime($start);//判断起始时间
        $end = strtotime($end);//判断结束时间

        $curItems = M('pitems')->field('status,starttime')->where("oid=$oid and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
        $nums = array();
        foreach ($curItems as &$item){
            if($item['status']=='1'){//待完成
                $nums['s1'] += 1;
            }else if($item['status']=='2'){//已完成
                $nums['s2'] += 1;
            }else{
                $nums['s3'] += 1;
            }
        }

        $this->assign("nums",$nums);
        $this->assign("curYear",date('Y'));
        $this->assign("years",$years);


        $this->display('Plist/index');
    }

    public function ztzr_1(){
         $oid = 1;
        $model = D('Pleaderlist');
        $result = $model->where("oid=$oid")->find();
        //如果数据表里没有该条数据，则先添加之
       
        $list = $model->where("oid=$oid")->find();
        $this->assign('list',$list);
        $this->display();
        

    }
    public function ztzr_2(){
     //获取成员列表
        $oid = 1;
        $model = D('Pmemberlist');
        $result = $model->where("oid=$oid")->find();
        //如果数据表里没有该条数据，则先添加之
        if(!$model->where("oid=$oid")->find()){
            $data['content'] = '党委领导班子成员责任';
            $data['inputtime'] = $data['updatetime'] = time();
            $data['oid'] = $oid;
            $model->add($data);
            $model->getLastsql();
            $this->redirect('Pmemberlist/index',array('oid'=>$model->getLastInsID()));
        }else{
            $list = $model->where("oid=$oid")->find();
            $this->assign('list',$list);
            $this->display();
        }
    }

    public function ztzr_r(){
        //获取成员列表
         //主体责任分解清单落实情况列表，默认显示第一个人的事项
        if(I('who')){
            $who = I('who')-0;
            if($who>0)
             session('whichPMember',$who);
        }else{
            $who = $members[0]['id'];
            session('whichPMember',$who);
        }
        $memberModel = D('Pmember');
        $member = $memberModel->field('`dutys`.`duty`,`pmembers`.*')->join('LEFT JOIN dutys ON dutys.id=pmembers.did')->where("pmembers.id='$who'")->order('`pmembers`.`orders` asc')->select();
        $this->assign('member',$member);
        
        $this->assign('who',$who);
        $who = session('whichPMember');

         $itemModel = D("Pmitem");
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }

        if(isset($who)){//至少有一条数据，再取数据
            $itemLists = $itemModel->order('inputtime')->where("mid=$who")->page($p.',10')->select();

            //预警提示图片
            foreach ($itemLists as &$item){
                $item['starttime'] = date('Y-m-d',$item['starttime']);
                if($item['status']=='1'){//待完成
                    $item['tip'] = "yellowdot.png";
                    $item['status'] = "待完成";
                }else if($item['status']=='2'){//已完成
                    $item['tip'] = "greendot.png";
                    $item['status'] = "已完成";
                }else{
                    $item['tip'] = "reddot.png";
                    $item['status'] = "未完成";
                }
            }
            $this->assign('itemLists',$itemLists);// 赋值数据集
            $count      = $itemModel->where("mid=$who")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $show       = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出
            //选定某个成员后，显示其办理事项

            //获取数据库中存储的年份数据
            $years = array();
            $years[] = date('Y');

            $yearData = $itemModel->field('starttime')->where("mid=$who")->order('starttime desc')->select();
            foreach ( $yearData as &$item) {
                $date = $item['starttime'];
                $item['starttime'] = date('Y', $item['starttime']);
                if (!in_array($item['starttime'], $years)) {
                    $years[] = $item['starttime'];
                }
            }
            //统计图-默认情况只选取当年的统计数据
            $start=$years[0].'-01-01 00:00:00';
            $end = $years[0].'-12-31 23:59:59';
            $start = strtotime($start);//判断起始时间
            $end = strtotime($end);//判断结束时间

            $curItems = $itemModel->field('status,starttime')->where("mid=$who and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
            $nums = array();
            foreach ($curItems as &$item){
                if($item['status']=='1'){//待完成
                    $nums['s1'] += 1;
                }else if($item['status']=='2'){//已完成
                    $nums['s2'] += 1;
                }else{
                    $nums['s3'] += 1;
                }
            }

            $this->assign("nums",$nums);
            $this->assign("curYear",date('Y'));
            $this->assign("years",$years);
        }


        
        $this->display();
    }
}