<?php
namespace Sjzxf\Model;
use Think\Model;
class RegulationsModel extends Model{
    protected $tableName = 'regulations';

    public function showAll($page){
        $regulations = $this
            -> field('regulations.id as rid,regulations.*,types_c.*')
            -> join('types_c ON regulations.tid = types_c.id')
            -> limit($page->firstRow.','.$page -> listRows)
            -> select();
        return $regulations;
    }

    public function page(){
        $count = $this -> count();
        $page = new \Think\Page($count,10);
        return $page;
    }
}
