<?php
/**
 * 涉及类型模型
 */
namespace Admin\Model;
use Think\Model;
class FtypesModel extends Model {
    protected $tableName = 'ftypes';
    
    public function getAllTypes(){
        $result = $this->select();
        return $result;
    }
    
    //返回数组格式
    public function getTypesName(){
        $result = $this->order('id')->getField('name',true);
        return $result;
    }

}