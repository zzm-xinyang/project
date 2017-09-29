<?php
/**
 * 职务模型
 * User: qiwenbin
 * Date: 2017/9/10
 * Time: 10:36
 */
namespace Admin\Model;
use Think\Model;
class QjdeptsModel extends Model {
    protected $tableName = 'qjdepts';
    //获取所有职务
    public function getAllDepts($oid){
        $result = $this->where("oid='$oid'")->select();
        return $result;
    }

}