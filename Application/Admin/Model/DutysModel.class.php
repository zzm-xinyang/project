<?php
/**
 * 职务模型
 * User: qiwenbin
 * Date: 2017/9/10
 * Time: 10:36
 */
namespace Admin\Model;
use Think\Model;
class DutysModel extends Model {
    protected $tableName = 'dutys';
    //获取所有职务
    public function getAllDutys(){
        $result = $this->order('orders asc')->select();

        return $result;
    }

}