<?php
namespace app\api\controller;

use think\captcha\Captcha;
use think\Controller;
use think\facade\Cache;

class Handle extends Controller
{
    /**
     * 清除缓存
     */
    public function clear_cache(){
        Cache::clear();
        $this->result('',200,'清除缓存成功，正在为您刷新页面！');
    }

    /**
     * 文件上传
     * @return mixed|string
     * @throws \Exception
     */
    public function uploader()
    {
        $fileName = input('filename') ?: 'file';
        $fileType = input('get.type')?: 'string';
        ini_set('max_execution_time', '0');

        $file = request()->file($fileName);
        $info = $file->validate(['size'=>15678000,'ext'=>'jpg,png,gif'])->move('../public/attach');
        if($info){
            $filePath = str_replace('\\','/','/attach/' . $info->getSaveName());
            switch ($fileType){
                case 'thumb':
                    $this->result($filePath,200,'上传成功');
                    break;
                case 'article_img':
                    return $filePath;
                    break;
                default:
                    return $filePath;
            }
        }else{
            $this->result('',500,$file->getError());
        }
    }

    /**
     * 生成缩略图
     * @param $file
     * @param string $w
     * @param string $h
     * @param bool $destroy
     * @return string
     */
    private static function makeThumb($file, $w = '350', $h = '260', $destroy = false)
    {
        $image = \think\Image::open('.' . $file);
        $save = './attach/'.date('Ymd').'/' . sha1('thumb_' . $file) . '.jpg';
        if(!file_exists('./attach/'.date('Ymd'))){
            mkdir('./attach/'.date('Ymd'),0777,true);
        }
        $image->thumb($w, $h, 3)->save($save);
        if($destroy){
            @unlink('.'.$file);
        }
        return $save;
    }
    /**
     * 删除本地文件
     */
    public function unset_file()
    {
        $file = input('get.file');
        @unlink('./'.$file);
    }


    public function verify()
    {
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    18,
            // 验证码位数
            'length'      =>    4,
            'imageH'      =>    36,
            'imageW'      =>    118,
            'useCurve'  =>  false
        ];
        $captcha = new Captcha($config);

        return $captcha->entry();
    }
}