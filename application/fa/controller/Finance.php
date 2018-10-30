<?php
namespace app\fa\controller;

use think\facade\Config;
use app\fa\model\Projects;
use think\facade\Request;

class Finance extends Common
{
    /**
     * 分页列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index(){

        $fina = new \app\fa\model\Finance();
        $data = $fina->getFinancePage();
        $this->assign('list',$data);

        return $this->fetch();
    }

    /**
     * 新建收支记录
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function create_item(){
        if(Request::isAjax()){
            $finance=  new \app\fa\model\Finance();
            $result = $finance->createItem();
            return $result;
        }
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