<?php
namespace app\fa\model;
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2017/10/25
 * Time: 16:24
 */

use think\Db;
use think\facade\Cache;
use think\Model;
use think\facade\Request;
use think\facade\Session;
use think\facade\Cookie;
use think\Validate;

class Member extends Model
{
    protected $ticket; // 登陆凭据
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->ticket = guid();
    }
    protected $rules =[
        'username'=>'require',
        'mobile'=>'require|mobile',
        'department_id' => 'require'
    ];
    protected $message = [
        'username.require'=>'用户名称不能为空',
        'mobile.require'=>'手机号码不能为空',
        'mobile.mobile'=>'手机号码格式不对',
        'department_id.mobile'=>'请选择部门职位'
    ];
    /**
     * 新建用户
     * @param $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function createUser($data)
    {

        //验证数据合法性质
        $validate = new Validate();
        $validate->rule($this->rules)->message($this->message);
        if(!$validate->check($data)){
            return ['code'=>403,'msg'=>$validate->getError()];
        }

        $checkUser = $this->where(['username' => $data['username'], 'mobile' => $data['mobile']])->find();
        if ($checkUser) {
            return ['code' => 403, 'msg' => '用户已经存在无法重复添加'];
        }
        $ecry = $this->encryptPassword('m' . $data['mobile']);
        $data['password'] = $ecry['password'];
        $data['hash'] = $ecry['hash'];
        //修正无注册时间和ip记录 还有登陆凭证问题
        $data['reg_time'] = time();
        $data['reg_ip'] = Request::ip();
        $data['ticket'] = $this->ticket;

        $uid = $this->insertGetId($data);
        if ($uid) {
            Cache::rm('userList');
            return ['code' => 200, 'msg' => '用户添加成功'];
        } else {
            return ['code' => 500, 'msg' => '添加失败，内部服务器错误'];
        }
    }

    /**
     * 获取所有用户列表缓存
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getUserList(){
        $data = Request::get('userList');
        if(!$data){
            $data = $this->alias('m')
                ->join('member_department d','m.department_id = d.id','LEFT')
                ->order('m.uid','desc')
                ->select();
            Cache::set('userList',$data,0);
        }
        return $data;
    }

    /**
     * 获取用户分页信息
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getUserListPage(){
        $data = $this->alias('m')
            ->join('member_department d','m.department_id = d.id','LEFT')
            ->order('m.uid','desc')
            ->paginate();
        return $data;
    }
    public function editorUser($data)
    {

    }

    public function deleteUser($uid)
    {

    }
    public function banUser($uid)
    {

    }

    /**
     * 用户登陆
     * @param $data
     * @param string $type
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function loginUser($data, $type='admin')
    {
        if(!$data['username'] || !$data['password'] || !$data['code']){
            return result(403,'用户名、密码或是验证码不能为空');
        }
        if(!captcha_check($data['code'])){
            return result(403,'验证码错误');
        }
        $user = $this->where('username', $data['username'])
            ->whereOr('mobile', $data['username'])
            ->find();
        if(!$user){
            return result(404,'用户不存在或是已经被删除');
        }
        $checkPassword = $this->decryptPassword($data['password'],$user['hash'],$user['password']);
        if(!$checkPassword){
            return result(403,'通行证密码错误，请重试');
        }
        // 更新用户登陆信息
        $userUpData = [
            'last_login_time' => time(),
            'last_login_ip'=> Request::ip(),
            'ticket'=> $this->ticket
        ];
        $upStatus = $this->where('uid',$user['uid'])->update($userUpData);
        if($upStatus){
            $user = $this->where('uid',$user['uid'])->find();

            //写入session 用户信息
            Session::set($type.'_user',$user);
            //写入单点登陆ticket
            Cookie::set('member_login_titcket',$this->ticket);
            return result(200,'登陆成功，欢迎回来',url('index/index'));
        }else{
            return result(403,'验证成功但是无法更新用户数据');
        }
    }
    /**
     * 密码加密
     * @param $str
     * @return array
     */
    public function encryptPassword($str)
    {
        $hash = self::makeAuthId();
        $password = sha1(md5(sha1($str) . $hash)); //sha1 md5 sha1 三重加密
        return ['hash' => $hash, 'password' => $password];
    }
    /**
     * 密码对比
     * @param $str string 明文密码
     * @param $hash string 加密字段
     * @param $password string 存储密码
     * @return bool
     */
    public function decryptPassword($str, $hash, $password)
    {
        $makePassword = sha1(md5(sha1($str) . $hash)); //sha1 md5 sha1 三重加密
	
        if ($makePassword === $password) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 生成唯一hash 16位
     * @return string
     */
    public function makeAuthId()
    {
        $chars = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $hash = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < 12; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash . substr(time(), -4);
    }
}