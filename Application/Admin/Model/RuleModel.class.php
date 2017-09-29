<?php
/**
 * 角色模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class RuleModel extends Model {
    protected $tableName = 'auth_rule';

    /**
     * 取出指定pid的数据
     */
    public function getChildren($pid){
        $data = $this->where('pid=%d',$pid)->select();
        return $data;
    }


    /**
     * 返回id和name
     */
    public function getRole($id){
        $data = $this->where("id=$id")->find();
        if($data){
            return $data;
        }
    }

    /**
     * 找pid
     */
    public function getParent($id){
        $data = $this->where('id=%d',$id)->find();
        return $data['pid'];
    }
}