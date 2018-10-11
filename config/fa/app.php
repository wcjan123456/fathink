<?php
//配置文件
return [
    //支付方式配置
    'payment' => [
        ['payment_id' => 1, 'payment_name' => '现金'],
        ['payment_id' => 2, 'payment_name' => '微信'],
        ['payment_id' => 3, 'payment_name' => '支付宝'],
        ['payment_id' => 4, 'payment_name' => '对公'],
        ['payment_id' => 5, 'payment_name' => '刷卡'],
        ['payment_id' => 6, 'payment_name' => '其他']
    ],
    //项目紧急程度配置
    'projectLevel'=>[
        ['level'=>1,'level_name'=>'非常紧急','color_style'=>'am-danger'],
        ['level'=>2,'level_name'=>'紧急','color_style'=>'am-warning'],
        ['level'=>3,'level_name'=>'一般','color_style'=>'am-primary'],
        ['level'=>4,'level_name'=>'可延后','color_style'=>'am-success'],
    ],
    //项目状态对照表
    'projectStatus'=>[
        ['status'=>1,'status_name'=>'已接单'],
        ['status'=>2,'status_name'=>'设计出图'],
        ['status'=>3,'status_name'=>'已出图'],
        ['status'=>4,'status_name'=>'制作中'],
        ['status'=>5,'status_name'=>'等待施工'],
        ['status'=>6,'status_name'=>'施工中'],
        ['status'=>7,'status_name'=>'施工完成'],
        ['status'=>8,'status_name'=>'等待收款'],
        ['status'=>9,'status_name'=>'已完结']
    ]
];