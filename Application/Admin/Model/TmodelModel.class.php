<?php
namespace Admin\Model;
use Think\Model;
class TmodelModel extends Model{
    protected $tableName = 'tmodels';

    /**
     * 根据id返回表名
     */
    public function getTName($id){
        $data = $this->where("iid=$id")->find();
        return $data['tname'];

    }
}
