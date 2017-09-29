<?php
/**
 * 用户管理
 */
namespace Admin\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
class UserController extends Controller {
    /**
     * 用户管理列表
     */
    public function index(){

        if (isset($_COOKIE['username'])){
            $username = $_COOKIE['username'];
            $User = D('User');
            $user = $User->where("account='$username'")->find();
            if($user) {
                session('oid', $user['oid']);
                $this->assign('oid',session('oid'));
            }
        }
        $oid = session('oid');


        if(!session('?oid')){
            $this->redirect('/Admin/User/login', array('oid' => 0,''), 0.5, '请登录11...');
        }
        $oid = session('oid');
        $model = D('User');
        $users = $model->field('`auth_group`.`title`,`organizes`.`organize`,`users`.*')->join('auth_group ON auth_group.id=users.roleid')->where("`users`.oid=$oid")->join('organizes ON organizes.id=users.oid')->select();
        $this->assign('users',$users);
        $this->display();
    }

    /**
     * 登录
     */
    public function login(){

        if (isset($_COOKIE['username'])){
            $username = $_COOKIE['username'];
            $User = D('User');
            $user = $User->where("account='$username'")->find();
            if($user) {
                session('oid', $user['oid']);
                session('username', $user['account']);
                session('rid',$user['roleid']);//角色
                $this->redirect('/Admin');
            }
        }else {
            if (I('oid') === '0') {
                $this->display();
            } else {
                $User = D('User');
                //先判断验证码是否正确
                $verify = new \Think\Verify();
                if (!$verify->check($_POST['verify'])) {
                    $this->redirect('/Admin/User/login', array('oid' => 0), 1, '验证码错误...');
                }
                $username = $_POST['account'];
                $password = md5($_POST['password']);
                $user = $User->where("account='$username' and password='$password'")->find();
                if ($user) {
                    session('oid', I('oid'));
                    session('username', $user['account']);
                    session('rid',$user['roleid']);//角色
                    if (I("online")){
                        setcookie('username',$username,time()+3600*24*7);
                    }
                    $this->redirect('/Admin');

                } else {
                    $this->redirect('login', array('oid' => 0), 1, '用户名或密码错误...');
                }
            }
        }
    }

    /**
     * 注销用户
     */
    public function logout(){
        session(null);
        setcookie('username',null);
        $this->redirect('login', array('oid' => 0), 0.5, '请登录...');
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

    /**
     * 显示添加用户界面
     */
    public function add(){
        $oid = I('oid');
        $this->assign('oid', $oid);
        $this->assign('roleid',session('rid'));

        //如果是超级管理员，可以添加任意部门的管理员
        //如果是支队管理员，只能添加自己支队的管理员

        //获取部门
        $organize = D('Organize');

        if(session('rid')==1){
            $this->assign('organizes',$organize->getAll());
        }else{
            $this->assign('organizes',$organize->getOne($oid));
        }

        //获取角色
        $groupModel = D('Group');
        $this->assign('groups',$groupModel->getGroupByRole($oid));

        $this->display();
    }

    public function save(){
        $data=array();
        $model = D('user');
        $data['oid'] = $_POST['oid'];
        $data['roleid'] = $_POST['roleid'];
        $data['account'] = $_POST['account'];
        $data['password'] = md5('123456');
        $data['phone'] = $_POST['phone'];
        $data['email'] = $_POST['email'];
        $data['addtime'] = $data['updatetime'] = time();

        if($model->add($data)){
            $this -> success('添加成功',U('index',array('oid'=>$data['oid'])),2);
        }
    }
}