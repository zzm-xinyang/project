<?php
/**
 * Created by PhpStorm.
 * User: zhangzhimin
 * Date: 2017/9/17
 * Time: 17:38
 */
function action_AuthCheck($ruleName,$userId,$relation='or'){
//$relation = or|and; //默认为'or' 表示满足任一条规则即通过验证; 'and'则表示需满足所有规则才能通过验证
    $Auth = new \Think\Auth();

    if(empty($userId)){ //用户ID判断，没有就取当前登录的用户ID
        $userId = $_SESSION['userid'];
    }
    $type=1; //1为实时认证；2为登录认证。默认为:1
    $mode='url'; //执行check的模式,默认为:url

    return $Auth->check($ruleName,$userId,$type,$mode,$relation);
}

function tpl_AuthCheck($ruleName,$userId,$relation='or',$t,$f='false'){
//$relation = or|and; //默认为'or' 表示满足任一条规则即通过验证; 'and'则表示需满足所有规则才能通过验证
    $Auth = new \Think\Auth();

    if(empty($userId)){ //用户ID判断，没有就取当前登录的用户ID
        $userId = $_SESSION['userid'];
    }
    $type=1; //1为实时认证；2为登录认证。默认为:1
    $mode='url'; //执行check的模式,默认为:url

    return $Auth->check($ruleName,$userId,$type,$mode,$relation) ? $t : $f;
}
