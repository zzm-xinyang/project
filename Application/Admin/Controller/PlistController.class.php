<?php
/**
 * 党委领导班子集体责任
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PlistController extends CommonController {
    /**
     * 领导班子集体责任首页
     */
    public function index(){
        //确定组织
        $oid = I("oid");
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

    /**
     * 显示添加集体责任清单
     */
    public function plists(){
        $this->display();
    }

    /**
     * 添加集体责任清单
     */
    public function listAdd(){
        $data['oid'] = I('oid');
        $data['item'] = $_POST['item'];
        $data['content'] = $_POST['content'];
        $data['inputtime'] = $data['updatetime'] = time();

        $listModel = D("Plist");
        if($listModel->add($data)){
            $this->redirect('index',array('oid'=>$_POST['oid']));
        }
    }
    /**
     * 查询责任清单内容
     */
    public function listFind(){
        $id = I('id');
        $listModel = D("Plist");
        $list = $listModel->find($id);

        // echo $list['content'];
        return 1;
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

    /**
     * 显示修改集体责任清单页面
     */
    public function listEdit(){
        $id = I('id');
        $listModel = D("Plist");
        $list = $listModel->find($id);
        $this->assign('list',$list);
        $this->display();
    }
    /**
     * 删除集体责任清单页面
     */
    public function listDelete(){
        $id = I('id');
        $listModel = D("Plist");
        if($listModel->delete($id)){
            echo 1;
        }
    }
    /**
     * 更新集体责任清单页面
     */
    public function listUpdate(){
        $id = I('id');
        $data['item'] = $_POST['item'];
        $data['content'] = $_POST['content'];
        $data['updatetime'] = time();

        $listModel = D("Plist");
        $listModel->where("id=$id")->save($data);
        $this->success("修改成功！");
        /*if($listModel->where("id=$id")->save($data)){
            //$this->redirect('Plist/index',array('oid'=>$_POST['oid']));
            $this->success("修改成功！");
        }*/
    }

    /**
     * 显示添加事项模板
     */
    public function pitems(){
        $this->display();
    }

    /**
     * 添加事项
     */
    public function itemAdd(){
        $data['oid'] = I('oid');
        $data['item'] = $_POST['item'];
        $data['description'] = $_POST['description'];
        $data['subject'] = $_POST['subject'];
        $data['inputtime'] = $data['updatetime'] = $data['starttime'] = time();
        $data['timelimit'] = $_POST['timelimit'];
        $data['status'] = 1;

        $itemModel = D("Pitem");
        if($itemModel->add($data)){
            $this->redirect('index',array('oid'=>$_POST['oid']));
        }else{
            echo $itemModel->getLastSql();
        }
    }

    /**
     * 显示更新事项模板
     */
    public function itemEdit(){
        $id = I('id');
        $itemModel = D("pitems");
        $item = $itemModel->find($id);
        $this->assign('item',$item);
        $this->display();
    }

    /**
     * 更新事项
     */
    public function itemUpdate(){
        $id = I('id');
        $data['item'] = $_POST['item'];
        $data['description'] = $_POST['description'];
        $data['subject'] = $_POST['subject'];
        $data['timelimit'] = $_POST['timelimit'];
        $data['status'] = $_POST['status'];
        $data['updatetime'] = time();

        $listModel = D("Pitem");
        //$listModel->where("id=$id")->save($data);
        if($listModel->where("id=$id")->save($data)){
            //$this->redirect('Plist/index',array('oid'=>$_POST['oid']));
            $this->success("修改成功！");
        }


    }

    /**
     * 删除事项
     */
    public function itemDelete(){
        $id = I('id');
        $listModel = D("Pitem");
        if($listModel->delete($id)){
            echo 1;
        }
    }

    /*
     * 批量删除
     */

    public function delsome(){

        $dels = $_POST['newsdels'];
        //$dels = explode(',',$dels);
        $listModel = D("Pitem");
        foreach($dels as $del){
            $listModel->delete($del);

        }
        $this -> success("删除成功！");

    }


    /**
     * 显示上传文件页面
     */
    public function itemUpload(){
        $pid = I("pid");
        //先获取已有文件
        $finishModel = D('Pfinish');
        $files = $finishModel->where("pid=$pid")->select();
        $this->assign('files',$files);
        $this->assign('pid',I('pid'));
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
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //更新数据库信息
            $finishModel = D('Pfinish');
            $data['pid']= $_POST['pid'];
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
        $finishModel = D("Pfinish");
        if($finishModel->delete($id)){
            echo 1;
        }
    }

    /**
     * 统计结果
     */
    public function count(){
        $itemModel = D("Pitem");
        $oid = I('oid');
        $year = I('year');
        //统计图-默认情况只选取当年的统计数据
        $start=$year.'-01-01 00:00:00';
        $end = $year.'-12-31 23:59:59';
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
        echo json_encode($nums);
    }
}