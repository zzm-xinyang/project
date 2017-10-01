<?php
/**
 * 新闻模型
 * User: zhangzhimin
 * Date: 2017/9/8
 * Time: 6:46
 */
namespace Admin\Model;
use Think\Model\RelationModel;
class NewModel extends RelationModel {
    protected $tableName = 'news';

    protected $_link = array(
        'news_c'=>array(
            'mapping_type' =>  self::HAS_ONE,
            'class_name'   => 'news_c',
            'foreign_key' => 'tid',
            'relation_foreign_key' => 'id',
            'as_fields' => 'content'

        ),
    );

    public function getOne($oid,$id){
        return $this->relation(true)->where("oid=$oid")->find($id);
    }
}