<?php
/**
 * 执纪问责
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class Zjwz2Controller extends Controller {
    /**
     * 第二种形态
     */
    public function index(){
        //组织机构代码
        $oid = session('oid');

        $Fmodes = D('Fmodes');
        //获取所有实施方式
        $modesData = $Fmodes->getAllMode('2');
        //获取实施方式的代码
        $dnjgModesData = $Fmodes->getOneMode('2', "党内警告");
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        } else {
            $p = 1;
        }

        $Fcontents = D('Fcontents');
        //获取所有党内警告的问责记录
        $dnjgData = $Fcontents->getContents($p, '2', $dnjgModesData['id'], $oid, "0", "0", "", "");
        $this->assign('dnjgData', $dnjgData);
        //分页相关设置
        $count = $Fcontents->getContents('0', '2', $dnjgModesData['id'], $oid, "0", "0", "", "");// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('fmodes', $modesData);
        //获取“涉及类型”列表
        $Ftypes = D('Ftypes');
        $this->assign("ftypes", $Ftypes->getAllTypes());
        //获取“线索来源”列表
        $Fsources = D('Fsources');
        $this->assign("fsources", $Fsources->getAllSources());
        $this->display();
    }
    /**
     * 问责搜索
     */
    public function zjwzxt2_search(){
        //当前选中的实施方式
        $ssfs = $_POST['ssfs'];
        //以下四行是查询的条件，前台页面反馈的
        $sjlx = $_POST['sjlx'];
        $xsly = $_POST['xsly'];
        $startdate = strtotime($_POST['startdate']);
        $enddate = strtotime($_POST['startdate']);
        //获取当前的页码
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        } else {
            $p = 1;
        }
        $Fmodes = D('Fmodes');
        $Fcontents = D('Fcontents');
        //组织机构代码
        $oid = session('oid');
        //获取第二种形态中的所有实施方式
        $modesData = $Fmodes->getAllMode('2');
        for ($i = 0; $i < count($modesData); $i++) {
            if ($modesData[$i]['mode'] == $ssfs) {
                //获取满足条件的记录总数
                $count = $Fcontents->getContents('0', '2', $modesData[$i]['id'], $oid, $sjlx, $xsly, $startdate, $enddate);
                //获取当前页的数据
                $searchData = $Fcontents->getContents($p, '2', $modesData[$i]['id'], $oid, $sjlx, $xsly, $startdate, $enddate);
            }
        }
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('dataResult', $searchData);
        //根据实施方式的不同，渲染不同页面
        switch($ssfs){
            case "党内警告":
                $res["content"] = $this->fetch('Zjwz2/dnjglist');
                break;
            case "党内严重警告":
                $res["content"] = $this->fetch('Zjwz2/yzjglist');
                break;
            case "行政警告":
                $res["content"] = $this->fetch('Zjwz2/xzjglist');
                break;
            case "行政记过":
                $res["content"] = $this->fetch('Zjwz2/xzjguolist');
                break;
            case "行政记大过":
                $res["content"] = $this->fetch('Zjwz2/xzjdglist');
                break;
            case "行政降级":
                $res["content"] = $this->fetch('Zjwz2/xzjjlist');
                break;
            case "停职检查":
                $res["content"] = $this->fetch('Zjwz2/tzjclist');
                break;
            case "调整职务岗位":
                $res["content"] = $this->fetch('Zjwz2/tzgwlist');
                break;
            case "免职":
                $res["content"] = $this->fetch('Zjwz2/mzlist');
                break;
            case "引咎辞职":
                $res["content"] = $this->fetch('Zjwz2/yjczlist');
                break;
            case "责令辞职":
                $res["content"] = $this->fetch('Zjwz2/zlczlist');
                break;
            default:
                $res["content"] = $this->fetch('Zjwz2/dnjglist');
        }
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 第二种形态添加实施方式
     */
    public function zjwzxt2_add(){
        $this->display();
    }

    /**
     * 第二种形态新增实施方式保存
     */
    public function zjwzxt2_add_save(){
        $ssfs=$_POST['ssfs'];  //实施方式
        $ms=$_POST['ms'];   //描述

        $Fmodes = D('Fmodes');
        $fmode = $Fmodes->where("mode='$ssfs' and 	tid='2'")->find();
        //查询新增的实施方式是否已经存在
        if($fmode){
            echo '<script>alert("该实施方式已存在！");location.href = "javascript:history.back()"</script>';
        }else {
            $id = $Fmodes->insertFmode('2', $ssfs, $ms);
            if($id>0){
                $this->redirect('index', '', 2, '添加成功...');
            }else{
                $this->redirect('zjwzxt2_add', '', 2, '添加失败...');
            }
        }
    }

    /**
     * 第二种形态编辑实施方式
     */
    public function zjwzxt2_edit(){
        $ssfs = $_GET['kw'];
        $Fmodes = D('Fmodes');
        $editData = $Fmodes->getOneMode('2', $ssfs);
        $this->assign('ssfs',$ssfs);
        $this->assign('ms',$editData['dicription']);
        $this->assign('id',$editData['id']);
        $this->display();
    }

    /**
     * 第二种形态编辑实施方式保存
     */
    public function zjwzxt2_edit_save(){
        $ssfs=$_POST['ssfs'];  //实施方式
        $ms=$_POST['ms'];   //描述
        $id=$_POST['mid'];   //记录在数据库中的id
        $Fmodes = D('Fmodes');
        if($Fmodes->updateMode($id,$ssfs,$ms)){
            echo '<script>alert("修改成功！");location.href = "javascript:history.back()"</script>';
        }else{
            echo '<script>alert("修改失败！");location.href = "javascript:history.back()"</script>';
            echo $Fmodes->getDbError();
        }

    }

    /**
     *第二种形态删除实施方式
     */
    public function zjwzxt2_del(){
        $id = $_POST['id'];
        $Fmodes = D('Fmodes');
        $bool = $Fmodes->delMode($id);
        $this->ajaxReturn($bool);
    }
    
    /**
     * 第二种形态新增问责
     */
    public function zjwzxt2_add_wz(){
        //实施方式
        $ssfs = $_GET['fs'];

        $Fmodes = D('Fmodes');
        $fmode = $Fmodes->getOneMode('2',$ssfs);
        //“职务”列表
        $Dutys = D('Dutys');
        $this->assign("dutys",$Dutys->getAllDutys());
        //“涉及类型”列表
        $Ftypes = D('Ftypes');
        $this->assign("ftypes",$Ftypes->getAllTypes());
        //“线索来源”列表
        $Fsources = D('Fsources');
        $this->assign("fsources",$Fsources->getAllSources());
        //实施方式
        $this->assign("ssfs",$ssfs);

        switch ($ssfs) {
            case "党内警告":
                $this->display('zjwzxt2_add_dnjg');
                break;
            case "党内严重警告":
                $this->display('zjwzxt2_add_yzjg');
                break;
            case "行政警告":
                $this->display('zjwzxt2_add_xzjg');
                break;
            case "行政记过":
                $this->display('zjwzxt2_add_xzjguo');
                break;
            case "行政记大过":
                $this->display('zjwzxt2_add_xzjdg');
                break;
            case "行政降级":
                $this->display('zjwzxt2_add_xzjj');
                break;
            case "停职检查":
                $this->display('zjwzxt2_add_tzjc');
                break;
            case "调整职务岗位":
                $this->display('zjwzxt2_add_tzgw');
                break;
            case "免职":
                $this->display('zjwzxt2_add_mz');
                break;
            case "引咎辞职":
                $this->display('zjwzxt2_add_yjcz');
                break;
            case "责令辞职":
                $this->display('zjwzxt2_add_zlcz');
                break;
            default:
                $this->display('zjwzxt2_add_dnjg');
        }
    }

    /**
     * 第二种形态新增问责保存
     */
    public function zjwzxt2_addwz_save(){
        $ssfs = $_POST['ssfs'];
        $rid = $_POST['rid'];
        $Fmodes = D('Fmodes');
        $fmode = $Fmodes->getOneMode('2',$ssfs);
        
        $mid = $fmode['id'];
        $thrxm = $_POST['thrxm'];
        $thrzw = $_POST['thrzw'];
        $thrdw = $_POST['thrdw'];
        $thdxxm = $_POST['thdxxm'];
        $thdxdw = $_POST['thdxdw'];
        $thdxzw = $_POST['thdxzw'];
        $thsj = $_POST['thsj'];
        $jcxs = $_POST['jcxs'];
        $thdd = $_POST['thdd'];
        $cjry = $_POST['cjry'];
        $lxry = $_POST['lxry'];
        $fbbm = $_POST['fbbm'];
        $zy = $_POST['zy'];
        $sjlx = I('sjlx');
        $xsly = I('xsly');
        $status = "2";
        $oid = session('oid');
        
        $Fcontent = D('Fcontents');
        if($rid){//修改操作
        	$rst = $Fcontent->updateContent($rid,$mid,$thrxm,$thrzw,$thrdw,$thdxxm,$thdxdw,$thdxzw,strtotime($thsj),$jcxs,$thdd,$cjry,$lxry,$fbbm,$zy,$sjlx,$xsly);
        }else{//新增操作
        	$rst = $Fcontent->insertContent($mid,$thrxm,$thrzw,$thrdw,$thdxxm,$thdxdw,$thdxzw,strtotime($thsj),$jcxs,$thdd,$cjry,$lxry,$fbbm,$zy,$sjlx,$xsly,$status,$oid);
        }
        if($rst){
            echo '<script>alert("保存成功！");location.href = "javascript:history.back()"</script>';
        }else{
            echo '<script>alert("保存失败！");location.href = "javascript:history.back()"</script>';
            echo $Fmodes->getDbError();
        }
    }

    /**
     * 第一种形态编辑问责
     */
    public function zjwzxt2_edit_wz()
    {
        //要修改记录的id
        $rid = $_GET['rid'];
        //根据记录ID获取记录的具体内容
        $Fcontent = D('Fcontents');
        $fcontectData = $Fcontent->getOneContent($rid);        
        $this->assign("fdata", $fcontectData);
        
        $Fmodes = D('Fmodes');
        $fmode = $Fmodes -> getModeById($fcontectData['mid']);
        $ssfs = $fmode['mode'];
        
        $Dutys = D('Dutys');
        $Ftypes = D('Ftypes');
        $Fsources = D('Fsources');

        $this->assign("dutys",$Dutys->getAllDutys());
        $this->assign("ftypes",$Ftypes->getAllTypes());
        $this->assign("fsources",$Fsources->getAllSources());
        $this->assign("ssfs",$ssfs);

        switch ($ssfs) {
            case "党内警告":
                $this->display('zjwzxt2_add_dnjg');
                break;
            case "党内严重警告":
                $this->display('zjwzxt2_add_yzjg');
                break;
            case "行政警告":
                $this->display('zjwzxt2_add_xzjg');
                break;
            case "行政记过":
                $this->display('zjwzxt2_add_xzjguo');
                break;
            case "行政记大过":
                $this->display('zjwzxt2_add_xzjdg');
                break;
            case "行政降级":
                $this->display('zjwzxt2_add_xzjj');
                break;
            case "停职检查":
                $this->display('zjwzxt2_add_tzjc');
                break;
            case "调整职务岗位":
                $this->display('zjwzxt2_add_tzgw');
                break;
            case "免职":
                $this->display('zjwzxt2_add_mz');
                break;
            case "引咎辞职":
                $this->display('zjwzxt2_add_yjcz');
                break;
            case "责令辞职":
                $this->display('zjwzxt2_add_zlcz');
                break;
        }
    }

    /**
     *第二种形态删除问责
     */
    public function zjwzxt2_del_wz(){
        $id = $_POST['id'];
        $Fmodes = D('Fcontents');
        //如果$id传过来的是数组，说明是批量删除
        if(strpos($id,",")){
            $bool = $Fmodes->delBatchContent($id);
        }else{
            $bool = $Fmodes->delContent($id);
        }
        $this->ajaxReturn($bool);
    }
}