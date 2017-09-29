<?php
/**
 * 四种形态实施方式模型
 */
namespace Admin\Model;
use Think\Model;
class FmodesModel extends Model {
    protected $tableName = 'fmodes';

    /** 新增
     * @param $tid
     * @param $mode
     * @param $dicription
     * @return mixed
     */
    public function insertFmode($tid, $mode, $dicription){
        $this->create();
        $this->tid =$tid;
        $this->mode = $mode;
        $this->dicription = $dicription;
        $this->inputtime = time();
        $result = $this->add();
        return $result;
    }

    /** 获取一种形态的所有实施方式
     * @param $code 四种形态的代码
     * @return mixed
     */
    public function getAllMode($code){
        $result = $this->field('id,tid,mode,dicription')->order('id asc')->where("`tid` = '$code'")->select();

        return $result;
    }

    /** 根据名称查询
     * @param $code 四种形态的代码
     * @param $mode 实施方式名称
     * @return mixed
     */
    public function getOneMode($code, $mode){
        $result = $this->field('id,tid,mode,dicription')->where("`tid` = '$code' and `mode` = '$mode' ")->find();

        return $result;
    }

    /** 根据ID查询
     * @param $id
     * @return mixed
     */
    public function getModeById($id){
        $result = $this->field('id,tid,mode,dicription')->where("`id` = '$id'")->find();

        return $result;
    }

    /** 更新
     * @param $id
     * @param $mode
     * @param $dicription
     * @return bool
     */
    public function updateMode($id,$mode,$dicription){
        $data['mode'] = $mode;
        $data['dicription'] = $dicription;
        $data['inputtime'] = time();
        if($this->where("`id`='$id'")->save($data)){
            return true;
        }
        else{
            echo $this->getDbError();
            return false;
        }
    }

    /** 删除
     * @param $id
     * @return mixed
     */
    public function delMode($id){
        $bool = $this->where("id='$id'")->delete();
        if(!$bool){
            $this->getDbError();
        }
        return $bool;
    }
}