<?php
/**
 * 评价对象模型
 */
namespace Admin\Model;
use Think\Model;
class TobjectsModel extends Model {
    protected $tableName = 'tobjects';
    
    public function getAllObjects(){
        $result = $this->select();
        return $result;
    }

    public function insertoObjects($oid,$did,$name,$dutyid){
        $data['did'] = $did;
        $data['oid'] = $oid;
        $data['name'] = $name;
        $data['dutyid'] = $dutyid;
        $data['addtime'] = time();
        $data['updatetime'] = $data['addtime'];
        $result = $this->add($data);
        return $result;
    }
    
    public function getOneObject($id){
        $result = $this->where("`id` = '$id'")->find();
        return $result;
    }

    public function getObjects($oid,$did){
        $result = $this->field('tobjects.id as id, name, duty')->join('dutys on dutys.id = tobjects.dutyid', 'left')->where("`did` = '$did' and `oid` = '$oid'")->order("updatetime")->select();
        return $result;
    }

    public function getObjectId($oid,$duty,$name){
        $result = $this->field('tobjects.id as id')->join('dutys on dutys.id = tobjects.dutyid', 'left')->join('qjdepts on qjdepts.id = tobjects.did', 'left')->where("`oid` = '$oid' and `duty` = '$duty' and `qjdepts.name` = '$name'")->find();
        return $result;
    }

    public function getObjectsByOid($oid){
        $result = $this->field('name, duty')->join('dutys on dutys.id = tobjects.dutyid', 'left')->where("`oid` = '$oid'")->order("updatetime")->select();
        return $result;
    }
    
    public function updateObjects($id,$did,$name,$dutyid){
        $data['did'] = $did;
        $data['name'] = $name;
        $data['dutyid'] = $dutyid;
        $data['updatetime'] = time();
        if($this->where("`id`='$id'")->save($data)){
            return true;
        }
        else{
            echo $this->getDbError();
            return false;
        }
    }
    
    public function delObjects($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

}