<?php
namespace app\fa\model;

use think\facade\Cache;
use think\facade\Request;
use think\Model;

class MemberDepartment extends Model
{
    /**
     * 获取部门列表
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getDepartmentList(){
        $department = Cache::get('departmentList');
        if(!$department){
            $department = $this->select();
            $department = unlimitedForLevel($department);
            Cache::set('deprtmentList',$department,0);
        }
        return $department;
    }
    /**
     * 添加部门
     * @return array
     */
    public function addDepartment(){
        $data = Request::post();
        $result = $this->insert($data);
        if($result){
            Cache::rm('departmentList');
            return result(200,'部门添加成功');
        }else{
            return result(500,'部门添加失败,请重试或是联系技术支持！');
        }
    }
}