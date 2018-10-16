<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/10/16
 * Time: 17:40
 */

namespace app\fa\model;


use think\facade\Cache;
use think\facade\Request;
use think\Model;
use think\Validate;

class QuotedProducts extends Model
{
    protected $rules=[
        'title'=>'require',
        'out_price'=>'require|number',
        'unit'=>'require'
    ];
    protected $message=[
        'title.require'=>'产品名称不能为空',
        'out_price.require'=>'售价不能为空',
        'out_price.number'=>'售价只能为数字',
        'unit.require'=>'售价只能为数字',
    ];

    /**
     * 添加报价
     * @return array
     */
    public function add(){
        $data = Request::post();
        $validate = new Validate();
        $validate->rule($this->rules)->message($this->message);
        if(!$validate->check($data)){
            return ['code'=>403,'msg'=>$validate->getError()];
        }else{
            $status = $this->insert($data);
            if($status){
                return ['code'=>200,'msg'=>'报价添加成功'];
            }else{
                return ['code'=>500,'msg'=>'添加失败，请刷新重试或是联系技术支持'];
            }
        }
    }

    /**
     * 查询分页
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getPage(){
        $title = Request::get('title','');
        if($title){
            $map[]=['title','like',"%$title%"];
        }
        $map[] = ['status','=',1];
        $data = $this->where($map)->order('pid','desc')->paginate(20);
        return $data;
    }

    /**
     * 缓存全部报价表用于筛选
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList(){
        $data = Cache::get('quotedProductsList');
        if(!$data){
            $data = $this->where('status',1)
                ->order('pid','desc')
                ->select();
            Cache::set('quotedProductsList',$data);
        }

        return $data;
    }
}