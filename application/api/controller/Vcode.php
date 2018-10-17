<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/2/23
 * Time: 11:59
 */

namespace app\api\controller;

use think\captcha\Captcha;
use think\facade\Request;

class Vcode
{
    public function index()
    {
        $size = Request::param();
        !isset($size['w']) ? $width ='' : $width = $size['w'];
        !isset($size['h']) ? $height ='' : $height = $size['h'];
        !isset($size['s']) ? $fsize ='' : $fsize = $size['s'];

        $config =    [
            // 验证码字体大小
            'fontSize'    =>    $fsize,
            // 验证码位数
            'length'      =>    4,
            // 关闭验证码杂点
            'useNoise'    =>    true,
            'imageH' => $height,
            'imageW' => $width
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
}