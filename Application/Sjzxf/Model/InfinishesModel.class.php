<?php
namespace Sjzxf\Model;
use Think\Model;
class InfinishesModel extends Model{
    protected $tableName = 'infinishes';

    public function getDataByInid($inid){
        $result = $this
            -> where("inid='$inid'")
            -> order('id')
            -> select();
        return $result;
    }
}


