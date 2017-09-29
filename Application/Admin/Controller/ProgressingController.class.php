<?php
/**
 * 权力运行
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class ProgressingController extends CommonController {
    public function add(){
        $tableName = ucfirst(I('tableName'));
        $this->assign('tableName',$tableName);
        $this->assign('iid',I('iid'));
        $this->assign('mid',I('mid'));

        //取出表中字段
        $model = D($tableName);
        $sql="show full fields from $tableName";
        $this->assign('fields',$model->query($sql));
        $this->display();
    }

    public function save(){
        $model = D($_POST['tableName']);
        $data = array();
        $data['iid'] = I('iid');
        $mid = I('mid');
        //先处理提交过来的非文件数据
        foreach($_POST as $key=>$val){
            if($key=='tableName') continue;
            if(strtotime($val)){
                $data[$key] = strtotime($val);
            }else{
                $data[$key] = $val;
            }

        }

        //检查是否有上传的文件
        if(count($_FILES)){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('doc', 'pdf', 'docx', 'xls','sql','cs');// 设置附件上传类型
            $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
            $upload->savePath  =    ''; // 设置附件上传（子）目录
            // 上传文件
            $infos   =   $upload->upload();
            if(!$infos) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            foreach($infos as $key=>$info){
                $data[$key] = $info['savepath'].$info['name'];

            }

        }
        $data['addtime']=$data['updatetime'] = time();
        if($model->add($data)){

            //跳转到权力监控运行页面
            $this->redirect('Pcontrol/index',array('oid'=>session('oid'),'mid'=>$mid));
        }else{
            echo $model->getLastSql();
        }
    }

    /**
     * 显示编辑模板
     */
    public function edit(){
        $tableName = ucfirst(I('tableName'));
        $id = I('id');
        $this->assign('tableName',$tableName);
        $this->assign('id',$id);

        //取出表中字段
        $model = D($tableName);
        $sql="show full fields from $tableName";
        $this->assign('fields',$model->query($sql));


        //取出表中数据
        $progressing = $model->find($id);
        $this->assign('progressing',$progressing);
        $this->display();

    }

    /**
     * 更新数据
     */
    public function update(){
        $model = D($_POST['tableName']);

        $data = array();
        $id = $_POST['id'];
        //先处理提交过来的非文件数据
        foreach($_POST as $key=>$val){
            if($key=='tableName') continue;
            if($key=='id') continue;
            if(strtotime($val)){
                $data[$key] = strtotime($val);
            }else{
                $data[$key] = $val;
            }

        }

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('doc', 'pdf', 'docx', 'xls','sql','cs');// 设置附件上传类型
        $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
        $upload->savePath  =    ''; // 设置附件上传（子）目录
        // 上传文件
        $infos   =   $upload->upload();
        if(!$infos) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        foreach($infos as $key=>$info){
            $data[$key] = $info['savepath'].$info['name'];
            $data['updatetime'] = time();
        }
        if($model->where("id=$id")->save($data)){
            //跳转到架构图显示页
            $this->redirect('Pcontrol/index',array('oid'=>session('oid'),'mid'=>1));
        }else{
            echo $model->getLastSql();
        }
    }

    /**
     * 删除数据
     */
    public function delete(){
        $tableName = ucfirst(I('tableName'));
        $id = I('id');
        $model = D($tableName);
        if($model->delete($id)){
            echo 1;
        }
    }
}