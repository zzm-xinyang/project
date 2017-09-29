<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class JwsjController extends Controller {
	public function _initialize()
    {
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));

    }
  public function jwsj_zzd(){
    $this->display();
  }
}