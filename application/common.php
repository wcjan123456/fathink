<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function staticVersion()
{
    if(\think\facade\Config::get('app_debug') === true){
        return time();
    }else{
        $version = cache('staticVersion');
        if(!$version){
            $version = strtolower( mbs(sha1(time().'duothink'),16) );
            cache('staticVersion',$version,0);
        }
        return $version;
    }

}

/**
 * 版本输出
 * @return string
 */
function dv()
{

    return '?v='.staticVersion();
}
/**
 * 面包屑导航定位
 * @param $arr
 * @param $id
 * @return array
 */
function breadcrumb($arr, $id)
{
    static $list = array();
    foreach ($arr as $v) {
        if ($v['id'] == $id) {
            breadcrumb($arr, $v['pid']);
            $list[] = $v;
        }
    }
    return $list;
}
/**
 * 获取子分类id
 * @param $data
 * @param $id
 * @return array
 */
function getChildId($data, $id)
{
    static $result = [];
    foreach ($data as $item => $value) {
        if ($value['pid'] == $id) {
            getChildId($data, $value['id']);
            $result[] = $value['id'];
        }
    }
    return $result;
}

/**
 * 返回父分类id
 * @param $class
 * @param $id
 * @return array
 */
function getParents ($class, $id) {
    $arr = array();
    foreach ($class as $v) {
        if ($v['id'] == $id) {
            $arr[] = $v;
            $arr = array_merge(getParents($class, $v['pid']), $arr);
        }
    }
    return $arr;
}
/**
 * 无限极分类
 * @param $category
 * @param int $pid
 * @return array
 */
function unlimitedForChild($category, $pid = 0)
{
    $arr = array();
    foreach ($category as $v) {
        if ($v['pid'] == $pid) {
            $v['child'] = unlimitedForChild($category, $v['id']);
            $arr[] = $v;
        }
    }
    return $arr;
}
/**
 * 无限极分类
 * @param $list
 * @param int $pid
 * @param int $level
 * @return array
 */
function unlimitedForLevel($list, $pid = 0, $level = 0)
{
    $arr = array();
    foreach ($list as $k => $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level + 1;
            $arr[] = $v;
            $arr = array_merge($arr, unlimitedForLevel($list, $v['id'], $level + 1));
        }
    }
    return $arr;
}
/**
 * 字符截取
 * @param $string
 * @param string $length
 * @return string
 */
function mbs($string,$length='40'){
    return mb_substr($string,0,$length,'UTF-8');
}
/**
 * 格式化api借口
 * @param $code
 * @param $msg
 * @param string $data
 * @return array
 */
function result($code,$msg,$data=''){
    return ['code' => $code, 'msg' => $msg, 'data' => $data, 'timestamp' => time(), 'hash' => staticVersion()];
}
/**
 * 获取用户uid
 * @param string $type
 * @return mixed
 */
function get_uid($type='admin')
{
    return session($type.'_uid');
}
/**
 * 获取用户信息
 * @param $type
 * @return mixed
 */
function get_user($type='admin'){
    return session($type.'_user');
}
/**
 * php版本
 * @return string
 */
function phpv()
{
    return 'php-' . phpversion();
}
/**
 * 检测mysql版本
 * @return mixed
 */
function sqlv()
{
    $v = cache('mysql_version');
    if(!$v){
        $system_info_mysql = \think\Db::query("select version() as v;");
        $v = $system_info_mysql['0']['v'];
        cache('mysql_version',$v,0);
    }
    return $v;
}
/**
 * 重构url
 * @param $param
 * @param integer $ext
 * @return string
 */
function reurl($param,$alias='',$ext=1)
{
    if($ext){
        $ext = '.html';
    }
    if($alias){
        $alias = $alias.'/';
    }
    return 'http://' . request()->host() . '/'. $alias. $param . $ext;
}
/**
 * 站点url
 * @return string
 */
function siteurl(){
    return 'http://' . request()->host();
}
function domain()
{
    return request()->host();
}
/**
 * 友好时间
 * @param $time
 * @return false|string
 */
function ftime($time)
{
    $now = time();
    $timec = $now - intval($time);
    //
    if ($timec > 86400) {
        return date('Y-m-d',$time);
    } else if ($timec > 3600) {
        $hours = intval($timec / (60 * 60));
        return $hours . '小时前';
    } else if ($timec > 60) {
        $mins = intval($timec / 60);
        return $mins . '分钟前';
    } else if ($timec > 5) {
        return $timec . "秒前";
    } else {
        return '刚刚';
    }
}

function guid(){
    $chars = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < 12; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash . substr(time(), -4);
}
function hashId(){
    $chars = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < 10; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return strtolower($hash);
}
function wellcome(){
    $h = date('H');
    if($h >= 0 && $h < 7){
        return '凌晨好';
    }else if($h >= 7 && $h < 12){
        return '早上好';
    }else if( $h>= 12 && $h <14){
        return '中午好';
    }else if($h >= 14 && $h< 19){
        return '下午好';
    }else{
        return '晚上好';
    }
}