<?php
/**
 * 检查形式模型
 */
namespace Admin\Model;
use Think\Model;
class FchecksModel extends Model {
    protected $tableName = 'fchecks';

    //获取所有的检查形式，mid是实施方式代码
    public function getChecks($mid){
        $result = $this->where("mid='$mid'")->select();

        return $result;
    }

}