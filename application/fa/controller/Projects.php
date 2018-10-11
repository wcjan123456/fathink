<?php
namespace app\fa\controller;

use think\facade\Config;
use think\facade\Request;

class Projects extends Common
{
    /**
     * 项目 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index(){
        $projectModel = new \app\fa\model\Projects();

        //读取配置文件项目状态
        $projectStatus = Config::get('projectStatus');
        $this->assign('status',$projectStatus);

        //项目状态和紧急程度配置输出
        $status = $projectModel->projectStatus;
        $level = $projectModel->projectLevel;
        $this->assign('status',$status);
        $this->assign('level',$level);

        $getStatus = Request::get('status','','intval');
        $getInterval = Request::get('interval','','intval');
        $subject = Request::get('subject','','htmlentities');
        $this->assign('getStatus',$getStatus);
        $this->assign('interval',$getInterval);
        $map=[];
        if ($subject){
            $map[]=['p.subject','like',"%$subject%"];
        }
        if($getStatus){
            $map[]=['p.status','=',$getStatus];
        }
        if($getInterval){
            switch ($getInterval){
                case 1:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-30 day")));
                    break;
                case 3:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-3 months")));
                    break;
                case 6:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-6 months")));
                    break;
                case 12:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-1 year")));
                    break;
                case 36:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-3 year")));
                    break;
                default:
                    $startTime = strtotime(date('Y-m-d 00:00:00' , strtotime("-30 day")));

            }
            $map[]=['p.dateline','between',$startTime.','.time()];
        }
        $list = $projectModel->getProjectsPage($map);

        $this->assign('list',$list);


        return $this->fetch();
    }

    /**
     * 添加项目
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function create_item(){
        //添加数据操作 ajax 添加数据
        if(Request::isAjax()){
            $project = new \app\fa\model\Projects();
            $result = $project->createProject();
            return $result;
        }else{
            $date = date('Y-m-d H:i:s' , strtotime("+7 day"));
            $this->assign('date',$date);

            $member = new \app\fa\model\Member();
            $userList = $member->getUserList();
            $this->assign('userlist',$userList);

            //读取配置文件项目状态
            $projectStatus = Config::get('projectStatus');
            $this->assign('status',$projectStatus);

            return $this->fetch();
        }
    }
    public function details(){
        return $this->fetch();
    }
    public function report(){
        return $this->fetch();
    }
}