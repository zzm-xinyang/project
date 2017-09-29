<?php
namespace Sjzxf\Controller;
use Think\Controller;
class RegulationsController extends Controller {
    public function index(){
        $db = D('Regulations');
        $page = $db -> page();
        $regulations = $db -> showAll($page);
        $show = $page -> show();
        $this -> assign('page',$show);
        $this -> assign('regulations',$regulations);
        $this -> display();
    }

    public function showContent(){
        $rid = $_GET['rid'];
        $title = $_GET['title'];
        $updatetime = $_GET['updatetime'];
        $db = D('cregulations');
        $content = $db
            -> field('content')
            -> where('tid=%d',$rid)
            -> select();
        $ccontent = current(current($content));
        $all = array(
            '0' => array(
                'title' => $title,
                'updatetime' => $updatetime,
                'content' => $ccontent
                ),
        );
        $this -> assign('all',$all);
        $this->display();
    }
}