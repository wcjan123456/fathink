<?php
namespace app\fa\model;

use think\facade\Config;
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

    /**
     * 查询分页列表
     * @param array $map 查询条件
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getFinancePage($map=[]){
        $map[]=['f.status','=',1];
        $subject = Request::get('subject','');
        $getInterval = Request::get('interval','');
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
            $map[]=['f.dateline','between',$startTime.','.time()];
        }
        if(!$subject){
            $map[] = ['f.title','like',"%$subject%"];
        }
        $data = $this->alias('f')
            ->join('projects p','f.pid = p.id','LEFT')
            ->join('member m','f.uid = m.uid','LEFT')
            ->field('f.id,f.pid,f.uid,f.title,f.money,f.type,f.payment_id,
            f.payee,f.dateline,f.status,p.subject,m.username')
            ->where($map)
            ->order('f.id','desc')
            ->paginate(20);

        $payment = Config::get('payment');
        foreach ($data as $item=>$value){
            $data[$item]['payment_name'] = $payment[$value['payment_id']-1]['payment_name'];
            $data[$item]['payment_icon'] = $payment[$value['payment_id']-1]['icon'];
        }
        return $data;
    }
}