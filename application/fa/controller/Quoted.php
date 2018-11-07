<?php
namespace app\fa\controller;


use app\fa\model\QuotedProducts;
use think\facade\Request;

class Quoted extends Common
{

    public function index(){


        return $this->fetch();
    }

    /**
     * 新建报价单
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function create_item()
    {
        if(Request::isAjax()){
            return true;
        }else{
            $member = new \app\fa\model\Member();
            $userList = $member->getUserList();
            $this->assign('userlist',$userList);
            return $this->fetch();
        }
    }

    /**
     * 产品报价首页
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function products()
    {
        $quotedProducts = new QuotedProducts();
        $list = $quotedProducts->getPage();
        $this->assign('list',$list);

        return $this->fetch();
    }

    /**
     * 添加产品报价
     * @return array
     */
    public function add_products(){
        $qp = new QuotedProducts();
        $result = $qp->add();
        return $result;
    }
}