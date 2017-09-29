<?php
/**
 * 权力运行监控
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PcontrolController extends CommonController {
    public function index(){
        //确定组织
        $oid = I("oid");
        $this->assign('oid',$oid);

        //确定哪个部门显示
        $mid = I('mid');
        $this->assign('mid',$mid);

        //获取有哪些部门
        $dModel = D('Qjdept');
        $departments = $dModel->order('id asc')->select();
        $this->assign('departments',$departments);

        $model = D('Pcontrol');
        $contents = array();
        //按部门取数据
        foreach($departments as $de){
            $m = $de['id'];
            // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
            if(isset($_GET['p'])){
                $p = $_GET['p'];
            }else{
                $p = 1;
            }
            $num = 10;//每页显示数据量
            $controls = $model->field('`pflows`.`power`,`pcontrols`.id')->join('pflows ON pflows.id=pcontrols.name')->where("`pcontrols`.`oid`=$oid and `pcontrols`.`mid`=$m")->order('`pcontrols`.`id` desc')->select();
            $controlsP = $model->field('`pflows`.`power`,`pcontrols`.*')->join('pflows ON pflows.id=pcontrols.name')->where("`pcontrols`.`oid`=$oid and `pcontrols`.`mid`=$m")->order('`pcontrols`.`id` desc')->page($p.",$num")->select();

            $count = count($controls);
            $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');

            $map = array();
            $map['mid'] = $m;
            $map['oid'] = $oid;
            $map['num'] = $num;
            //分页跳转的时候保证查询条件
            foreach($map as $key=>$val) {
                $Page->parameter[$key]   =   urlencode($val);
            }
            $show       = $Page->show();// 分页显示输出
            foreach ($controlsP as &$c){
                $c['type']= $c['type'] == '1'? '内部管理':'社会公开';
                $c['notice'] = $c['notice']=='1' ? '内部':'社会';
                $c['inputtime'] = date('Y-m-d',$c['inputtime']);
                $c['page'] = $show;
            }
            $contents[] = $controlsP;
        }
        $this->assign('contents',$contents);


        $importantModel = D('Cimportant');//获取监控重点
        $flowModel = D('Pflow');//获取流程
        $keymodel = D('Keymodel');//获取监控重点与表名对应模型
        $tmodel = D('Tmodel'); //模型存储表

        $controls = array();//选出监控重点
        $addTable = array(); //判断添加表结构按钮要不要显示
        $addProgress = array(); //判断添加权力运行按钮要不要显示
        $editTable = array(); //判断修改表结构要不要显示
        $viewTable = array(); //判断数据表格要不要显示
        $hasKey = array(); //是否有监控重点
        $which = array(); //存储第一个监控重点id
        $tname = array(); //存储首个监控重点的表名
        $progressings = array(); //存储各个部门的首个监控重点
        $fields = array(); //各个数据表的字段名称
        $editTName = array(); //要编辑的表的名字

        foreach($departments as $de){
            $importants = $importantModel->getImportant($oid,$de['id']);
            if($importants){//如果有监控重点
                $cids = array();
                foreach($importants as $important){

                    $cids[] = $flowModel->field('`id`,`power`')->find($important);
                }
                $controls[] = $cids;
                $which[] = $tmpid = $cids[0]['id'];
                $hasKey[] = 1;

                $choiseModel = $keymodel->where("cid=$tmpid")->find();

                if($choiseModel){//如果已经选定了表结构
                    $addTable[] = NULL;
                    $addProgress[] = 1; //加号可以显示

                    $tableName = $tmodel->check($choiseModel['tid']);
                    $tname[] = $tableName;


                    $progressModel = D(ucfirst($tableName));
                    $progressingAll = $progressModel->select();
                    if($progressingAll){//判断表内是否有数据，如果有数据，表结构不能再修改，否则表结构还可以再修改
                        $editTable[] = NULL;
                    }else{
                        $editTable[] = 1;
                    }
                    $progressing = $progressModel->where("iid=$tmpid")->order('id desc')->select();


                    $count = count($controls);
                    $Page       = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
                    $Page->setConfig('prev','上一页');
                    $Page->setConfig('next','下一页');

                    $map = array();
                    $map['mid'] = $m;
                    $map['oid'] = $oid;
                    $map['num'] = $num;
                    //分页跳转的时候保证查询条件
                    foreach($map as $key=>$val) {
                        $Page->parameter[$key]   =   urlencode($val);
                    }
                    $show       = $Page->show();// 分页显示输出
                    if($progressing){//如果表内有数据
                        //先分配列标题
                        $model = D(ucfirst($tableName));
                        $sql="show full fields from $tableName";
                        $field = $model->query($sql);
                        $fields[] = $field;
                        //再分配内容
                        foreach($progressing as $key=>&$p){
                            $add = array();
                            $i=0;
                            foreach($p as $tmp){
                                $i++;
                                if($i>=6){//第6个字段之后，是用户自己添加的字段
                                    $add[] = $tmp;
                                }
                            }
                            $p['add'] = $add;

                        }
                        $progressings[] = $progressing;
                        $viewTable[] = 1;
                        $editTName[] = $tname;
                    }else{//如果表内无数据
                        $viewTable[] =NULL;
                        $progressings[]=NULL;
                        $editTName[] = $tname;

                        $progressings[] = NULL;
                        $viewTable[] = NULL;
                    }



                }else{//如果还没有选定表结构
                    $addProgress[] = 0; //加号不能显示
                    $tname[] = NULL;
                    $addTable[] = 1;

                }
            }else{//如果没有监控重点
                $hasKey[] = 0;
            }
        }

        //获取评价
        $passesses = $this->passess($departments,$oid);
        $this->assign('passesses',$this->passess($departments,$oid));
        $this->assign('controls',$controls);
        $this->assign('addTable',$addTable);
        $this->assign('editTable',$editTable);
        $this->assign('viewTable',$viewTable);
        $this->assign('hasKey',$hasKey);
        $this->assign('which',$which);
        $this->assign('tname',$tname);
        $this->assign('progressings',$progressings);
        $this->assign('fields',$fields);
        $this->assign('editTname',$editTName);
        $this->display();
    }
    /**
     * 获取评价
     */
    public function passess($departments,$oid){
        $passessModel  = D('Passesses');
        $passesses = array();
        foreach ($departments as $department) {
            $passess = array();
            $passess[] = $passessModel->countNum($oid,'1',$department['id']);
            $passess[] = $passessModel->countNum($oid,'2',$department['id']);
            $passess[] = $passessModel->countNum($oid,'3',$department['id']);
            $passess[] = $passessModel->countNum($oid,'4',$department['id']);
            $passesses[] = implode(',',$passess);
        }
        return $passesses;
    }

    /**
     * 显示添加流程模板
     */
    public function add(){
        //先获取流程
        $mid = I('mid');
        $oid = I('oid');
        $this->assign('oid',$oid);
        $this->assign('mid',$mid);
        $model = D('Pflow');
        $this->assign('flows',$model->where("mid=$mid and oid=$oid")->select());
        $this->display();
    }

    /**
     * 添加
     */
    public function save(){
        $model = D('Pcontrol');
        $data['inputtime'] = $data['updatetime'] = time();
        $data['oid'] = $_POST['oid'];
        $data['mid'] = $_POST['mid'];
        $data['name'] = $_POST['name'];
        $data['type'] = $_POST['type'];
        $data['reasons'] = $_POST['reasons'];
        $data['activity'] = $_POST['activity'];
        $data['notice'] = $_POST['notice'];
        if($model->add($data)){
            $this->redirect('index',array('oid'=>$_POST['oid'],'mid'=>$_POST['mid']));
        }; // 写入数据到数据库
    }

    public function edit(){
        $id = I('id');
        $oid = I('oid');
        $mid = I('mid');
        //获取流程列表
        $model = D('Pflow');
        $this->assign('flows',$model->where("mid=$mid and oid=$oid")->select());

        $model = D('Pcontrol');
        $this->assign('control',$model->find($id));
        $this->assign('oid',$oid);
        $this->assign('mid',$mid);
        $this->assign('id', $id);
        $this->display();
    }

    public function update(){
        $id = $_POST['id'];

        $model = D('Pcontrol');
        $data['updatetime'] = time();
        $data['name'] = $_POST['name'];
        $data['type'] = $_POST['type'];
        $data['reasons'] = $_POST['reasons'];
        $data['activity'] = $_POST['activity'];
        $data['notice'] = $_POST['notice'];
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$_POST['oid'],'mid'=>$_POST['mid']));
        }; //
    }

    /**
     * 删除
     */
    public function delete(){
        $id = I('id');
        $listModel = D("Pcontrol");
        if($listModel->delete($id)){
            echo 1;
        }
    }

    /**
     * 监控重点，选择表结构
     */
    public function choiseTable(){
        $oid = I('oid');
        $mid = I('mid');
        $iid = I('iid');
        //先选择数据表
        $model = D('Pgrogressing');
        $models = $model->where("oid=$oid and mid=$mid and iid=$iid");

    }

    /**
     * 岗位权力分页显示数据
     */
    public function page(){
        $p = I('p');
        $m = I('mid');
        $oid = I('oid');
        $num = I('num');
        $model = D('Pcontrol');
        $controlsP = $model->field('`pflows`.`power`,`pcontrols`.*')->join('pflows ON pflows.id=pcontrols.name')->where("`pcontrols`.`oid`=$oid and `pcontrols`.`mid`=$m")->order('`pcontrols`.`id` desc')->page($p.",$num")->select();

        echo json_encode($controlsP);
    }


}