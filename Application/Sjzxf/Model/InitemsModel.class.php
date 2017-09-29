<?php
namespace Sjzxf\Model;
use Think\Model;
class InitemsModel extends Model{
    protected $tableName = 'initems';

    public function getDataByOid($oid){
        $result = $this
            -> where("oid='$oid'")
            -> order('id')
            -> select();
        return $result;
    }

    public function getDataByPage($oid, $page){
        $result = $this
            -> where("oid='$oid'")
            ->page($page.',10')
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


