<?php
/**
 * 线索来源模型
 */
namespace Admin\Model;
use Think\Model;
class FsourcesModel extends Model {
    protected $tableName = 'fsources';
    
    public function getAllSources(){
        $result = $this->select();

        return $result;
    }
    
    //返回数组格式
    public function getXsName(){
        $result = $this->order('id')->getField('name',true);

        return $result;
    }

}