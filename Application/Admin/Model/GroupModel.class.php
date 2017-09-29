<?php
/**
 * 职务模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class GroupModel extends Model {
    protected $tableName = 'auth_group';

    public function getRoleName($id){
        $data = $this->where("id=$id")->find();
        if($data){
            return $data['title'];
        }
    }

    /**
     * 根据组织id获取角色
     */
    public function getGroupByRole($oid){
        $data = $this->where('oid=%d',$oid)->select();
        return $data;

    }

}