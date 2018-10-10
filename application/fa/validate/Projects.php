<?php
/**
 * Created by PhpStorm.
 * User: imdante
 * Date: 2018.09.29
 * Time: 23:50
 */

namespace app\fa\validate;


use think\Validate;

class Projects extends Validate
{
    protected $rules=[
        'subject'=>'require',
        'customer'=>'require',
        'customer_pm'=>'require',
    ];
    protected $message =[
        'subject.require'=>'项目名称不能空',
        'customer.require'=>'客户名称不能为空',
        'customer_pm.require'=>'客户负责人不能为空',
    ];
}