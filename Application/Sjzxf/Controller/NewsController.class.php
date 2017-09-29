<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class NewsController extends Controller {
    //新闻动态
    public function newslist(){
        
        $this->display();
    } 
    //新闻内容
    public function newscontent(){
        
        $this->display();
    } 
    
}