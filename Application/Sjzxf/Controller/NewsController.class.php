<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class NewsController extends Controller {
	public function _initialize()
    {
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));
    }
    //新闻动态
    public function newslist(){
    	//获取组织id
    	$oname="SJZXF";
    	$oid = C($oname.'.OID');    
    	  
        $this->display();
    } 
    //新闻内容
    public function newscontent(){
        
        $this->display();
    } 
    
}