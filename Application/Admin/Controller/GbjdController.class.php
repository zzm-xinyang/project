<?php
/**
 * 官兵监督
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class GbjdController extends Controller {

    public function index(){
        //组织机构代码
        $oid = session('oid');

        if (isset($_GET['p'])) {
            $p = $_GET['p'];
        } else {
            $p = 1;
        }

        $tnegatives = D('Tnegatives');
        //获取所有实施方式
        $negativesData = $tnegatives->getNegatives($p, $oid, "", "", "");

        $this->assign('dataList', $negativesData);
        //分页相关设置
        $count = $tnegatives->getNegatives("0", $oid, "", "", ""); //查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出

        $this->display();
    }
    /**
     * 问责搜索
     */
    public function gbjd_search(){
        //以下四行是查询的条件，前台页面反馈的
        $kwd = $_POST['kwd'];
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
        $tnegatives = D('Tnegatives');
        //获取所有实施方式
        $negativesData = $tnegatives->getNegatives($p, $oid, "", "", "");
        $count = $tnegatives->getNegatives("0", $oid, "", "", ""); //查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('dataList', $negativesData);
        $res["content"] = $this->fetch('Gbjd/newlist');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     *第一种形态删除问责
     */
    public function gbjd_del(){
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