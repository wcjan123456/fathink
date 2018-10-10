<?php
namespace app\api\controller;

use think\Controller;
use think\facade\Cache;

class Handle extends Controller
{
    /**
     * 清除缓存
     */
    public function clear_cache(){
        Cache::clear();
        $this->result('',200,'清除缓存成功，正在为您刷新页面！');
    }
}