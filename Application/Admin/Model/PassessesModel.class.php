<?php
/**
 *      权力运行监控评价模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class PassessesModel extends Model {
    protected $tableName = 'passesses';

    public function countNum($oid,$assess,$mid){

        return $this->where("oid=$oid and assess=$assess and mid=$mid")->count();
        return $this->getLastSql();

    }
}