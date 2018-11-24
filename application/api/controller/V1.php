<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/11/21
 * Time: 14:04
 */

namespace app\api\controller;


use app\fa\model\Finance;
use app\fa\model\Projects;
use think\Controller;
use think\facade\Config;

class V1 extends Controller
{
    /**
     * @throws \think\exception\DbException
     */
    public function get_finance_json(){
        $finance = new Finance();
        $data = $finance->getFinancePage([],10);
        $this->result($data,200,'request is ok','json');
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get_projects_json(){
        $project = new Projects();
        $data = $project->getProjectsList();
        $this->result($data,200,'request is success','json');
    }

    /**
     * @throws \think\exception\DbException
     */
    public function get_projects_page(){
        $project = new Projects();
        $data = $project->getProjectsPage();
        $this->result($data,200,'request is success','json');
    }
    public function get_projects_status(){
        $status = Config::get('projectStatus');
        $this->result($status,200,'request is success','json');
    }
}