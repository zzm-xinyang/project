<?php
namespace Sjzxf\Model;
use Think\Model;
class InlistsModel extends Model{
    protected $tableName = 'inlists';

    public function getDataByOid($oid){
        $result = $this
            -> where("oid='$oid'")
            -> order('id')
            -> select();
        return $result;
    }

    public function getDataByItem($oid, $item){
        $result = $this
            -> where("oid='$oid' and item='$item'")
            -> order('id')
            -> find();
        return $result;
    }

}


