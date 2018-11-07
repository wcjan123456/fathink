<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018/11/7
 * Time: 16:06
 */

namespace app\api\controller;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu extends Authorize
{
    protected $accessKey = 'Access_Key'; //授权码
    protected $secretKey = ''; //密钥
    protected $bucket='pewwgg'; //对象存储空间名称

    /**
     * 文件上传到七牛
     * @param $filePath
     * @param $saveName
     * @return mixed
     * @throws \Exception
     */
    public function uploader($filePath,$saveName){
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucket);

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        // @param $token  加密签名
        list($ret, $err) = $uploadMgr->putFile($token, $saveName, $filePath);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            return $err;
        } else {
            $this->delFile($filePath);

            return $ret;
        }
    }
    //删除文件
    private function delFile($filePath){
        @unlink($filePath);
    }
}