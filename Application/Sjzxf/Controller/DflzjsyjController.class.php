<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");
/*党风廉政建设意见*/
class DflzjsyjController extends Controller {

    /*
 * 提意见
 * */
	public function add(){
		$data['content']=$_POST['content'];	
		$data['oid']=1;
		$data['addtime']=time();		
        $Psuggests = D('Psuggests');	
		$rid=$Psuggests->add($data);		
		if($rid){
			$this->ajaxReturn(true);
		}else{				
            $this->ajaxReturn("评价失败");
		}
	}

}