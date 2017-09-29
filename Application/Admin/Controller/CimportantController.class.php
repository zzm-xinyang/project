<?php
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class CimportantController extends CommonController {
    public function edit(){
        $oid = I('oid');
        $mid = I('mid');

        //查找已经添加的监控重点
        $model = D('Cimportant');
        $pids = $model->where("mid=$mid and oid=$oid")->find();
        $pids = explode(',',$pids['pid']);


        //选中所有的权力监控流程
        $flowModel = D('Pflow');
        $flows=$flowModel->where("mid=$mid and oid=$oid")->select();

        foreach($flows as &$flow){//若已经选为监控重点，则为其进行标识
            if(in_array($flow['id'],$pids)){
                $flow['choise'] = 1;
            }else{
                $flow['choise'] = 0;
            }
        }
        $this->assign('oid',$oid);
        $this->assign('mid',$mid);
        $this->assign('flows',$flows);

        $this->display();
    }

    /**
     * 添加
     */
    public function update(){
        $oid = $_POST['oid'];
        $mid = $_POST['mid'];
        $model = D('Cimportant');
        $data['updatetime'] = time();

        $data['pid'] = implode(',',$_POST['pid']);

        //如果数据表中已经有相应数据，则修改，否则添加数据
        if($model->where("oid='$oid' and mid='$mid'")->find()){
            $model->where("oid='$oid' and mid='$mid'")->save($data);
        }else{
            $data['oid'] = $oid;
            $data['mid'] = $mid;
            $data['addtime'] = $data['updatetime'] = time();
            $model->add($data);
        }
        $this->redirect('Pcontrol/index',array('oid'=>$oid,'mid'=>$mid));
    }

    /**
     * 为监控重点选择模型
     */
    public function choiseModel(){
        $this->assign('iid',I('iid'));//具体监控重点id
        $this->assign('mid',I('mid')); //部门id
        $model = D('Tmodels');

        $tables = $model->field('`id`,`tname`')->order('`id` desc')->select();
        $models = array();
        foreach($tables as $table){
            $tableName = $table['tname'];
            $sql="show full fields from $tableName";
            $model = D($tableName);
            $model = $model->query($sql);
            $model['tid'] = $table['id'];//表的id
            $models[] = $model;
        }
        $this->assign('models',$models);

        $this->assign('nextNumber',count($tables)+1);

        $this->display();
        //列出当前的所有模型
        //dump($model->select());
    }

    /**
     * 选择表结构时，存储监控重点与表之间的对应关系
     */
    public function choise(){
        $data['cid'] = $_GET['iid'];
        $mid = $_GET['mid'];
        $oid = session('oid');
        $data['tid'] = $_POST['model'];

        $model = D('keymodel');
        $model->add($data);
        $tmodel = D('Tmodels')->find($data['tid']);
        dump($tmodel);

        $this->redirect('Pcontrol/index',array('tableName'=>$tmodel['tname'],'mid'=>$mid,'oid'=>$oid));
    }

    /**
     * 添加新模型
     */
    public function modelAdd(){
        //确定新数据表的表名字
        $table = 'progressing'.I('nextNumber');

        //创建一个数据表结构
        $sql = "CREATE TABLE IF NOT EXISTS `$table` (
`id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
`iid` int(11) NOT NULL COMMENT '监控重点id',
`processingtime` int(11) NOT NULL COMMENT '办理时间',
`addtime` int(11) NOT NULL COMMENT '添加时间',
`updatetime` int(11) NOT NULL COMMENT '更新时间',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权力运行情况' AUTO_INCREMENT=1 ;";
        M('', '', 'DB_CONFIG_ACTIVE')->execute($sql);//注意，这里创建表的话，第一个参数不要设置，不然会检测表信息，然表不存在，导致报错。

        //将新添加的数据表存储到tmodels数据表中
        $data['tname']=$table;
        $data['iid'] = I('iid');
        $data['addtime'] = time();

        $model = D('Tmodels');
        $model->add($data);

        //将模型与监控重点对应表添加到keyModel
        $keymodel = D('Keymodel');
        $key['cid'] = $data['iid'];
        $key['tid'] = $model->getLastInsID();
        $keymodel->add($key);
        echo $keymodel->getLastSql();
        $this->redirect('newModel',array('tableName'=>$table));

    }


    /**
     * 显示新添加的模型
     */
    public function newModel(){
        $tableName = I('tableName');
        $sql="show full fields from $tableName";
        $model = D($tableName);
        $this->assign('tableName',$tableName);
        $this->assign('table',$model->query($sql));

        $this->display();
    }

    /**
     * 添加列
     */
    public function colsAdd(){
        $this->assign('tableName',I('tableName'));
        $this->display();
    }

    public function colsSave(){
        $tableName = $_POST['tableName'];
        $type = $_POST['type'];
        $colname = $_POST['colname'];
        $comment = $_POST['comment'];
        $sql="alter table `$tableName`  
Add column `$colname` $type  not null COMMENT '$comment'";
        $model = D($tableName);
        $model->execute($sql);
        $this->redirect('newModel',array('tableName'=>$tableName));
    }

    /*修改别结构*/
    public function editModel(){
        $tableName = I('tableName');

        $sql="show full fields from $tableName";
        $model = D($tableName);
        $this->assign('tableName',$tableName);
        $this->assign('table',$model->query($sql));

        $this->display();

    }


}