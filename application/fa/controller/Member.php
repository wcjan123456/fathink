<?php
namespace app\fa\controller;

use app\fa\model\MemberDepartment;
use think\facade\Request;

class Member extends Common
{
    /**
     * 员工列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index(){
        $department = new MemberDepartment();
        $depart = $department->getDepartmentList();
        $this->assign('department',$depart);

        $member = new \app\fa\model\Member();
        $list = $member->getUserList();
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * 创建用户
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function create_user(){
        $data = Request::post();
        $member = new \app\fa\model\Member();
        $result =$member->createUser($data);
        return $result;
    }

    /**
     * 部门列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function department(){
        $department = new MemberDepartment();
        $list = $department->getDepartmentList();
        $this->assign('list',$list);

        return $this->fetch();

    }

    /**
     * 添加部门
     */
    public function add_department(){
        $department = new MemberDepartment();
        $result = $department->addDepartment();
        return $result;
    }
}