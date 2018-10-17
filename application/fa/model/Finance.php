<?php
namespace app\fa\model;

use think\facade\Request;
use think\Model;
use think\Validate;

class Finance extends Model
{
    protected $rules=[
        'title'=>'require',
        'pid'=>'require',
        'money'=>'require'
    ];
    protected $message =[
        'title.require'=>'用途描述不能为空',
        'pid.require'=>'项目不能为空，请选择',
        'money.require'=>'收支金额不能为空'
    ];

    /**
     * 新增收支记录
     * @return array
     */
    public function createItem(){
        $data = Request::post();
        $data['dateline'] = time();
        $validate = new Validate();
        $validate->rule($this->rules)->message($this->message);
        if(!$validate->check($data)){
            return result(403,$validate->getError());
        }else{
            $result = $this->insert($data);
            if($result){
                return result(200,'记录添加成功',url('index'));
            }else{
                return result(500,'添加失败，请刷新重试或是联系技术支持');
            }
        }
    }
}