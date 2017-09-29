<?php
/**
 * 涉及类型模型
 */
namespace Admin\Model;
use Think\Model;
class TcontentsModel extends Model {
    protected $tableName = 'tcontents';
    
    public function getAllContents(){
        $result = $this->select();
        return $result;
    }
    
    //返回数组格式
    public function getContentsName(){
        $result = $this->order('id')->getField('content',true);
        return $result;
    }
    
    public function insertContents($sid,$oid,$content){
        $data['sid'] = $sid;
        $data['oid'] = $oid;
        $data['content'] = $content;
        $data['inputtime'] = time();
        $data['updatetime'] = $data['inputtime'];
        $result = $this->add($data);
        return $result;
    }
    
    public function getOneContent($id){
        $result = $this->where("`id` = '$id'")->find();

        return $result;
    }

    public function getContents($sid,$oid){
        $result = $this->field('name, content')->join('tstyles on tstyles.id = tcontents.sid', 'left')->where("`sid` = '$sid' and `oid` = '$oid'")->order("updatetime")->select();
        return $result;
    }

    public function getContentsByOid($oid){
        $result = $this->field('tcontents.id as id,name, content')->join('tstyles on tstyles.id = tcontents.sid', 'left')->where("`oid` = '$oid'")->order("sid,updatetime")->select();
        return $result;
    }
    
    public function updateContents($id,$sid,$content){
        $data['sid'] = $sid;
        $data['content'] = $content;
        $data['updatetime'] = time();
        if($this->where("`id`='$id'")->save($data)){
            return true;
        }
        else{
            echo $this->getDbError();
            return false;
        }
    }
    
    public function delContents($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

}