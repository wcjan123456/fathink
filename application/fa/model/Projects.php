<?php
namespace app\fa\model;

use think\facade\Cache;
use think\facade\Request;
use think\Model;
use think\Validate;

class Projects extends Model
{
    protected $rules=[
        'subject'=>'require',
        'customer'=>'require',
        'customer_pm'=>'require',
    ];
    protected $message =[
        'subject.require'=>'项目名称不能空',
        'customer.require'=>'客户名称不能为空',
        'customer_pm.require'=>'客户负责人不能为空',
    ];
    public function getProject($projectId){
        
    }
    public function getProjectsPage(){
        return [];
    }
    public function getProjectsList(){

        return [];
    }

    /**
     * 获取简单的项目列表
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getProjectsListSimple(){
        $data = Cache::get('ProjectsListSimple');
        if(!$data) {
            $data = $this->field('id,subject')->order('id', 'desc')->limit(20)->select();
            Cache::set('ProjectsListSimple',$data,0);
        }
        return $data;
    }

    /**
     * 添加项目
     */
    public function createProject(){
        $data = Request::post();
        $validate = new Validate();
        $validate->rule($this->rules)->message($this->message);
        if(!$validate->check($data)){
            return result(403,$validate->getError());
        }
        $data = $this->completeData($data);
        $result = $this->insert($data);
        if($result){
            Cache::rm('ProjectsListSimple');
            return result(200,'项目添加成功，正在为您返回列表页面',url('projects/index'));
        }else{
            return result(500,'项目添加失败，请刷新重试或是联系技术支持');
        }

    }

    /**
     * 重新组合项目字段存储
     * @param $data
     * @return mixed
     */
    private function completeData($data){
        $data['message'] = htmlentities($data['message']);
        $data['dateline'] = strtotime($data['dateline']);
        $data['end_time'] = strtotime($data['end_time']);
        $data['hash'] = guid();
        return $data;
    }
}