<?php
/**
 * 组织模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Sjzxf\Model;
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
}