<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/11/10
 * Time: 16:18
 */

namespace app\fa\controller;


use think\Controller;
use think\facade\Request;

class Login extends Controller
{
    public function account(){
        return $this->fetch('/account');
    }

    /**
     * 后台管理登陆
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login(){
        $data = Request::post();
        $member = new \app\fa\model\Member();
        $ret = $member->loginUser($data);
        return $ret;
    }
}