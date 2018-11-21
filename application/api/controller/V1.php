<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/11/21
 * Time: 14:04
 */

namespace app\api\controller;


use app\fa\model\Finance;
use think\Controller;

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
}