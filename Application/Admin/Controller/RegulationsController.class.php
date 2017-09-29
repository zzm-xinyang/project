<?php
namespace Admin\Controller;
use Think\Controller;
class regulationsController extends Controller{
    public function regulations(){
        $this->display();
    }

    public function showAllRegulations(){
        $db = D('regulations');
        $count = $db -> count();
        $page = new \Think\Page($count,10);
        $show = $page -> show();
        $regulations = $db
            -> field('regulations.id as rid,regulations.*,types_c.*')
            -> join('types_c ON regulations.tid = types_c.id')
            -> limit($page->firstRow.','.$page -> listRows)
            -> select();

        $this -> assign('regulations',$regulations);
        $this -> assign('page',$show);
        $this -> display();
    }

    public function regulationsAdd(){
        if (empty($_POST))
        {
            $db = D('types_c');
            $types_c = $db -> select();
            $this -> assign('types_c',$types_c);
            $this -> display();
        }else {
            $typeId = $_POST['qlmc'];
            $db = D('regulations');
            $db -> create();
            $time = date("Y-m-d H:i:s");
            $db -> tid = $typeId;
            $db -> inputtime = $time;
            $db -> updatetime = $time;
            $r = $db -> add();

            $content = strip_tags($_POST['content']);
            $db1 = D('cregulations');
            $db1 -> create();
            $db1 -> tid = $r;
            $db1 -> content = $content;
            $r1 = $db1 -> add();

            if ($r && $r1){
                $this -> success("添加数据成功!",'regulationsAdd',2);
            }else{
                $this -> error('添加数据失败!','regulationsAdd',2);
            }
        }
    }

    public function regulationsUpdate(){
        $rid = $_GET['rid'];
        $tid = $_GET['tid'];
        $db = D('regulations');
        $regulations = $db
            -> field('regulations.id as rid,regulations.*,types_c.*')
            -> join('types_c ON regulations.tid = types_c.id')
            -> where('regulations.id=%d',$rid)
            -> select();
        $db1 = D('cregulations');
        $cregulations = $db1
            -> where('tid=%d',$rid)
            -> select();
        if(empty($_POST)){
            $this -> assign('regulations',$regulations);
            $this -> assign('cregulations',$cregulations);
            $dbc = D('types_c');
            $types_c = $dbc -> where('id!=%d',$tid) -> select();
            $this -> assign('types_c',$types_c);
            $this -> display();
        }else{
            $title = $_POST['title'];
            $oldTitle = $db -> getField('title');
            if ($title != $oldTitle) {
                $db -> title = $title;
            }
            $typeId = $_POST['qlmc'];
            $oldTypeId = $db -> getField('tid');
            if ($typeId != $oldTypeId){
                $db -> tid = $typeId;
            }
            $content = strip_tags($_POST['content']);
            $oldContent = $db1 -> getField('content');
            if ($content != $oldContent){
                $db1 -> content = $content;
            }
            $r = $db -> where('id=%d',$rid) -> save();
            $r1 = $db1 -> where('tid=%d',$rid) -> save();
            if ($r || $r1){
                $updateTime = date("Y-m-d H:i:s");
                $db -> updatetime = $updateTime;
                $r = $db -> where('id=%d',$rid) -> save();
                $this -> success("修改数据成功!",'showAllRegulations',2);
            }else{
                $this -> error('修改数据失败!','showAllRegulations',2);
            }
        }
    }

    public function regulationsDel(){
        $id = $_GET['id'];
        if($id){
            $db = D('regulations');
            $db1 = D('cregulations');
            $r = $db -> where('id=%d',$id) -> delete();
            $r1 = $db1 -> where('tid=%d',$id) -> delete();
            if ($r && $r1){
                $this -> success('删除数据成功!');
            }else{
                $this -> error('删除数据失败!');
            }
        }else{
            $this -> error('删除数据失败!');
        }
    }

    public function batchDel(){
        $rids = $_GET['check_id'];
        if (!$rids){
            $this -> error('未选择记录');
        }else{
            $getRids = explode(',',$rids);
            $db = D('regulations');
            $db1 = D('cregulations');
            $r = $db -> delete($rids);
            for($i=0;$i<sizeof($getRids);$i++){
                $r1[$i] = $db1 -> where('tid=%d',$getRids[$i]) -> delete();
            }
            if ($r && $r1){
                $this -> success('删除数据成功!');
            }else{
                $this -> error('删除数据失败!');
            }
        }
    }

    public function showAllTypes(){
        $db = D('types_c');
        $types = $db -> select();
        $this -> assign('types',$types);
        $this -> display();
    }

    public function typesAdd(){
        $type = $_POST['type'];
        if (empty($type)){
            $db = D('types_c');
            $types = $db -> select();
            $this -> assign('types',$types);
            $this -> display();
        }else{
            $description = $_POST['description'];
            $db = D('types_c');
            $db -> create();
            $db -> name = $type;
            $db -> description = $description;
            $r = $db -> add();
            if ($r){
                $this -> success("添加数据成功!",'typesAdd',2);
            }else{
                $this -> error('添加数据失败!','typesAdd',2);
            }
        }
    }

    public function typesUpdate(){
        $id = $_GET['id'];
        $db = D('types_c');
        $result = $db -> where('id=%d',$id) -> select();
        if (empty($_POST)){
            $this -> assign('result',$result);
            $this -> display();
        }else{
            $type = $_POST['type'];
            $oldType = $db -> getField('name');
            if ($oldType != $type){
                $db -> name = $type;
            }
            $description = $_POST['description'];
            $oldDescription = $db -> getField('description');
            if ($oldDescription != $description){
                $db -> description = $description;
            }
            $r = $db -> where('id=%d',$id) -> save();
            if ($r){
                $this -> success("修改数据成功!",'showAllTypes',2);
            }else{
                $this -> error("修改数据失败!",'showAllTypes',2);
            }
        }
    }

    public function typesDel(){
        $id = $_GET['id'];
        if($id){
            $db = D('types_c');
            $r = $db -> where('id=%d',$id) -> delete();
            if ($r){
                $this -> success('删除数据成功!','showAllTypes',2);
            }else{
                $this -> error('删除数据失败!','showAllTypes',2);
            }
        }else{
            $this -> error('删除数据失败!','showAllTypes',2);
        }
    }

    public function search(){
        $upTime = $_REQUEST['upTime'];
        $downTime = $_REQUEST['downTime'];
        $keyWords = $_REQUEST['keyWords'];
        $demo = isset($keyWords)?$keyWords:$_SESSION['demo2'];
        $db = D('regulations');
        $_SESSION['demo2'] = $demo;
        $demo3 = $_SESSION['demo2'];
        $count = $db -> where("title like '%$demo3%'") -> count();
        $page = new \Think\Page($count,5);
        $show = $page -> show();
        $list = $db
            -> field('regulations.id as rid,regulations.*,types_c.*')
            -> join('types_c ON regulations.tid = types_c.id')
            -> where("title like '%$demo3%'")
            -> order('rid desc')
            -> limit($page -> firstRow.','.$page -> listRows)
            -> select();
        $this -> assign('regulations',$list);
        $this -> assign('page',$show);
        $this -> display('showAllRegulations');
    }
}