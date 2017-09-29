<?php
/**
 * 四权监控
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class PmonitorController extends CommonController {
    public function index(){
        $oid = I('oid');
        $this->assign("oid",$oid);
        $model = D('Pmonitor');

        //选取四权监控内容
        $major = $model->where('major="1"')->find();
        $this->assign('major',$major);

        //选取其他主题内容
        $subjects = $model->where('major="0"')->select();
        $this->assign('subjects',$subjects);

        $this->display();
    }
    /**
     * 修改主题
     */
    public function edit(){
        //如果未传递id过来，则是添加
        $model = D('Pmonitor');
        $monitor = $model->find(I('id'));
        $this->assign('monitor',$monitor);

        $this->display();
    }
    /**
     * 修改普通主题
     */
    public function edit2(){
        //如果未传递id过来，则是添加
        $model = D('Pmonitor');
        $monitor = $model->find(I('id'));
        $this->assign('monitor',$monitor);

        $this->display();
    }

    /**
     * 更新四权监控
     */
    public function update(){
        $model = D('Pmonitor');
        $data['subject'] = $_POST['subject'];
        $data['content'] = $_POST['content'];
        $data['oid'] = $_POST['oid'];
        //如果没有id，则添加数据
        if(!$_POST['id']){
            $data['inputtime'] = $data['updatetime'] = time();
            $data['major'] = '1';
            if($model->add($data)){
                $this->redirect('index',array('oid'=>$data['oid']));
            }
        }else{
            $id = $_POST['id'];
            $data['updatetime'] = time();
            if($model->where("id=$id")->save($data)){
                $this->redirect('index',array('oid'=>$data['oid']));
            }
        }
    }

    /**
     *添加普通主题
     */
    public function save(){
        $model = D('Pmonitor');
        $data['subject'] = $_POST['subject'];
        $data['content'] = $_POST['content'];
        $data['oid'] = $_POST['oid'];
        $data['inputtime'] = $data['updatetime'] = time();
        if($model->add($data)){
            $this->redirect('index',array('oid'=>$data['oid']));
        }
    }

    /**
     * 更新普通主题
     */
    public function update2(){
        $model = D('Pmonitor');
        $data['subject'] = $_POST['subject'];
        $data['content'] = $_POST['content'];
        $data['oid'] = $_POST['oid'];
        $id = $_POST['id'];
        $data['updatetime'] = time();
        if($model->where("id=$id")->save($data)){
            $this->redirect('index',array('oid'=>$data['oid']));
        }
    }


    /**
     * 删除主题
     */
    public function delete(){
        $id = I('id');
        $model = D("Pmonitor");
        if($model->delete($id)){
            echo 1;
        }
    }
}