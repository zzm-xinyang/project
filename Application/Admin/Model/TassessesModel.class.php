<?php
/**
 * 作风评价模型
 */
namespace Admin\Model;
use Think\Model;
class TassessesModel extends Model {
    protected $tableName = 'tassesses';
    
    public function getPerGroupNum($pid){
        $result = $this->field('cid, assess, count(id) as num')->where("`pid` = '$pid'")->group('cid,assess')->order('cid,assess')->select();
        return $result;
    }

    public function getGroupNum($pid){
        $result = $this->field('distinct(cid)')->where("`pid` = '$pid'")->group('cid')->order('cid')->count();
        return $result;
    }

    public function getNum($pid, $type){
        $result = $this->field('cid, count(id) as num')->where("`pid` = '$pid' and `assess` = '$type'")->group('cid')->order('cid')->select();
        return $result;
    }

    public function getGroupName($pid){
        $result = $this->field('distinct(cid), tstyles.name as name')->join('tcontents on tcontents.id = tassesses.cid', 'left')->join('tstyles on tstyles.id = tcontents.sid', 'left')->where("`pid` = '$pid'")->group('cid')->order('cid')->select();
        return $result;
    }
}