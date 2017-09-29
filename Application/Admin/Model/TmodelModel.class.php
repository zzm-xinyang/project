<?php
/**
 * 党委主要负责人责任
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class TmodelModel extends Model {
    protected $tableName = 'tmodels';

    public function check($id){
        $data = $this->where("id=$id")->find();
        if($data){
            return $data['tname'];
        }else{
            return false;
        }
    }
}