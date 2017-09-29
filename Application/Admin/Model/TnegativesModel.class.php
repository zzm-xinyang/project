<?php
/**
 * 官兵监督模型
 */
namespace Admin\Model;
use Think\Model;
class TnegativesModel extends Model {
    protected $tableName = 'tnegatives';
    
    public function getNegatives($page, $oid, $begintime, $endtime, $kword){

        if($begintime != "" && $endtime != "" ){
            $condition['evaluatetime'] = array(array('EGT', $begintime), array('ELT', $endtime));
        }
        if($kword != ""){
            $condition['name|number|phone|content|department|oname|duty']=array('like','%$kword%');;
        }
        $condition['tnegatives.oid'] = $oid;
        if($page == "0"){
            $result = $this->field('tnegatives.id as id, evaluatetime, tnegatives.name as jname, number, phone, content, qjdepts.name as dname,
                                oname, dutys.duty as dduty')
                ->join('qjdepts on qjdepts.id = tnegatives.department', 'left')
                ->join('dutys on dutys.id = tnegatives.duty', 'left')
                ->order('evaluatetime desc')->where($condition)->count();
        }else{
            $result = $this->field('tnegatives.id as id, evaluatetime, tnegatives.name as jname, number, phone, content, qjdepts.name as dname,
                                oname, dutys.duty as dduty')
                ->join('qjdepts on qjdepts.id = tnegatives.department', 'left')
                ->join('dutys on dutys.id = tnegatives.duty', 'left')
                ->order('evaluatetime desc')->where($condition)->select();
        }
        return $result;
    }

    /** 删除
     * @param $id 记录ID
     * @return mixed
     */
    public function delNegative($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

    // 批量删除
    public function delBatchNegative($ids){
        $bool = $this->delete($ids);
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }

}