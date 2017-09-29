<?php
/**
 * 问责模型
 */
namespace Admin\Model;
use Think\Model;
class FcontentsModel extends Model {
    protected $tableName = 'fcontents';

    /**新增
     * @param $mid
     * @param $name1
     * @param $duty1
     * @param $unit1
     * @param $name2
     * @param $unit2
     * @param $duty2
     * @param $solvetime
     * @param $modalities
     * @param $venue
     * @param $participant
     * @param $attendings
     * @param $department
     * @param $summary
     * @param $tid
     * @param $sid
     * @param $status
     * @param $oid
     * @return mixed
     */
    public function insertContent($mid, $name1,  $duty1, $unit1, $name2, $unit2, $duty2,
                                $solvetime, $modalities, $venue, $participant, $attendings,
                                $department, $summary, $tid, $sid, $status, $oid){
        $this->create();
        $this->mid =$mid;
        $this->name1 =$name1;
        $this->duty1 =$duty1;
        $this->unit1 =$unit1;
        $this->name2 =$name2;
        $this->unit2 =$unit2;
        $this->duty2 =$duty2;
        $this->solvetime =$solvetime;
        $this->modalities =$modalities;
        $this->venue =$venue;
        $this->participant =$participant;
        $this->attendings =$attendings;
        $this->department =$department;
        $this->summary =$summary;
        $this->tid =$tid;
        $this->sid =$sid;
        $this->status =$status;
        $this->oid =$oid;
        $this->inputtime = time();
        $result = $this->add();
        return $result;
    }

    /**查询
     * @param $p 分页页码，0表示获取记录数
     * @param $status
     * @param $mid
     * @param $oid
     * @param $tid
     * @param $sid
     * @param $begintime
     * @param $endtime
     * @return mixed
     */
    public function getContents($p,$status,$mid,$oid,$tid,$sid,$begintime,$endtime){
        if($tid != "0" && $tid != ""){
            $condition['tid'] = $tid;
        }
        if($sid != "0" && $sid != ""){
            $condition['sid'] = $sid;
        }
        if($begintime != "" && $endtime != "" ){
            $condition['solvetime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        }
        $condition['status'] = $status;
        $condition['fcontents.mid'] = $mid;
        $condition['oid'] = $oid;

        if($p == "0"){
            $result = $this ->field('fcontents.id as id, name1, dy1.duty as duty1, unit1, name2, unit2, dy2.duty as duty2,
                                solvetime, fchecks.name as jcxs, venue, participant, attendings,
                                department, summary, ftypes.name  as tname, fsources.name as sname')
                ->join('dutys as dy1 on dy1.id = fcontents.duty1', 'left')
                ->join('dutys as dy2 on dy2.id = fcontents.duty2', 'left')
                ->join('fchecks on fchecks.id = fcontents.modalities', 'left')
                ->join('ftypes on ftypes.id = fcontents.tid', 'left')
                ->join('fsources on fsources.id = fcontents.sid', 'left')
                ->order('fcontents.id asc')->where($condition)->count();
        }else{
            $result = $this ->field('fcontents.id as id, name1, dy1.duty as duty1, unit1, name2, unit2, dy2.duty as duty2,
                                solvetime, fchecks.name as jcxs, venue, participant, attendings,
                                department, summary, ftypes.name  as tname, fsources.name as sname')
                ->join('dutys as dy1 on dy1.id = fcontents.duty1', 'left')
                ->join('dutys as dy2 on dy2.id = fcontents.duty2', 'left')
                ->join('fchecks on fchecks.id = fcontents.modalities', 'left')
                ->join('ftypes on ftypes.id = fcontents.tid', 'left')
                ->join('fsources on fsources.id = fcontents.sid', 'left')
                ->order('fcontents.id asc')->where($condition)->page($p.',10')->select();
        }
        return $result;
    }

    /**获取具体的一条问责，编辑用
     * @param $id 记录ID
     * @return mixed
     */
    public function getOneContent($id){
        $result = $this->where("`id`='$id'")->find();
        return $result;
    }
    
    /**
    * 四种形态统计
    */
    public function getXtTj($begintime,$endtime){
    		$condition['inputtime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        $result = $this->field('status,count(*) as total')->where($condition)->group('status')->select();
        return $result;
    }
    
    /**
    * 涉及类型统计
    */
    public function getLxTj($begintime,$endtime){
    	$condition['fcontents.inputtime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        $result = $this->field('tid,ftypes.name,count(*) as total')->join('ftypes on ftypes.id = fcontents.tid', 'left')->where($condition)->group('tid')->select();
        return $result;
    }
    
    /**
    * 线索来源统计
    */
    public function getXsTj($begintime,$endtime){
    		$condition['fcontents.inputtime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        $result = $this->field('sid,fsources.name,count(*) as total')->join('fsources on fsources.id = fcontents.sid', 'left')->where($condition)->group('sid')->select();
        return $result;
    }

    /** 更新
     * @param $id
     * @param $mid
     * @param $name1
     * @param $duty1
     * @param $unit1
     * @param $name2
     * @param $unit2
     * @param $duty2
     * @param $solvetime
     * @param $modalities
     * @param $venue
     * @param $participant
     * @param $attendings
     * @param $department
     * @param $summary
     * @param $tid
     * @param $sid
     * @return bool
     */
    public function updateContent($id,$mid, $name1,  $duty1, $unit1, $name2, $unit2, $duty2,
                               $solvetime, $modalities, $venue, $participant, $attendings,
                               $department, $summary, $tid, $sid){

        $data['name1'] =$name1;
        $data['duty1'] =$duty1;
        $data['unit1'] =$unit1;
        $data['name2'] =$name2;
        $data['unit2'] =$unit2;
        $data['duty2'] =$duty2;
        $data['solvetime'] =$solvetime;
        $data['modalities'] =$modalities;
        $data['venue'] =$venue;
        $data['participant'] =$participant;
        $data['attendings'] =$attendings;
        $data['department'] =$department;
        $data['summary'] =$summary;
        $data['tid'] =$tid;
        $data['sid'] =$sid;
        $data['inputtime'] = time();
        if($this->where("`id`='$id' and `mid`='$mid'")->save($data)){
            return true;
        }
        else{
            echo $this->getDbError();
            return false;
        }
    }

    /** 删除
     * @param $id 记录ID
     * @return mixed
     */
    public function delContent($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

    // 批量删除
    public function delBatchContent($ids){
        $bool = $this->delete($ids);
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }
}