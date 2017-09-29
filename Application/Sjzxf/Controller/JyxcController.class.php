<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class JyxcController extends Controller {

    public function index(){       
            $this->display();
    } 
/*
 * 正常评价
 * */
	public function add(){		
		//先判断验证码是否正确
        $verify = new \Think\Verify();
        if (!$verify->check($_POST['verify'])) {
            $this->ajaxReturn('验证码错误');
        }
		$data['name']=$_POST['name'];		
		$data['phone'] = $_POST['phone'];
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['oid']=1;
		$data['adviceTime']=time();		
        $advicesModel = D('Advices');	
		$rid=$advicesModel->add($data);		
		if($rid){
            $this->ajaxReturn(true);
		}else{				
            $this->ajaxReturn('失败');
		}
	}
	/**
     * 验证码
     */
    public function verify(){
        ob_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->entry();
    }
	/**
     * 检测验证码是否正确
     * @param $code
     * @return bool
     */
    function check_verify($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }
}