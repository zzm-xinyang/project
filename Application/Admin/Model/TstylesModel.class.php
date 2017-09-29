<?php
/**
 * 涉及类型模型
 */
namespace Admin\Model;
use Think\Model;
class TstylesModel extends Model {
    protected $tableName = 'tstyles';
    
    public function getAllStyles(){
        $result = $this->order('id')->select();
        return $result;
    }
    
    //返回数组格式
    public function getStylesName(){
        $result = $this->order('id')->getField('name',true);
        return $result;
    }
    
    public function insertStyles($name,$dicription){
        $data['name'] = $name;
        $data['decription'] = $dicription;
        $data['addtime'] = time();
        $result = $this->add($data);
        return $result;
    }
    
    public function getOneStyle($id){
        $result = $this->where("`id` = '$id'")->find();

        return $result;
    }
    
    public function updateStyles($id,$name,$dicription){
        $data['name'] = $name;
        $data['decription'] = $dicription;
        $data['addtime'] = time();
        if($this->where("`id`='$id'")->save($data)){
            return true;
        }
        else{
            echo $this->getDbError();
            return false;
        }
    }
    
    public function delStyles($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

}