<?php
/**
 * 权力运行流程
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PflowController extends CommonController {
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

        //获取成员列表
        $memberModel = D('Pflow');

        $contents = array();
        //按部门取数据
        foreach($departments as $de){
            $m = $de['id'];
            $flows = $memberModel->where("oid=$oid and mid=$m")->order('`orders` asc')->select();
            $contents[] = $flows;
        }
        $this->assign('contents',$contents);
        $this->display();
    }
    public function find(){
        $id = I('id');
        $model = D('Pflow');
        $data = $model->find($id);
        echo json_encode($data);
    }
    /**
     * 显示添加成员模板
     */
    public function add(){
        $mid = I('mid');
        $oid = I("oid");

        $model = D('Pflow');
        $members = $model->field('`id`,`orders`')->where("oid=$oid and mid=$mid")->order('`orders` ASC')->select();
        $lastOrder = count($members)-1;

        $nextOrder = $members[$lastOrder]['orders'] + 1;

        $this->assign('oid',I('oid'));
        $this->assign('mid', I('mid'));//部门id
        $this->assign('nextOrder',$nextOrder);
        $this->display();
    }
    /**
     * 添加
     */
    public function save(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
        $upload->savePath  =    ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        $infoFile = $info['file'];
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //更新数据库信息
            $model = D('Pflow');
            $data['oid'] = I('oid');
            $data['mid'] = I('mid');
            $data['power'] = I('power');
            $data['orders'] = I('orders');
            $data['flow'] = $infoFile['savepath'].$infoFile['savename'];
            $data['addtime']=$data['updatetime'] = time();
            if($model->add($data)){
                echo $model->getLastInsID();
                $this->redirect('index',array('mid'=>$data['mid'],'oid'=>$data['oid']));
            }else{
                echo $model->getLastSql();
            }

        }
    }

    public function edit(){
        $id = I('id');
        $oid = I('oid');
        $mid = I('mid');
        $model = D('Pflow');

        $this->assign('flow',$model->find($id));
        $this->assign('oid',$oid);
        $this->assign('mid',$mid);
        $this->assign('id', $id);
        $this->display();
    }

    public function update(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
        $upload->savePath  =    ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        $infoFile = $info['file'];
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //更新数据库信息
            $model = D('Pflow');
            $id = I('fid');
            $data['oid'] = I('oid');
            $data['mid'] = I('mid');
            $data['power'] = I('power');
            $data['orders'] = I('orders');
            $data['flow'] = $infoFile['savepath'].$infoFile['savename'];
            $data['addtime']=$data['updatetime'] = time();
            if($model->where("id=$id")->save($data)){
                $this->redirect('index',array('mid'=>$data['mid'],'oid'=>$data['oid']));
            }else{
                echo $model->getLastSql();
            }

        }
    }

    /**
     * 删除成员
     */
    public function delete(){
        $id = I('id');
        $listModel = D("Dposition");
        if($listModel->delete($id)){
            echo 1;
        }
    }
}