<?php
namespace Sjzxf\Model;
use Think\Model;
class PbresultModel extends Model{
    protected $tableName = 'pbuildsresult';

    public function getXtTj($begintime,$endtime){
        $condition['addtime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        $result = $this->field('result,count(*) as total')->where($condition)->group('result')->select();
        return $result;
    }
}


