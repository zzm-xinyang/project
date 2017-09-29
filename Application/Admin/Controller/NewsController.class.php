<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
        $this->display();
    }
    public function welcome(){
        $this->display();
    }
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
    public function parchitecture(){

        $oid = I('oid');
        $organizeModel = D('Organize');
        $picture = $organizeModel->find($oid);
        $this->assign('oid',$oid);
        $this->assign('picture',$picture['inarchitecture']);
        $this->display();
    }
    public function xwdt_search(){


        if(isset($_POST['submit'])){
            $logmax = $_POST['logmax'];
            $logmin = $_POST['logmin'];
            $newskeyword = $_POST['newskeyword'];
            $mintime = strtotime($logmin);
            $maxtime = strtotime($logmax);
            $map['newskeyword'] = $newskeyword;
            $map['mintime'] = $mintime;
            $map['maxtime'] = $maxtime;
            session('map',$map);
        }else{
            $map = session('map');
            $newskeyword = $map['newskeyword'];
            $mintime = $map['mintime'];
            $maxtime = $map['maxtime'];
        }

        $m = M('news')->join('news_c  on news.id = news_c.tid');

       if (empty($mintime) and empty($maxtime)){
            $where['news.title'] = array('like','%'.$newskeyword.'%');

        }elseif (empty($mintime)){
            $where['news.title'] = array('like','%'.$newskeyword.'%');
            $where['news.updatetime'] = array('ELT',$maxtime);
        }elseif(empty($maxtime)){
            $where['news.title'] = array('like','%'.$newskeyword.'%');
            $where['news.updatetime'] = array('EGT',$mintime);
        }else{
            $where['news.title'] = array('like','%'.$newskeyword.'%');
            $where['news.updatetime'] = array('between',array($mintime,$maxtime));
        };
        $count = $m->where($where)->count();
        $p = new \Think\Page($count,10);//getpage($count,10);
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $newslists = M('news')->join('news_c  on news.id = news_c.tid')->order('news.updatetime desc')->limit($p->firstRow, $p->listRows)->where($where )->select();

        $this->assign('newslists',$newslists);



        $this->assign('page', $p->show()); // 赋值分页输出

        $this->display('News/xwdt');

    }
    public function xwdt(){

        $m = M('news')->join('news_c  on news.id = news_c.tid');

        $count = $m->count();
        $p = new \Think\Page($count,10);
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $newslists = $m->field(true)->order('news.id')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('newslists', $newslists); // 赋值数据集
        $this->assign('page', $p->show()); // 赋值分页输出
        $this->display();

        /*$newsnowpage = $_GET['newsnowpage'];
        if (empty($newsnowpage)){
            $newsnowpage = 0;
        }


        $newslists = M('news')->join('news_c  on news.id = news_c.tid')->limit(($newsnowpage-1)*10,$newsnowpage*10)->select();



        $this->assign('newslists',$newslists);
        //$this->assign();
        $this->display();*/
    }
    public function delete(){
        $newsid = $_GET['newsid'];
        $News_c = M('news_c');
        $News = M('news');

        $News ->delete($newsid);
        $News_c ->where('tid = '.$newsid) ->delete();
        $this -> success("删除成功！");

    }
    public function newscontent(){
        $newsid = $_GET['newsid'];
        $this->assign('newsid',$newsid);
        $this->redirect(U('/Home/Sjzxf/News/newscontent'));
    }

    public function xwdt_add(){

        $this->display();
    }
    public function xwdt_delsome(){

       $dels = $_POST['newsdels'];
       //$dels = explode(',',$dels);
        $News = M('news');
        $News_c = M('news_c');
        foreach($dels as $del){
            $News->delete($del);
            $News_c->where('tid = '.$del)->delete();
        }
        $this -> success("删除成功！");

    }
    public function xwdt_edit(){

        $m = M('news')->join('news_c  on news.id = news_c.tid');
        $newsid = $_GET['newsid'];
        $count = $m->count();
        $p = new \Think\Page($count,10);
        $newslists = $m->field(true)->where('news.id = '.$newsid)->order('news.id')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('newslists', $newslists); // 赋值数据集
        $this->assign('page', $p->show()); // 赋值分页输出

        $this->display();

    }

    public function xwdt_edit_submit(){
        $News_c = M('news_c');
        $News = M('news');
        $newsid = $_GET['newsid'];
        $editor = $_POST['editor'];
        $newstitle = $_POST['newstitle'];
        $update_time = time();

        $News_c->content = $editor;
        $News->title = $newstitle;
        $News->updatetime = $update_time;

        $News->where('id='.$newsid)->save();
        $News_c->where('tid='.$newsid)->save();

        $this -> success('修改成功！');



    }

    public function xwdt_add_submit(){

        if(IS_POST){

            /*//检测管理员信息
            $News_c = M('news_c');
            $News = M('news');

            $editor = $_POST['editor'];
            $newstitle = $_POST['newstitle'];
            $creat_time = time();
            $fileList = $_POST['fileList'];
            $obj = array(
                "inputtime" => $creat_time,
                "title" => $newstitle,
                "updatetime" => $creat_time,
            );
            $newsc_id = $News->add($obj);
            $obj1 = array(
                "tid" => $newsc_id,
                "content" => $editor,
            );

            $News_c->add($obj1);*/


            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     UPLOAD_PATH; // 设置附件上传根目录
            $upload->savePath  =    ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            $infoFile = $info['file'];


            //检测管理员信息
            $News_c = M('news_c');
            $News = M('news');

            $editor = $_POST['editor'];
            $newstitle = $_POST['newstitle'];
            $creat_time = time();
            $fileList = $_POST['fileList'];
            $obj = array(
                "inputtime" => $creat_time,
                "title" => $newstitle,
                "updatetime" => $creat_time,
                "thumb" => $infoFile['savepath'].$infoFile['savename'],
            );
            $news_id = $News->add($obj);
            $obj1 = array(
                "tid" => $news_id,
                "content" => $editor,
            );

            $News_c->add($obj1);




            $this -> success('添加新闻成功！');

            /*$editor = $_POST['editor'];
            echo $editor;
            $newstitle = $_POST['newstitle'];
            if( empty($newstitle)){
                $this->error('请填写文章标题');
            }*/
        } else {

            $this->error('环境检测没有通过，请调整环境后重试！');

            $this->display();
        }
    }
}