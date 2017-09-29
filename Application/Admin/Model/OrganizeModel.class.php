<?php
/**
 * 组织模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model;
class OrganizeModel extends Model {
    protected $tableName = 'organizes';

    /**
     * 根据组织ID，返回组织名
     */
    public function getOrganize($id){
        $organize=$this->find($id);
        return $organize['organize'];
    }

    //返回一个组织的信息
    public function getOne($id){
        $organizes = array();
        $organize = $this->field('`id`,`organize`')->find($id);
        $organizes[] = $organize;
        return $organizes;
    }

    /**
     * 返回所有的部门，只获取id和部门名称
     */
    public function getAll(){
        return $this->field('`id`,`organize`')->order('id asc')->select();
    }
}