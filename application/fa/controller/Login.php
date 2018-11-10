<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/11/10
 * Time: 16:18
 */

namespace app\fa\controller;


use think\Controller;

class Login extends Controller
{
    public function account(){
        return $this->fetch('/account');
    }
}