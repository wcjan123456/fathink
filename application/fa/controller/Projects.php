<?php
namespace app\fa\controller;

use think\facade\Request;

class Projects extends Common
{
    public function index(){
        return $this->fetch();
    }

    /**
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function create_item(){
        $date = date('Y-m-d H:i:s' , strtotime("+7 day"));
        $this->assign('date',$date);

        $member = new \app\fa\model\Member();
        $userlist = $member->getUserList();
        $this->assign('userlist',$userlist);

        //添加数据操作 ajax 添加数据
        if(Request::isAjax()){
            $project = new \app\fa\model\Projects();
            $result = $project->createProject();
            return $result;
        }
        return $this->fetch();
    }
    public function details(){
        return $this->fetch();
    }
    public function report(){
        return $this->fetch();
    }
}