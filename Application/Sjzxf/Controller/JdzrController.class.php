<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class JdzrController extends Controller {
   public function _initialize()
    {
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));

        $memberModel = D('Inmember');
        $members = $memberModel->field('`dutys`.`duty`,`inmembers`.*')->join('dutys ON dutys.id=inmembers.did')->order('`inmembers`.`orders` asc')->select();
        $this->assign('members',$members);        
        for($i=0;$i<count($members);$i++){
            if($members[$i]['duty']=="纪委书记"){
                $this->assign('jwsj',$members[$i]);
            }else if($members[$i]['duty']=="纪委副书记"){
                $this->assign('jwfsj',$members[$i]);
            }
            
        }
    }
    //监督责任
    public function jdzr(){
        $oid=1;
        //纪委领导班子集体责任清单
        $jdzrModel = D('Inlists');
        $jtlist = $jdzrModel->getDataByOid($oid);
        $this->assign("jtlist",$jtlist);

        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        } else {
            $p = 1;
        }

        //监督责任分解清单落实情况
        $fileModel = D('Initems');
        $fjqdlist = $fileModel->getDataByOid($oid);
        $fjqdpagelist = $fileModel->getDataByPage($oid, $p);
        $this->assign("fjqdlslist",$fjqdpagelist);

        //分页相关设置
        $count = count($fjqdlist);// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出

        $this->display();
    }

    //获取责任清单项目的内容
    public function getItemContent(){
        layout(false);
        //清单项目名称,剔除名称中的序号和中文顿号
        $iname = $_POST['iname'];
        $iname = strstr($iname, '、');
        $iname = str_replace('、', '', $iname);
        $oid=1;
        $jdzrModel = D('Inlists');
        $jtlist = $jdzrModel->getDataByItem($oid, $iname);
        $this->assign('contentdata', $jtlist);
        $res["content"] = $this->fetch('Jdzr/itemcontent');
        $this->ajaxReturn($res,'JSON');
    }
    
    //获取下载文件列表
    public function getFileList(){
        layout(false);

        $rid = $_POST['rid'];
        $fjqdModel = D('Infinishes');
        $filelist = $fjqdModel->getDataByInid($rid);
        $this->assign("filelist",$filelist);
        $res["content"] = $this->fetch('Jdzr/filelist');
        $this->ajaxReturn($res,'JSON');
    }

    //党委组织架构
    public function jw_jgt_zzd(){
        $oid = 1;
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['inarchitecture']);
        $this->display();
        
    } 

    public function jdzr_1(){
         $oid = 1;
        $model = D('Inleaderlist');
        $result = $model->where("oid=$oid")->find();
        //如果数据表里没有该条数据，则先添加之
        if(!$model->where("oid=$oid")->find()){
            $data['content'] = '纪委主要负责人责任';
            $data['inputtime'] = $data['updatetime'] = time();
            $data['oid'] = $oid;
            $model->add($data);
            $model->getLastsql();
            $this->redirect('Jdzr/index',array('oid'=>$model->getLastInsID()));
        }else{
            $list = $model->where("oid=$oid")->find();
            $this->assign('list',$list);
            $this->display();
        }
        

    }
    

    public function jdzr_r(){
        //获取成员列表
         if(I('who')){
            $who = I('who')-0;
            if($who>0)
             session('whichPMember',$who);
        }else{
            $who = $members[0]['id'];
            session('whichPMember',$who);
        }
        $memberModel = D('Inmember');
        $member = $memberModel->field('`dutys`.`duty`,`inmembers`.*')->join('dutys ON dutys.id=inmembers.did')->where("inmembers.id='$who'")->order('`inmembers`.`orders` asc')->select();
       
        $this->assign('member',$member);


        $this->assign('who',$who);
        $who = session('whichPMember');

        $itemModel = D("Inmitem");
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        if($who){
            $itemLists = $itemModel->order('inputtime')->where("inid=$who")->page($p.',10')->select();
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
            $count      = $itemModel->where("inid=$who")->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $show       = $Page->show();// 分页显示输出
            $this->assign('page',$show);// 赋值分页输出
            //选定某个成员后，显示其办理事项

            //获取数据库中存储的年份数据
            $years = array();
            $years[] = date('Y');

            $yearData = $itemModel->field('starttime')->where("inid=$who")->order('starttime desc')->select();
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

            $curItems = $itemModel->field('status,starttime')->where("inid=$who and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
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