<?php
/**
 * 监控重点对应表
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class KeyModel extends Model {
    protected $tableName = 'keymodel';

    public function check($id){
        dump(11);
        $data = $this->where("cid=$id")->find();
        return $data;
    }
}