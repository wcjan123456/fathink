<?php
namespace app\fa\controller;

use think\facade\Config;
use app\fa\model\Projects;

class Finance extends Common
{
    public function index(){

        return $this->fetch();
    }

    /**
     * 新建收支记录
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function create_item(){
        $member = new \app\fa\model\Member();
        $userlist = $member->getUserList();
        $this->assign('userlist',$userlist);
        $payment = Config::get('payment');
        $this->assign('payment',$payment);

        //显示最新项目 20个简单数据 只有 id、subject
        $projects = new Projects();
        $project = $projects->getProjectsListSimple();
        $this->assign('project',$project);

        return $this->fetch();
    }

    public function wages(){
        return $this->fetch();
    }
}