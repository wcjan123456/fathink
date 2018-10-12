<?php
namespace app\fa\model;

use think\facade\Cache;
use think\facade\Request;
use think\Model;

class Authorize extends Model
{
    public $result;

    /**
     * 获取全部权限列表
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function dataList(){
        $this->result = Cache::get('authorize');
        if(!$this->result){
            $this->result = $this->order('order','desc')->select();
            Cache::set('authorize',$this->result,0);
        }
        return $this->result;
    }

    /**
     * 数据获取接口
     * @param int $type
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($type=1){
        switch ($type){
            case 1:
                $this->result =  unlimitedForLevel($this->dataList());
                break;
            case 2:
                $this->result = unlimitedForChild($this->dataList());
                break;
            case 3:
                $this->result = $this->where(['pid'=>0,'display'=>1])
                    ->order('order','desc')
                    ->select();
                break;
            default:
                return $this->dataList();
        }
        return $this->result;
    }

    /**
     * 获取子菜单数据
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSubMenus(){
        $path = strtolower(Request::module().'/'.Request::controller());
        $data = $this->dataList();
        $topMenu =[];
        foreach ($data as $item=>$value){
            if($value['name'] == $path){
                $topMenu = $value;
            }
        }

        $subMenus = [];
        if(!$topMenu){
            return false;
        }
        foreach ($data as $item=>$value){
            if($value['pid'] == $topMenu['id']){
                $subMenus[]= $value;
            }
        };
        return [$topMenu,$subMenus];
    }

    /**
     * 常用菜单
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCommonMenus(){
        $this->result = Cache::get('commonMenus');
        if(!$this->result){
            $this->result = $this->where(['display'=>1,'status'=>1,'is_common'=>1])
                ->order('order','desc')->select();
            Cache::set('commonMenus',$this->result);
        }
        return $this->result;
    }
    /**
     * 添加控制菜单
     * @param array $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addRules($data = [])
    {
        //验证name是否重复
        $repeat = $this->where(['title' => $data['title'], 'name' => $data['name']])->find();
        if ($repeat) {
            return ['code' => 500, 'msg' => '菜单重复请检查重试'];
        }
        if (!$data['name'] || !$data['title']) {
            return ['code' => 403, 'msg' => '名称和地址不能为空'];
        }
        $result = $this->save($data);
        if (!$result) {
            return ['code' => 403, 'msg' => '添加失败'];
        } else {
            $this->clearCache(); // 清空缓存
            return ['code' => 200, 'msg' => '添加成功'];
        }
    }
    /**
     * 设置菜单状态
     * @param array $param
     * @return array
     */
    public function setAuthRule($param=[])
    {
        if (!$param['id'] || !$param['a']) {
            return result(403, '参数错误，请刷新重试或是联系技术支持');
        }
        $data = [];
        switch ($param['a']){
            case 's':
                $param['st'] ? $status = 0 : $status = 1;
                $data = ['id'=>$param['id'],'status'=>$status];
                break;
            case 'ds':
                $param['st'] ? $display = 0 : $display = 1;
                $data = ['id'=>$param['id'],'display'=>$display];
                break;
            case 'com':
                $param['st'] ? $display = 0 : $display = 1;
                $data = ['id'=>$param['id'],'is_common'=>$display];
                break;
            case 'order':
                $data = ['id'=>$param['id'],'order'=>$param['st']];
                break;
        }
        $result = $this->update($data);
        if($result){
            $this->clearCache(); //清除缓存
            return result(200,'状态更新成功');
        }else{
            return result(500,'操作失败，请重试或是联系技术支持');
        }
    }

    /**
     * 编辑
     * @param $data
     * @return array
     */
    public function edAuthRule($data)
    {
        if(!array_key_exists('display',$data)){
            $data['display'] = 0;
        }
        if(!array_key_exists('status',$data)){
            $data['status'] = 0;
        }
        $result = $this->update($data);
        if($result){
            $this->clearCache(); //清除缓存
            return result(200,'更新成功',url('authorize/index'));
        }else{
            return result(500,'更新失败，请刷新重试或是联系技术支持');
        }
    }

    /**
     * 删除
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delAurlRule($id)
    {
        $result = $this->where('id',$id)->delete();
        if($result){
            $this->clearCache();
            return result(200,'菜单删除成功');
        }else{
            return result(500,'菜单删除失败，请刷新重试！');
        }
    }
    /**
     * 清除缓存
     */
    private function clearCache()
    {
        Cache::rm('authorize');
        Cache::rm('commonMenus');
    }
}