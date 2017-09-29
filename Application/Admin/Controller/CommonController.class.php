<?php
/**
 * 需要登陆的控制器继承此控制器
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class CommonController extends Controller {
    public function __construct()
    {
        parent::__construct();
        //如果未登陆，跳转至登陆页面
        if (!session('?oid')) {
            $this->redirect('/Admin/User/login', array('oid' => 0, ''), 2, '请登录...');
        } else {
            $this->assign("oid", session('oid'));
        }
    }

}