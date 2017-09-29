<?php
/**
 * 维护各组织的组织架构图，包括
 * 党委组织架构图
 * 纪委组织架构图
 * 支队架构图
 */
namespace Admin\Controller;
use Think\Controller;
class OrganizeController extends CommonController {
    /**
     * 显示党委架构图
     */
    public function parchitecture(){
        $oid = I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['parchitecture']);
        $this->display();
    }
    /**
     * 显示修改党委架构图页面
     */
    public function editParchitecture(){
        $oid = I('oid');
        $this->assign('oid',$oid);
        $this->display();
    }
    /**
     * 修改党委架构图页面
     */
    public function updateParchitecture(){
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
            $organizeModel = D('Organize');
            $oid= I('oid');
            $data['parchitecture'] = $infoFile['savepath'].$infoFile['savename'];
            $data['updatetime'] = time();
            if($organizeModel->where("id=$oid")->save($data)){
                //跳转到架构图显示页
            }else{
                echo $organizeModel->getLastSql();
            }

        }
    }
    /**
     * 显示纪委架构图
     */
    public function inarchitecture(){
        $oid = I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['inarchitecture']);
        $this->display();
    }
    /**
     * 显示修改纪委架构图页面
     */
    public function editInarchitecture(){
        $oid = I('oid');
        $this->assign('oid',$oid);
        $this->display();
    }
    /**
     * 修改纪委架构图页面
     */
    public function updateInarchitecture(){
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
            $organizeModel = D('Organize');
            $oid= I('oid');
            $data['inarchitecture'] = $infoFile['savepath'].$infoFile['savename'];
            $data['updatetime'] = time();
            if($organizeModel->where("id=$oid")->save($data)){
                //跳转到架构图显示页
            }else{
                echo $organizeModel->getLastSql();
            }

        }
    }

    /**
     * 显示支队架构图
     */
    public function oarchitecture(){
        $oid = I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['oarchitecture']);
        $this->display();
    }
    /**
     * 显示修改支队架构图页面
     */
    public function editOarchitecture(){
        $oid = I('oid');
        $this->assign('oid',$oid);
        $this->display();
    }
    /**
     * 修改支队架构图
     */
    public function updateOarchitecture(){
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
            $organizeModel = D('Organize');
            $oid= I('oid');
            $data['oarchitecture'] = $infoFile['savepath'].$infoFile['savename'];
            $data['updatetime'] = time();
            if($organizeModel->where("id=$oid")->save($data)){
                //跳转到架构图显示页
            }else{
                echo $organizeModel->getLastSql();
            }

        }
    }
}