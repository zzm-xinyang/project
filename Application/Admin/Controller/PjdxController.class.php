<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PjdxController extends Controller {

    public function index(){
        //组织机构代码
        $oid = session('oid');
        $did = "1";
        $tobjects = D('Tobjects');
        $objectsData = $tobjects->getObjects($oid, $did);
        $this->assign("objectsData", $objectsData);

        if (IS_AJAX) {
            $webvalue = $_POST['pname'];
            $tmp = explode('：',$webvalue);
            $pduty = $tmp[0];
            $pname = $tmp[1];

            $pid = $tobjects->getObjectId($oid,$pduty,$pname);
            $title = $webvalue;
        }else{
            $pid = $objectsData[0]['pid'];
            $title = $objectsData[0]['duty']."：".$objectsData[0]['name'];
        }
        $tassesses = D('Tassesses');
        $youData = $tassesses->getNum($pid, "优");
        $liangData = $tassesses->getNum($pid, "良");
        $zhongData = $tassesses->getNum($pid, "中");
        $chaData = $tassesses->getNum($pid, "差");
        $tjdata = $tassesses->getPerGroupNum($pid);
        $gnum = $tassesses->getGroupNum($pid);
        $groupData = $tassesses->getGroupName($pid);
//        for($i=0; $i<$gnum; $i++){
//            for($j=4*$i; $j<4*($i+1); $j++){
//                if($tjdata[$j]['assess']=="优"){
//                    $dealdata[4*$i]['num'] = $tjdata[$j]['num'];
//                }else{
//                    $dealdata[4*$i]['num'] = 0;
//                }
//            }
//            for($j=4*$i; $j<4*($i+1); $j++){
//                if($tjdata[$j]['assess']=="良"){
//                    $dealdata[4*$i+1]['num'] = $tjdata[$j]['num'];
//                }else{
//                    $dealdata[4*$i+1]['num'] = 0;
//                }
//            }
//            for($j=4*$i; $j<4*($i+1); $j++){
//                if($tjdata[$j]['assess']=="中"){
//                    $dealdata[4*$i+2]['num'] = $tjdata[$j]['num'];
//                }else{
//                    $dealdata[4*$i+2]['num'] = 0;
//                }
//            }
//            for($j=4*$i; $j<4*($i+1); $j++){
//                if($tjdata[$j]['assess']=="差"){
//                    $dealdata[4*$i+3]['num'] = $tjdata[$j]['num'];
//                }else{
//                    $dealdata[4*$i+3]['num'] = 0;
//                }
//            }
//        }
        $tjdata['title'] = $title;
        $tjdata['cname'] = $groupData['name'];
        $tjdata['you'] = $youData;
        $tjdata['liang'] = $liangData;
        $tjdata['zhong'] = $zhongData;
        $tjdata['cha'] = $chaData;

        $this->assign("tjdata",$tjdata);
        if (IS_AJAX) {
            $this->ajaxReturn($tjdata);
        } else {
            $this->display();
        }
    }
    
    //添加
    public function pjdxadd(){
        $dutys = D('Dutys');
        $dutysData = $dutys->getAllDutys();
        $depts = D('Qjdepts');
        $oid = session('oid');
        $deptsData = $depts->getAllDepts($oid);
        $this->assign("dutysData", $dutysData);
        $this->assign("deptsData", $deptsData);
        $this->display();
    }
    
    //添加保存
    public function pjdxadd_save(){
        $dpt = $_POST['dpt'];  //部门
        $zw = $_POST['zw'];   //职务
        $xm = $_POST['xm'];   //姓名

        $Tobjects = D('Tobjects');
        //组织机构代码
        $oid = session('oid');
        $did = "1";
        $id = $Tobjects->insertoObjects($oid, $did, $xm, $zw);
        if ($id > 0) {
            $this->redirect('index', '', 2, '添加成功...');
        } else {
            $this->redirect('lbadd', '', 2, '添加失败...');
        }

    }
    
    //编辑
    public function pjdxedit(){
        $id = $_GET['kw'];
        $Tobjects = D('Tobjects');
        $editData = $Tobjects->getOneObject($id);
        $this->assign('id',$id);
        $this->assign('did',$editData['did']);
        $this->assign('dutyid',$editData['dutyid']);
        $this->assign('name',$editData['name']);
        $dutys = D('Dutys');
        $dutysData = $dutys->getAllDutys();
        $depts = D('Qjdepts');
        $oid = session('oid');
        $deptsData = $depts->getAllDepts($oid);
        $this->assign("dutysData", $dutysData);
        $this->assign("deptsData", $deptsData);
        $this->display();
    }
    
    //编辑保存
    public function pjdxedit_save(){
        $id=$_POST['rid'];  //id
        $dpt=$_POST['dpt'];   //部门
        $zw=$_POST['zw'];   //职务
        $xm=$_POST['xm'];   //姓名
        $Tobjects = D('Tobjects');
        if($Tobjects->updateObjects($id,$dpt,$xm,$zw)){
            echo '<script>alert("修改成功！");location.href = "javascript:history.back()"</script>';
        }else{
            echo '<script>alert("修改失败！");location.href = "javascript:history.back()"</script>';
            echo $Tobjects->getDbError();
        }
				
    }
    
    public function pjdxdel(){
        $id = $_POST['id'];
        $Tobjects = D('Tobjects');
        $bool = $Tobjects->delObjects($id);
        $this->ajaxReturn($bool);
    }
}