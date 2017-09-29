<?php
/**
 * 成员分解清单落实情况
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PmitemController extends CommonController {
    public function index(){
        //获取成员列表
        $memberModel = D('Pmember');
        $members = $memberModel->field('`dutys`.`duty`,`pmembers`.*')->join('LEFT JOIN dutys ON dutys.id=pmembers.did')->order('`pmembers`.`orders` asc')->select();
        $this->assign('members',$members);

        //主体责任分解清单落实情况列表，默认显示第一个人的事项
        if(I('who')){
            $who = I('who')-0;
            if($who>0)
                session('whichPMember',$who);
        }else{
            $who = $members[0]['id'];
            session('whichPMember',$who);
        }
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

    /*
     * 条件查找
     */
    public function listsearch(){

        if(isset($_POST['submit'])){
            $logmax = $_POST['logmax'];
            $logmin = $_POST['logmin'];
            $status= $_POST['status'];
            $who = $_POST['who'];

            $keyword = $_POST['keyword'];
            $mintime = strtotime($logmin);
            $maxtime = strtotime($logmax);
            $map['status'] = $status;
            $map['who'] = $who;
            $map['keyword'] = $keyword;
            $map['mintime'] = $mintime;
            $map['maxtime'] = $maxtime;
            session('map',$map);
        }else{
            $map = session('map');
            $keyword = $map['keyword'];
            $mintime = $map['mintime'];
            $maxtime = $map['maxtime'];

            $who = $map['who'];
            $status = $map['status'];
        }

        $m = D("Pmitem");
        #$where['pitems.oid'] = I('oid');

        $where['pmitems.mid'] = $who;
        if ($status!=0){
            $where['pmitems.status'] = $status;
        }

        if (empty($mintime) and empty($maxtime)){
            $where['pmitems.item'] = array('like','%'.$keyword.'%');

        }elseif (empty($mintime)){
            $where['pmitems.item'] = array('like','%'.$keyword.'%');
            $where['pmitems.starttime'] = array('ELT',$maxtime);
        }elseif(empty($maxtime)){
            $where['pmitems.item'] = array('like','%'.$keyword.'%');
            $where['pmitems.starttime'] = array('EGT',$mintime);
        }else{
            $where['pmitems.item'] = array('like','%'.$keyword.'%');
            $where['pmitems.starttime'] = array('between',array($mintime,$maxtime));
        };
        $count = $m->where($where)->count();
        $p = new \Think\Page($count,10);//getpage($count,10);

        $itemLists = $m->order('pmitems.starttime desc')->limit($p->firstRow, $p->listRows)->where($where)->select();
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
        $this->assign('who',$who);


        $this->assign('page', $p->show()); // 赋值分页输出

        $years = array();
        $years[] = date('Y');

        $yearData = $m->field('starttime')->where("mid=$who")->order('starttime desc')->select();
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

        $curItems = $m->field('status,starttime')->where("mid=$who and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
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



        $this->display('Pmitem/index');
    }

    /**
     * 显示添加事项模板
     */
    public function add(){
        $this->assign("mid",I('mid'));
        $this->display();
    }

    /**
     * 添加事项
     */
    public function save(){
        $model = D('Pmitem');
        $data['item'] = $_POST['item'];
        $data['description'] = $_POST['description'];
        $data['inputtime'] = $data['updatetime'] = $data['starttime'] = time();
        $data['timelimit'] = $_POST['timelimit'];
        $data['mid'] = $_POST['mid'];
        $data['status'] = 1;
        if($model->add($data)){
            $this->success("保存成功！");
            //$this->redirect('index',array('oid'=>$_POST['oid'],'who'=>session('whichPMember')));
        }else{
            echo $model->getLastSql();
        }
    }

    /**
     * 显示修改事项模板
     */
    public function edit(){
        $id = I('id');
        $itemModel = D("Pmitem");
        $item = $itemModel->find($id);
        $this->assign('item',$item);
        $this->display();
    }

    /**
     * 更新事项
     */
    public function update(){
        $id = $_POST['id'];
        $data['item'] = $_POST['item'];
        $data['description'] = $_POST['description'];
        $data['timelimit'] = $_POST['timelimit'];
        $data['status'] = $_POST['status'];
        $data['updatetime'] = time();

        $listModel = D("Pmitem");
        if($listModel->where("id=$id")->save($data)){
            //$this->redirect('index',array('oid'=>$_POST['oid']));
            $this->success("修改成功！");
        }
    }

    /**
     * 删除事项
     */
    public function delete(){
        $id = I('id');
        $listModel = D("Pmitem");
        if($listModel->delete($id)){
            echo 1;
        }
    }

    /**
     * 批量删除
     */
    public function deletes()
    {
        $listModel = D("Pmitem");
        $dels = $_POST['dels'];
        foreach ($dels as $del) {


            $listModel->delete($del);
        }
        $this -> success("删除成功！");
    }

    /**
     * 显示上传文件页面
     */
    public function upload(){
        $inId = I("inId");
        //先获取已有文件
        $finishModel = D('PInfinish');
        $files = $finishModel->where("inid=$inId")->select();
        $this->assign('files',$files);
        $this->assign('inId',$inId);
        $this->display();
    }
    /**
     * 上传文件
     */
    public function uploadFiles(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg',"doc","docx","txt","pdf");// 设置附件上传类型
        $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
        $upload->savePath  =    ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        $infoFile = $info['file'];
        dump($infoFile);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //更新数据库信息
            $finishModel = D('PInfinish');
            $data['inid']= $_POST['pid'];
            $data['file'] = $infoFile['savepath'].$infoFile['savename'];
            $data['worker'] = 'admin';
            $data['filename'] = $infoFile['name'];
            $data['uploadtime'] = time();
            if($finishModel->add($data)){
                echo json_encode($data);
            }else{
                echo $finishModel->getLastSql();
            }

        }
    }

    /**
     * 删除文件
     */
    public function fileDelete(){
        $id = I('id');
        $finishModel = D("PInfinish");
        if($finishModel->delete($id)){
            echo 1;
        }
    }
    /**
     * 统计结果
     */
    public function count(){
        $mid = I('mid');
        $itemModel = D('Pmitem');
        $year = I('year');
        //统计图-默认情况只选取当年的统计数据
        $start=$year.'-01-01 00:00:00';
        $end = $year.'-12-31 23:59:59';
        $start = strtotime($start);//判断起始时间
        $end = strtotime($end);//判断结束时间

        $curItems = $itemModel->field('status,starttime')->where("mid=$mid and starttime>=$start and starttime <= $end")->order('starttime desc')->select();
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
        echo json_encode($nums);
    }
}