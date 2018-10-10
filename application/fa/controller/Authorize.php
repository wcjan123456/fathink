<?php
namespace app\fa\controller;

use app\fa\model\Authorize as auth;
use think\facade\Request;

class Authorize extends Common
{
    /**
     * 权限菜单列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index(){
        $auth = new auth();
        $list= $auth->getList();
        $this->assign('list',$list);

        return $this->fetch();
    }
    /**
     * 编辑菜单数据获取
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function ed_auth_rule()
    {
        $id = Request::param('id');
        $authRule = new auth();
        $data = $authRule->where('id',$id)->find();
        if(!$data){
            $this->error('菜单不存在或是已经被删除');
        }
        $this->assign('data',$data);

        $rules = $authRule->getList();
        $this->assign('rules',$rules);

        return $this->fetch();
    }

    /**
     * 编辑菜单保存
     * @return array
     */
    public function ed_auth_rule_action(){
        $data = Request::post();
        $authRule = new auth();
        $result = $authRule->edAuthRule($data);
        return $result;
    }

    /**
     * 添加后台菜单
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add_auth_rule()
    {
        $data = Request::post();
        $arm = new auth();
        $result = $arm->addRules($data);
        return $result;
    }

    /**
     * 设置菜单状态
     * @return array
     */
    public function set_auth_rule()
    {
        $param = Request::get();
        $authRule = new auth();
        return $authRule->setAuthRule($param);
    }

    /**
     * 删除菜单
     * @return array
     * @throws \Exception
     */
    public function del_rule()
    {
        $id = Request::get('id','','intval');
        $auth = new auth();
        $result = $auth->delAurlRule($id);
        return $result;
    }
}